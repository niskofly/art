const { watcherJs, watcherCss } = require("./watchers");
const { scripts, styles } = require("./min-js-css");

module.exports = function startWatch() {
  watcherJs.on("change", (path) => {
    console.info("Start min JS: ", path);
    scripts(path);
    console.info("End min JS");
  });

  watcherCss.on("change", (path) => {
    console.info("Start min CSS: ", path);
    styles(path);
    console.info("End min CSS");
  });
};
