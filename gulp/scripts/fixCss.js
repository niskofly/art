const { src, dest } = require("gulp");
const stylelint = require("stylelint");
const { CSS } = require("../config");

const fixCss = () =>
	src(CSS)
		.pipe(stylelint())
		.pipe(dest((file) => file.base));

module.exports = fixCss;
