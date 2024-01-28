$(function () {
	var nav = priorityNav.init({
		mainNavWrapper: ".special-top-menu", // mainnav wrapper selector (must be direct parent from mainNav)
		mainNav: ".special-top-menu__list", // mainnav selector. (must be inline-block)
		navDropdownClassName: "nav__dropdown", // class used for the dropdown.
		navDropdownToggleClassName: "nav__dropdown-toggle", // class used for the dropdown toggle.
		navDropdownLabel: "...",
		navDropdownBreakpointLabel:
			'<div class="hamburger"><div class="nav-icon"><span></span><span></span><span></span></div></div>',
		breakPoint: 500,
	});
});
