document.addEventListener('DOMContentLoaded', function() {

  (function(window) {
    // 'use strict';
    function getUrlParams(url) {

      const location = document.location;
      if (!url) {
        url = location;
      } else {
        url = new URL( location.protocol + '//' + location.host + url);
      }

      if(!url.search) {
        return {};
      }

      const params = decodeURIComponent(url.search).match(/\?(.+)/)[1].split('&');
      const res = {};
      params.forEach(function(entry) {
        res[entry.split('=')[0]] = entry.split('=')[1];
      });
      return res;
    }

    if (typeof window.DJ === 'undefined') {
      window.DJ = {};
    }
    if (typeof window.DJ.getUrlParams  === 'undefined') {
      window.DJ.getUrlParams = getUrlParams;
    }
  })(window);

}, false);