document.addEventListener('DOMContentLoaded', function() {

  (function(window) {
    // 'use strict';
    function callTouch(selector, formName = '') {

      if (!selector) {
        return;
      }

      const form = document.querySelector(selector);
      let formData = new FormData(form);

      // for(let [name, value] of formData) {
      //   console.info(`${name} = ${value}`);
      // }

      const modId = 'ha8l2qmg';
      const ctParams = window.ct('calltracking_params', modId);
      if (formName === '') {
        formName = formData.get('formName') || form.name.replace(/aspro_/gim, '') || '';
      }
      const ctData = new URLSearchParams({
        fio: formData.get('FIO') || formData.get('NAME') ||
            formData.get('name') || '',
        phoneNumber: formData.get('PHONE') || formData.get('phone') ||
            formData.get('TEL') || formData.get('tel') || '',
        email: formData.get('EMAIL') || formData.get('email') || '',
        subject: formName,
        requestUrl: location.href,
        sessionId: ctParams.sessionId,
      });

      const url = `https://api.calltouch.ru/calls-service/RestAPI/requests/${ctParams.siteId}/register/`;
      const options = {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8',
        },
        body: ctData.toString(),
      };

      fetch(url, options).then(response => response.json()).then(result => {
        // console.info('ctResult: ', result);
        return true;
      }).catch((e) => {
        // console.error('ctError: ', e);
        return false;
      });
    }

    if (typeof window.DJ === 'undefined') {
      window.DJ = {};
    }
    if (typeof window.DJ.callTouch === 'undefined') {
      window.DJ.callTouch = callTouch;
    }
  })(window);

}, false);