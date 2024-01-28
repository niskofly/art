window.loadFont = (url) => {
  // the 'fetch' equivalent has caching issues
  var xhr = new XMLHttpRequest();
  xhr.open('GET', url, true);
  xhr.onreadystatechange = () => {
    if (xhr.readyState == 4 && xhr.status == 200) {
      let css = xhr.responseText;
      css = css.replace(/}/g, 'font-display: swap; }');

      const head = document.getElementsByTagName('head')[0];
      const style = document.createElement('style');
      style.appendChild(document.createTextNode(css));
      head.appendChild(style);
    }
  };
  xhr.send();
}

// <link href="https://fonts.googleapis.com/css?family=PT+Sans+Caption:400italic,700italic,400,700&subset=latin,cyrillic-ext&display=swap"  rel="stylesheet" />
// <link href="https://fonts.googleapis.com/css2?family=PT+Sans+Caption:wght@400;700&display=swap" rel="stylesheet">
loadFont('https://fonts.googleapis.com/css2?family=PT+Sans+Caption:wght@400;700');
