(function () {
	"use strict";
	if (!!window.JCNewsListFilter) return;
	window.JCNewsListFilter = function (params) {
		this.formPosting = false;
		this.siteId = params.siteId || "";
		this.template = params.template || "";
		this.templateFolder = params.templateFolder || "";
		this.ajaxPath = this.templateFolder + "/ajax.php";
		this.parameters = params.parameters || "";
		this.container = document.querySelector("#filter-result"); //можно передать из шаблона
		this.blockFilter = document.querySelector(".block_filter");
		//BX.ready(BX.delegate(this.Load, this));
		//BX.bind(this.showMoreButton, 'click', BX.proxy(this.showMore, this));
		this.selectFilter = this.blockFilter.querySelectorAll("select");
		if (this.selectFilter.length) {
			for (var i in this.selectFilter) {
				BX.bind(
					this.selectFilter[i],
					"change",
					BX.proxy(this.changeFilter, this),
				);
			}
		}
		this.inputFilter = this.blockFilter.querySelectorAll("input");
		if (this.inputFilter.length) {
			for (var i in this.inputFilter) {
				BX.bind(
					this.inputFilter[i],
					"keyup",
					BX.proxy(this.changeFilter, this),
				);
			}
		}
		if (params.navParams) {
			this.navParams = {
				NavNum: params.navParams.NavNum || 1,
				NavPageNomer: parseInt(params.navParams.NavPageNomer) || 1,
				NavPageCount: parseInt(params.navParams.NavPageCount) || 1,
			};
		}
	};
	window.JCNewsListFilter.prototype = {
		Load: function () {
			//console.log(this.ajaxPath);
			var data = {};
			data["action"] = "ajaxfilter";

			//this.sendRequest(data)
		},
		sendRequest: function (data) {
			var defaultData = {
				siteId: this.siteId,
				template: this.template,
				parameters: this.parameters,
			};

			if (this.ajaxId) {
				defaultData.AJAX_ID = this.ajaxId;
			}
			console.log(BX.merge(defaultData, data));
			BX.ajax({
				url:
					this.ajaxPath +
					(document.location.href.indexOf("clear_cache=Y") !== -1
						? "?clear_cache=Y"
						: ""),
				method: "POST",
				dataType: "json",
				timeout: 60,
				data: BX.merge(defaultData, data),
				onsuccess: BX.delegate(function (result) {
					console.log(result);
					if (!result || !result.JS) return;

					BX.ajax.processScripts(
						BX.processHTML(result.JS).SCRIPT,
						false,
						BX.delegate(function () {
							this.showAction(result, data);
						}, this),
					);
				}, this),
			});
		},
		showAction: function (result, data) {
			//console.log(result, data)
			if (!data) return;

			switch (data.action) {
				case "ajaxfilter":
					this.processShowAjaxAction(result);
					break;
			}
		},
		processShowAjaxAction: function (result) {
			console.log("processShowAjaxAction");
			console.log(result);
			this.formPosting = false;
			//this.enableButton();
			//console.log(result)
			if (result) {
				this.processItems(result.items);
				//this.processPagination(result.pagination);
				//this.processEpilogue(result.epilogue);
				//this.checkButton();
			}
		},
		processItems: function (itemsHtml, position) {
			console.log("processItems");

			if (!itemsHtml) return;

			var processed = BX.processHTML(itemsHtml, false),
				temporaryNode = BX.create("DIV");
			//console.log(itemsHtml,processed,temporaryNode)
			var items, k, origRows;

			temporaryNode.innerHTML = processed.HTML;
			items = temporaryNode.querySelectorAll('[data-entity="items-row"]');
			//console.log(items)
			// Удаление всех дочерних элементов
			while (this.container.firstChild) {
				this.container.removeChild(this.container.firstChild);
			}
			if (items.length) {
				//this.showHeader(true);

				for (k in items) {
					if (items.hasOwnProperty(k)) {
						origRows = position
							? this.container.querySelectorAll('[data-entity="items-row"]')
							: false;
						items[k].style.opacity = 0;

						if (origRows && BX.type.isDomNode(origRows[position[k]])) {
							origRows[position[k]].parentNode.insertBefore(
								items[k],
								origRows[position[k]],
							);
						} else {
							this.container.appendChild(items[k]);
						}
					}
				}

				new BX.easing({
					duration: 5000,
					start: { opacity: 0 },
					finish: { opacity: 100 },
					transition: BX.easing.makeEaseOut(BX.easing.transitions.quad),
					step: function (state) {
						for (var k in items) {
							if (items.hasOwnProperty(k)) {
								items[k].style.opacity = state.opacity / 100;
							}
						}
					},
					complete: function () {
						for (var k in items) {
							if (items.hasOwnProperty(k)) {
								items[k].removeAttribute("style");
							}
						}
					},
				}).animate();
			}

			BX.ajax.processScripts(processed.SCRIPT);
		},
		changeFilter: function () {
			var data = {};
			data["action"] = "ajaxfilter";

			this.selectFilter.forEach(function (item) {
				if (item.value != "0") {
					data[item.name] = item.value;
				}
			});
			this.inputFilter.forEach(function (item) {
				if (item.value != "") {
					data[item.name] = item.value;
				}
			});
			this.sendRequest(data);
			return;

			if (this.selectFilter.length) {
				for (var i in this.selectFilter) {
					console.log(this.selectFilter[i].name);
				}
			}
			//console.log(BX.proxy_context)
		},
	};
})();
