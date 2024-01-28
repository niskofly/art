/* eslint-disable import/no-extraneous-dependencies */
const { src, dest } = require("gulp");
const rename = require("gulp-rename");
const sourcemaps = require("gulp-sourcemaps");
const babel = require("gulp-babel");
const autoprefixer = require("gulp-autoprefixer");
const csso = require("gulp-csso");
const notify = require("gulp-notify");
const plumber = require("gulp-plumber");
const pathNode = require("path");

const scripts = (path) =>
	src(path)
		.pipe(
			rename({
				suffix: ".min",
			}),
		)
		.pipe(
			plumber({
				errorHandler: notify.onError((err) => ({
					title: "JavaScript",
					message: err.message,
					icon: pathNode.join(__dirname, "js.svg")
				}))
			})
		)
		.pipe(sourcemaps.init({}))
		.pipe(babel())
		.pipe(sourcemaps.write("./", {}))
		.pipe(dest((file) => file.base));

const styles = (path) =>
	src(path)
		.pipe(
			rename({
				suffix: ".min",
			}),
		)
		.pipe(
			plumber({
				errorHandler: notify.onError((err) => ({
					title: "Style",
					message: err.message,
					icon: pathNode.join(__dirname, "css.svg")
				}))
			})
		)
		.pipe(sourcemaps.init({}))
		.pipe(autoprefixer({ grid: true }),)
		.pipe(csso())
		.pipe(sourcemaps.write("./", {}))
		.pipe(dest((file) => file.base));

module.exports = {
	scripts,
	styles,
};
