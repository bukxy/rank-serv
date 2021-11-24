/*
 * ATTENTION: An "eval-source-map" devtool has been used.
 * This devtool is neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file with attached SourceMaps in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */
/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/js/back/language.js":
/*!***************************************!*\
  !*** ./resources/js/back/language.js ***!
  \***************************************/
/***/ (() => {

eval("$(document).ready(function ($) {\n  $(document).on('submit', '#addLang-ajax', function (e) {\n    e.preventDefault();\n\n    var _token = $('meta[name=\"csrf-token\"]').attr('content');\n\n    var formData = new FormData($('#addLang-ajax')[0]);\n    $.ajaxSetup({\n      headers: {\n        'X-CSRF-TOKEN': _token\n      }\n    });\n    $.ajax({\n      type: \"POST\",\n      url: \"/dashboard/language\",\n      data: formData,\n      contentType: false,\n      processData: false,\n      success: function success(res) {\n        if (res.status == 400) {\n          $.each(res.errors, function (key, err_value) {});\n        }\n\n        if (res.status == 200) {\n          $('#addLang-ajax input').val('');\n          $('#addLanguage .alert-success').removeClass('d-none');\n          $('#addLanguage .alert-success strong').text(res.success);\n        }\n      }\n    });\n  });\n  $('#refresh').click(function (e) {\n    e.preventDefault();\n    location.reload();\n  });\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvanMvYmFjay9sYW5ndWFnZS5qcz80NGY3Il0sIm5hbWVzIjpbIiQiLCJkb2N1bWVudCIsInJlYWR5Iiwib24iLCJlIiwicHJldmVudERlZmF1bHQiLCJfdG9rZW4iLCJhdHRyIiwiZm9ybURhdGEiLCJGb3JtRGF0YSIsImFqYXhTZXR1cCIsImhlYWRlcnMiLCJhamF4IiwidHlwZSIsInVybCIsImRhdGEiLCJjb250ZW50VHlwZSIsInByb2Nlc3NEYXRhIiwic3VjY2VzcyIsInJlcyIsInN0YXR1cyIsImVhY2giLCJlcnJvcnMiLCJrZXkiLCJlcnJfdmFsdWUiLCJ2YWwiLCJyZW1vdmVDbGFzcyIsInRleHQiLCJjbGljayIsImxvY2F0aW9uIiwicmVsb2FkIl0sIm1hcHBpbmdzIjoiQUFBQUEsQ0FBQyxDQUFDQyxRQUFELENBQUQsQ0FBWUMsS0FBWixDQUFrQixVQUFTRixDQUFULEVBQVk7QUFDMUJBLEVBQUFBLENBQUMsQ0FBQ0MsUUFBRCxDQUFELENBQVlFLEVBQVosQ0FBZSxRQUFmLEVBQXlCLGVBQXpCLEVBQTBDLFVBQVNDLENBQVQsRUFBVztBQUNqREEsSUFBQUEsQ0FBQyxDQUFDQyxjQUFGOztBQUVBLFFBQUlDLE1BQU0sR0FBR04sQ0FBQyxDQUFDLHlCQUFELENBQUQsQ0FBNkJPLElBQTdCLENBQWtDLFNBQWxDLENBQWI7O0FBRUEsUUFBSUMsUUFBUSxHQUFHLElBQUlDLFFBQUosQ0FBYVQsQ0FBQyxDQUFDLGVBQUQsQ0FBRCxDQUFtQixDQUFuQixDQUFiLENBQWY7QUFFQUEsSUFBQUEsQ0FBQyxDQUFDVSxTQUFGLENBQVk7QUFDUkMsTUFBQUEsT0FBTyxFQUFFO0FBQ0wsd0JBQWdCTDtBQURYO0FBREQsS0FBWjtBQUtBTixJQUFBQSxDQUFDLENBQUNZLElBQUYsQ0FBTztBQUNIQyxNQUFBQSxJQUFJLEVBQUUsTUFESDtBQUVIQyxNQUFBQSxHQUFHLEVBQUUscUJBRkY7QUFHSEMsTUFBQUEsSUFBSSxFQUFFUCxRQUhIO0FBSUhRLE1BQUFBLFdBQVcsRUFBRSxLQUpWO0FBS0hDLE1BQUFBLFdBQVcsRUFBRSxLQUxWO0FBTUhDLE1BQUFBLE9BQU8sRUFBRSxpQkFBU0MsR0FBVCxFQUFhO0FBQ2xCLFlBQUdBLEdBQUcsQ0FBQ0MsTUFBSixJQUFjLEdBQWpCLEVBQXNCO0FBQ2xCcEIsVUFBQUEsQ0FBQyxDQUFDcUIsSUFBRixDQUFPRixHQUFHLENBQUNHLE1BQVgsRUFBbUIsVUFBVUMsR0FBVixFQUFlQyxTQUFmLEVBQTBCLENBRTVDLENBRkQ7QUFHSDs7QUFDRCxZQUFHTCxHQUFHLENBQUNDLE1BQUosSUFBYyxHQUFqQixFQUFzQjtBQUNsQnBCLFVBQUFBLENBQUMsQ0FBQyxxQkFBRCxDQUFELENBQXlCeUIsR0FBekIsQ0FBNkIsRUFBN0I7QUFDQXpCLFVBQUFBLENBQUMsQ0FBQyw2QkFBRCxDQUFELENBQWlDMEIsV0FBakMsQ0FBNkMsUUFBN0M7QUFDQTFCLFVBQUFBLENBQUMsQ0FBQyxvQ0FBRCxDQUFELENBQXdDMkIsSUFBeEMsQ0FBNkNSLEdBQUcsQ0FBQ0QsT0FBakQ7QUFDSDtBQUNKO0FBakJFLEtBQVA7QUFtQkgsR0EvQkQ7QUFpQ0FsQixFQUFBQSxDQUFDLENBQUMsVUFBRCxDQUFELENBQWM0QixLQUFkLENBQW9CLFVBQVN4QixDQUFULEVBQVk7QUFDN0JBLElBQUFBLENBQUMsQ0FBQ0MsY0FBRjtBQUNDd0IsSUFBQUEsUUFBUSxDQUFDQyxNQUFUO0FBQ0gsR0FIRDtBQUlILENBdENEIiwic291cmNlc0NvbnRlbnQiOlsiJChkb2N1bWVudCkucmVhZHkoZnVuY3Rpb24oJCkge1xuICAgICQoZG9jdW1lbnQpLm9uKCdzdWJtaXQnLCAnI2FkZExhbmctYWpheCcgLGZ1bmN0aW9uKGUpe1xuICAgICAgICBlLnByZXZlbnREZWZhdWx0KCk7XG5cbiAgICAgICAgbGV0IF90b2tlbiA9ICQoJ21ldGFbbmFtZT1cImNzcmYtdG9rZW5cIl0nKS5hdHRyKCdjb250ZW50JylcblxuICAgICAgICBsZXQgZm9ybURhdGEgPSBuZXcgRm9ybURhdGEoJCgnI2FkZExhbmctYWpheCcpWzBdKTtcblxuICAgICAgICAkLmFqYXhTZXR1cCh7XG4gICAgICAgICAgICBoZWFkZXJzOiB7XG4gICAgICAgICAgICAgICAgJ1gtQ1NSRi1UT0tFTic6IF90b2tlblxuICAgICAgICAgICAgfVxuICAgICAgICB9KTtcbiAgICAgICAgJC5hamF4KHtcbiAgICAgICAgICAgIHR5cGU6IFwiUE9TVFwiLFxuICAgICAgICAgICAgdXJsOiBcIi9kYXNoYm9hcmQvbGFuZ3VhZ2VcIixcbiAgICAgICAgICAgIGRhdGE6IGZvcm1EYXRhLFxuICAgICAgICAgICAgY29udGVudFR5cGU6IGZhbHNlLFxuICAgICAgICAgICAgcHJvY2Vzc0RhdGE6IGZhbHNlLFxuICAgICAgICAgICAgc3VjY2VzczogZnVuY3Rpb24ocmVzKXtcbiAgICAgICAgICAgICAgICBpZihyZXMuc3RhdHVzID09IDQwMCkge1xuICAgICAgICAgICAgICAgICAgICAkLmVhY2gocmVzLmVycm9ycywgZnVuY3Rpb24gKGtleSwgZXJyX3ZhbHVlKSB7XG5cbiAgICAgICAgICAgICAgICAgICAgfSk7XG4gICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgICAgIGlmKHJlcy5zdGF0dXMgPT0gMjAwKSB7XG4gICAgICAgICAgICAgICAgICAgICQoJyNhZGRMYW5nLWFqYXggaW5wdXQnKS52YWwoJycpO1xuICAgICAgICAgICAgICAgICAgICAkKCcjYWRkTGFuZ3VhZ2UgLmFsZXJ0LXN1Y2Nlc3MnKS5yZW1vdmVDbGFzcygnZC1ub25lJyk7XG4gICAgICAgICAgICAgICAgICAgICQoJyNhZGRMYW5ndWFnZSAuYWxlcnQtc3VjY2VzcyBzdHJvbmcnKS50ZXh0KHJlcy5zdWNjZXNzKTtcbiAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICB9LFxuICAgICAgICB9KTtcbiAgICB9KTtcblxuICAgICQoJyNyZWZyZXNoJykuY2xpY2soZnVuY3Rpb24oZSkge1xuICAgICAgIGUucHJldmVudERlZmF1bHQoKVxuICAgICAgICBsb2NhdGlvbi5yZWxvYWQoKTtcbiAgICB9KTtcbn0pO1xuIl0sImZpbGUiOiIuL3Jlc291cmNlcy9qcy9iYWNrL2xhbmd1YWdlLmpzLmpzIiwic291cmNlUm9vdCI6IiJ9\n//# sourceURL=webpack-internal:///./resources/js/back/language.js\n");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval-source-map devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./resources/js/back/language.js"]();
/******/ 	
/******/ })()
;