<?php

use \Bitrix\Main\Loader;
use \Bitrix\Main\Application;
use \Bitrix\Main\Context;
use \Bitrix\Main\Type\DateTime;
use \Bitrix\Iblock;
use \Bitrix\Main\Page\Asset;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
	die();
}
/** @var CBitrixComponent $this */
/** @var array $arParams */
/** @var array $arResult */
/** @var string $componentPath */
/** @var string $componentName */
/** @var string $componentTemplate */
/** @global CDatabase $DB */
/** @global CUser $USER */
/** @global CMain $APPLICATION */

/** @global CIntranetToolbar $INTRANET_TOOLBAR */
//global $INTRANET_TOOLBAR;
//global $componentPath;
//pre($componentPath);

class  zsOwlSlider extends CBitrixComponent
{
	private $_request;
	public $arParams;
	private $componentPath;
	private $this_page;
	public $componentTemplate;

	public function __construct($component = null)
	{
		global $componentPath, $componentTemplate;
		//pre($componentPath);
		parent::__construct($component);
		$this->this_page = $this->_app()->GetCurPage(false);

		$this->componentPath = $this->getPath();
	}

	/**
	 * Проверка наличия модулей требуемых для работы компонента
	 * @return bool
	 * @throws Exception
	 */
	private function _checkModules()
	{
		if (!Loader::includeModule('iblock')
		) {
			throw new \Exception('Не загружены модули необходимые для работы модуля');
		}

		return true;
	}

	/**
	 * Обертка над глобальной переменной
	 * @return CAllMain|CMain
	 */
	private function _app()
	{
		global $APPLICATION;
		return $APPLICATION;
	}

	/**
	 * Обертка над глобальной переменной
	 * @return CAllUser|CUser
	 */
	private function _user()
	{
		global $USER;
		return $USER;
	}

	/**
	 * Подготовка параметров компонента
	 * @param $arParams
	 * @return mixed
	 */
	public function onPrepareComponentParams($arParams)
	{
		global $DB;

		// тут пишем логику обработки параметров, дополнение параметрами по умолчанию
		// и прочие нужные вещи
		// compatibility for bigData case with zero initial elements
		if ($arParams['OWL_COUNT'] <= 0) {
			$arParams['OWL_COUNT'] = 5;
		}
		$arParams["ACTIVE_DATE_FORMAT"] = trim($arParams["ACTIVE_DATE_FORMAT"]);
		if ($arParams["ACTIVE_DATE_FORMAT"] == '') {
			$arParams["ACTIVE_DATE_FORMAT"] = $DB->DateFormatToPHP(CSite::GetDateFormat("SHORT"));
		}

		$this->arParams = $arParams;
		return $arParams;
	}

	private function connectExt()
	{
		//Asset::getInstance()->addCss($this->componentPath."/vendors/Owl/dist/assets/owl.carousel.min.css");
		//Asset::getInstance()->addJs($this->componentPath."/lib/jquery-3.5.1.min.js");
		//Asset::getInstance()->addJs($this->componentPath."/vendors/Owl/dist/owl.carousel.min.js");
		if ($this->arParams["PATH_OWL_LIB_JS"] && file_exists(
				$_SERVER["DOCUMENT_ROOT"] . $this->arParams["PATH_OWL_LIB_JS"]
			)) {
			Asset::getInstance()->addJs($this->arParams["PATH_OWL_LIB_JS"]);
		} else {
			Asset::getInstance()->addJs($this->componentPath . "/vendors/Owl/dist/owl.carousel.min.js");
		}
		if ($this->arParams["PATH_OWL_LIB_CSS"] && file_exists(
				$_SERVER["DOCUMENT_ROOT"] . $this->arParams["PATH_OWL_LIB_CSS"]
			)) {
			Asset::getInstance()->addCss($this->arParams["PATH_OWL_LIB_CSS"]);
		} else {
			Asset::getInstance()->addCss($this->componentPath . "/vendors/Owl/dist/assets/owl.carousel.min.css");
		}
		if ($this->arParams["PATH_JQUERY"] && file_exists($_SERVER["DOCUMENT_ROOT"] . $this->arParams["PATH_JQUERY"])) {
			Asset::getInstance()->addJs($this->arParams["PATH_JQUERY"]);
		}
		Asset::getInstance()->addJs($this->componentPath . "/script.js");
	}

	private function getScriptParam()
	{
	}

