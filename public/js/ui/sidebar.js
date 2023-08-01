/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!************************************!*\
  !*** ./resources/js/ui/sidebar.js ***!
  \************************************/
setInterval(function time() {
  var today = new Date();

  /**
   *  Setting
   */
  var year = today.getFullYear();
  var month = today.getMonth() + 1;
  month = month.toString();
  month = month.length < 2 ? '0' + month : month;
  var date = today.getDate().toString();
  date = date.length < 2 ? '0' + date : date;
  var day = today.getDay();
  var hour = today.getHours().toString();
  hour = hour.length < 2 ? '0' + hour : hour;
  var minute = today.getMinutes().toString();
  minute = minute.length < 2 ? '0' + minute : minute;
  var second = today.getSeconds().toString();
  second = second.length < 2 ? '0' + second : second;
  switch (day) {
    case 1:
      day = 'Monday';
      break;
    case 2:
      day = 'Tuesday';
      break;
    case 3:
      day = 'Wednesday';
      break;
    case 4:
      day = 'Thursday';
      break;
    case 5:
      day = 'Friday';
      break;
    case 6:
      day = 'Saturday';
      break;
    case 7:
      day = "Sunday";
      break;
  }

  // 在 en-US 語言環境中獲取時間
  document.querySelector('.clock').innerHTML = "".concat(year, " - ").concat(month, " - ").concat(date, "<br>").concat(day, ", ").concat(hour, ":").concat(minute, ":").concat(second);
}, 1000);
/******/ })()
;