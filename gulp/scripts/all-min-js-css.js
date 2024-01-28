const { src, dest } = require("gulp");
const rename = require("gulp-rename");
const sourcemaps = require("gulp-sourcemaps");
const babel = require("gulp-babel");
const autoprefixer = require("gulp-autoprefixer");
const csso = require("gulp-csso");
const { CSS, JS } = require("../config");

const allMinJS = () =>
	src(JS)
		.pipe(
			rename({
				suffix: ".min",
			}),
		)
		.pipe(sourcemaps.init({}))
		.pipe(babel())
		.pipe(sourcemaps.write("./", {}))
		.pipe(dest((file) => file.base));

const allMinCSS = () =>
	src(CSS)
		.pipe(
			rename({
				suffix: ".min",
			}),
		)
		.pipe(sourcemaps.init({}))
		.pipe(autoprefixer({ grid: true }))
		.pipe(csso())
		.pipe(sourcemaps.write("./", {}))
		.pipe(dest((file) => file.base));

module.exports = {
	allMinJS,
	allMinCSS,
};