	private function getElementList()
	{
		$this->connectExt();

		//if(!$this->arParams["IBLOCK_ID"]) return false;
		if ($this->arParams["FILTER_NAME"] == '' || !preg_match(
				"/^[A-Za-z_][A-Za-z01-9_]*$/",
				$this->arParams["FILTER_NAME"]
			)) {
			$arrFilter = array();
		} else {
			$arrFilter = $GLOBALS[$this->arParams["FILTER_NAME"]];
			if (!is_array($arrFilter)) {
				$arrFilter = array();
			}
		}

		$this->arParams["FIELD_CODE"] = is_array($this->arParams["FIELD_CODE"]) ? $this->arParams["FIELD_CODE"] : [];
		$arSelect = array_unique(array_merge(
			                         [
				                         "ID",
				                         "IBLOCK_ID",
				                         "IBLOCK_SECTION_ID",
				                         "NAME",
				                         "ACTIVE_FROM",
				                         "TIMESTAMP_X",
				                         "DETAIL_PAGE_URL",
				                         "LIST_PAGE_URL",
				                         "DETAIL_TEXT",
				                         "DETAIL_TEXT_TYPE",
				                         "PREVIEW_TEXT",
				                         "PREVIEW_TEXT_TYPE",
				                         "PREVIEW_PICTURE",
			                         ],
			                         $this->arParams["FIELD_CODE"])
		);
		$bGetProperty = !empty($this->arParams["PROPERTY_CODE"]);
		$arResult["ITEMS"] = array();
		$arResult["ELEMENTS"] = array();
		$arFilter = array(
			"IBLOCK_ID" => $this->arParams["IBLOCK_ID"],
			"IBLOCK_LID" => SITE_ID,
			"ACTIVE" => "Y",
			//"CHECK_PERMISSIONS" => $this->arParams['CHECK_PERMISSIONS'] ? "Y" : "N",
		);

		$section = [];
		if ($this->arParams["PARENT_SECTION"]) {
			$section[] = $this->arParams["PARENT_SECTION"];
			$rsParentSection = CIBlockSection::GetByID($this->arParams["PARENT_SECTION"]);
			if ($arParentSection = $rsParentSection->GetNext()) {
				$arFilterSection = array(
					'IBLOCK_ID' => $this->arParams["IBLOCK_ID"],
					'>LEFT_MARGIN' =>
						$arParentSection['LEFT_MARGIN'],
					'<RIGHT_MARGIN' => $arParentSection['RIGHT_MARGIN'],
					'>DEPTH_LEVEL' => $arParentSection['DEPTH_LEVEL']
				); // выберет потомков без учета активности
				$rsSect = CIBlockSection::GetList(array('left_margin' => 'asc'), $arFilterSection);
				while ($arSect = $rsSect->GetNext()) {
					$section[] = $arSect["ID"];// получаем подразделы
				}
			}
		}
		if (count($section)) {
			$arFilter["SECTION_ID"] = $section;
		}
		$arSort = array(
			$this->arParams["SORT_BY1"] => $this->arParams["SORT_ORDER1"],
			$this->arParams["SORT_BY2"] => $this->arParams["SORT_ORDER2"],
		);
		if (!array_key_exists("ID", $arSort)) {
			$arSort["ID"] = "DESC";
		}

		$shortSelect = array('ID', 'IBLOCK_ID');
		foreach (array_keys($arSort) as $index) {
			if (!in_array($index, $shortSelect)) {
				$shortSelect[] = $index;
			}
		}
		$arNavParams = array(
			"nTopCount" => $this->arParams["OWL_COUNT"]
		);
		$elementFilter = array(
			"IBLOCK_ID" => $arResult["ID"],
			"IBLOCK_LID" => SITE_ID,
			"ID" => $arResult["ELEMENTS"]
		);
		$obParser = new CTextParser;
		$iterator = CIBlockElement::GetList(
			$arSort,
			array_merge($arFilter, $arrFilter),
			false,
			$arNavParams,
			$arSelect
		);
		$iterator->SetUrlTemplates($this->arParams["DETAIL_URL"], "", $this->arParams["IBLOCK_URL"]);
		while ($arItem = $iterator->GetNext()) {
			$arButtons = CIBlock::GetPanelButtons(
				$arItem["IBLOCK_ID"],
				$arItem["ID"],
				0,
				array("SECTION_BUTTONS" => false, "SESSID" => false)
			);
			$elementFilter["ID"][] = $arItem["ID"];
			$arItem["EDIT_LINK"] = $arButtons["edit"]["edit_element"]["ACTION_URL"];
			$arItem["DELETE_LINK"] = $arButtons["edit"]["delete_element"]["ACTION_URL"];

			if ($this->arParams["PREVIEW_TRUNCATE_LEN"] > 0) {
				$arItem["PREVIEW_TEXT"] = $obParser->html_cut(
					$arItem["PREVIEW_TEXT"],
					$this->arParams["PREVIEW_TRUNCATE_LEN"]
				);
			}

			if ($arItem["ACTIVE_FROM"] <> '') {
				$arItem["DISPLAY_ACTIVE_FROM"] = CIBlockFormatProperties::DateFormat(
					$this->arParams["ACTIVE_DATE_FORMAT"],
					MakeTimeStamp($arItem["ACTIVE_FROM"], CSite::GetDateFormat())
				);
			} else {
				$arItem["DISPLAY_ACTIVE_FROM"] = "";
			}

			Iblock\InheritedProperty\ElementValues::queue($arItem["IBLOCK_ID"], $arItem["ID"]);

			$arItem["FIELDS"] = array();

			if ($bGetProperty) {
				$arItem["PROPERTIES"] = array();
			}
			$arItem["DISPLAY_PROPERTIES"] = array();

			if ($this->arParams["SET_LAST_MODIFIED"]) {
				$time = DateTime::createFromUserTime($arItem["TIMESTAMP_X"]);
				if (
					!isset($arResult["ITEMS_TIMESTAMP_X"])
					|| $time->getTimestamp() > $arResult["ITEMS_TIMESTAMP_X"]->getTimestamp()
				) {
					$arResult["ITEMS_TIMESTAMP_X"] = $time;
				}
			}

			$id = (int)$arItem["ID"];
			$arResult["ITEMS"][$id] = $arItem;
		}
		unset($obElement);
		unset($iterator);

		if ($bGetProperty) {
			unset($elementFilter['IBLOCK_LID']);
			CIBlockElement::GetPropertyValuesArray(
				$arResult["ITEMS"],
				$this->arParams["IBLOCK_ID"],
				array_merge($arFilter, $arrFilter)
			);
		}
		//}
		$arResult['ITEMS'] = array_values($arResult['ITEMS']);
		$tmp = [];
		foreach ($arResult["ITEMS"] as &$arItem) {
			if (!$this->checkShowThisPage($arItem)) {
				continue;
			}
			$tmp[] = $arItem;
			if ($bGetProperty) {
				foreach ($this->arParams["PROPERTY_CODE"] as $pid) {
					$prop = &$arItem["PROPERTIES"][$pid];
					if (
						(is_array($prop["VALUE"]) && count($prop["VALUE"]) > 0)
						|| (!is_array($prop["VALUE"]) && $prop["VALUE"] <> '')
					) {
						$arItem["DISPLAY_PROPERTIES"][$pid] = CIBlockFormatProperties::GetDisplayValue(
							$arItem,
							$prop,
							"news_out"
						);
					}
				}
			}

			$ipropValues = new Iblock\InheritedProperty\ElementValues($arItem["IBLOCK_ID"], $arItem["ID"]);
			$arItem["IPROPERTY_VALUES"] = $ipropValues->getValues();
			Iblock\Component\Tools::getFieldImageData(
				$arItem,
				array('PREVIEW_PICTURE', 'DETAIL_PICTURE'),
				Iblock\Component\Tools::IPROPERTY_ENTITY_ELEMENT,
				'IPROPERTY_VALUES'
			);

			foreach ($this->arParams["FIELD_CODE"] as $code) {
				if (array_key_exists($code, $arItem)) {
					$arItem["FIELDS"][$code] = $arItem[$code];
				}
			}
		}
		unset($arItem);
		$arResult["ITEMS"] = $tmp;
		unset($tmp);
		$arResult["jsParams"] = $this->getJSParams();
		$this->arResult = $arResult;
	}

