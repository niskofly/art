const { parallel} = require("gulp");
const { allMinJS, allMinCSS } = require("./gulp/scripts/all-min-js-css");
// const fixCss = require("./gulp/scripts/fixCss");
const startWatch = require("./gulp/scripts/start-watch");

exports.allMinJS = allMinJS;
exports.allMinCSS = allMinCSS;
// exports.fixCss = fixCss;
exports.default = parallel(startWatch);
