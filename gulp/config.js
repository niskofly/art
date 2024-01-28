module.exports = {
	CSS: [
		"./public/local/**/*.css",
		"!./public/local/vendor/*",
		"!./**/*.min.css",
		"!./node_modules/**/*",
		"!./gulp/**/*",
	],
	JS: [
		"./public/local/**/*.js",
		"!./**/*.min.js",
		"!./public/local/vendor/*",
		"!./node_modules/**/*",
		"!./**/gulpfile.js",
		"!./gulp/**/*",
	],
};