	private function getJSParams()
	{
		$owl_js_params = [];
		$num_breakpoints = (int)$this->arParams['BREAKPOINT_COUNT'];

		if ($this->arParams["SHOW_PLACEHOLDER"] == "Y") {
			$owl_js_params["onInitialize"] = "initialized_slider";
		}
		for ($i = 0; $i <= $num_breakpoints; $i++) {
			$tmp_params = [];
			$cnt = ($i === 0) ? '' : "_" . $i;

			if ($this->arParams['items' . $cnt]) {
				$tmp_params["items"] = (int)$this->arParams['items' . $cnt];
			}

			if ($this->arParams['dots' . $cnt] && $this->arParams['dots' . $cnt] !== "UNSET") {
				$tmp_params["dots"] = ($this->arParams['dots' . $cnt] == 'Y');
			}

			if ($this->arParams['nav' . $cnt] && $this->arParams['nav' . $cnt] !== "UNSET") {
				$tmp_params["nav"] = ($this->arParams['nav' . $cnt] == 'Y');
			}

			if ($this->arParams['loop' . $cnt] && $this->arParams['loop' . $cnt] !== "UNSET") {
				$tmp_params["loop"] = ($this->arParams['loop' . $cnt] == 'Y');
			}

			if ($this->arParams['lazyLoad' . $cnt] && $this->arParams['lazyLoad' . $cnt] !== "UNSET") {
				$tmp_params["lazyLoad"] = ($this->arParams['lazyLoad' . $cnt] == 'Y');

			}

			if ($this->arParams['autoplay' . $cnt] && $this->arParams['autoplay' . $cnt] !== "UNSET") {
				$tmp_params["autoplay"] = ($this->arParams['autoplay' . $cnt] == 'Y');
			}

			if ($this->arParams['autoplayHoverPause' . $cnt] && $this->arParams['autoplayHoverPause' . $cnt] !== "UNSET") {
				$tmp_params["autoplayHoverPause"] = ($this->arParams['autoplayHoverPause' . $cnt] == 'Y');
			}

			if ($this->arParams['autoplayTimeout' . $cnt]) {
				$tmp_params["autoplayTimeout"] = (int)$this->arParams['autoplayTimeout' . $cnt];
			}

			if ($this->arParams['autoplaySpeed' . $cnt]) {
				$tmp_params["autoplaySpeed"] = (int)$this->arParams['autoplaySpeed' . $cnt];
			}

			if ($this->arParams['smartSpeed' . $cnt]) {
				$tmp_params["smartSpeed"] = (int)$this->arParams['smartSpeed' . $cnt];
			}

			if ($this->arParams['autoWidth' . $cnt] && $this->arParams['autoWidth' . $cnt] !== "UNSET") {
				$tmp_params["autoWidth"] = ($this->arParams['autoWidth' . $cnt] == 'Y');
			}

			if ($this->arParams['margin' . $cnt]) {
				$tmp_params["margin"] = (int)$this->arParams['margin' . $cnt];
			}

			if (!$this->arParams['resolution' . $cnt]) {
				$owl_js_params = $tmp_params;
			} else {
				$owl_js_params['responsive'][$this->arParams['resolution' . $cnt]] = $tmp_params;
			}
		}
		return $owl_js_params;
	}

