const { watch } = require("gulp");
const { CSS, JS } = require("../config");

const watcherJs = watch(JS);

const watcherCss = watch(CSS);

module.exports = {
	watcherJs,
	watcherCss,
};