	/**
	 * Точка входа в компонент
	 * Должна содержать только последовательность вызовов вспомогательых ф-ий и минимум логики
	 * всю логику стараемся разносить по классам и методам
	 */
	public function executeComponent()
	{
		$this->_checkModules();
		$this->getElementList();
		//$this->getElement($this->arParams['IBLOCK_ID'],[]);
		$this->_request = Application::getInstance()->getContext()->getRequest();

		// что-то делаем и результаты работы помещаем в arResult, для передачи в шаблон
		$this->arResult['SOME_VAR'] = 'some result data for template';
		$this->setResultCacheKeys(array(
			"ID",
			"IBLOCK_TYPE_ID",
			"LIST_PAGE_URL",
			"NAV_CACHED_DATA",
			"NAME",
			"SECTION",
			"ELEMENTS",
			"IPROPERTY_VALUES",
			"ITEMS_TIMESTAMP_X",
		));

		//$this->componentPath = $this->GetPath();

		//$template = & $this->GetTemplate();
		//$templateFile = $template->GetFile();
		//$this->componentTemplate = $template->GetFolder();
		//pre($template->GetFolder());
		//pre($this->__path);
		//pre($this->getTemplateName());
		$this->includeComponentTemplate();
	}

	private function checkShowThisPage($arItem)
	{
		$testpage = false;
		$show = true;
		if ($arItem['PROPERTIES']['PAGE_SHOW']['VALUE']) {
			foreach ($arItem['PROPERTIES']['PAGE_SHOW']['VALUE'] as $t) {//может быть массивом без значенией, проверяем что хоть одно есть
				if ($t) {
					$testpage = true;
					$show = false;
					break;
				}
			}
		}
		if ($testpage) {//есть условия для проверка страницы
			//получаем текущую
			//$page = $this->_app()->GetCurPage(false);
			foreach ($arItem['PROPERTIES']['PAGE_SHOW']['VALUE'] as $t) {//может быть массивом без значенией, проверяем что хоть одно есть
				$t_page = trim($t);
				if ($arItem['PROPERTIES']['RECURSIVE']['VALUE'] == "Y") {//ищем и в подразделах
					if ($t_page == '/') {
						if ($this->this_page == '/') {
							$show = true;
							break;
						} else {
							continue;
						}
					}
					if (strpos($this->this_page, $t_page) === 0) {
						$show = true;
						break;
					}
				} else {//точный адрес
					if ($this->this_page == $t_page) {
						$show = true;
						break;
					}
				}
			}
		}
		return $show;
	}
}
