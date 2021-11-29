/*
 * ATTENTION: An "eval-source-map" devtool has been used.
 * This devtool is neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file with attached SourceMaps in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */
/******/ (() => { // webpackBootstrap
<<<<<<< HEAD
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/js/back/language.js":
/*!***************************************!*\
  !*** ./resources/js/back/language.js ***!
  \***************************************/
/***/ (() => {

eval("$(document).ready(function ($) {\n  $(document).on('submit', '#addLang-ajax', function (e) {\n    e.preventDefault();\n\n    var _token = $('meta[name=\"csrf-token\"]').attr('content');\n\n    var formData = new FormData($('#addLang-ajax')[0]);\n    $.ajaxSetup({\n      headers: {\n        'X-CSRF-TOKEN': _token\n      }\n    });\n    $.ajax({\n      type: \"POST\",\n      url: \"/dashboard/language\",\n      data: formData,\n      contentType: false,\n      processData: false,\n      success: function success(res) {\n        if (res.status == 400) {\n          $.each(res.errors, function (key, err_value) {\n            $('#addLanguage .alert-danger').removeClass('d-none');\n            $('#addLanguage .alert-danger strong').text(err_value);\n          });\n        }\n\n        if (res.status == 200) {\n          $('#addLang-ajax input').val('');\n          $('#addLanguage .alert-success').removeClass('d-none');\n          $('#addLanguage .alert-success strong').text(res.success);\n        }\n      }\n    });\n  });\n  $('#refresh').click(function (e) {\n    e.preventDefault();\n    location.reload();\n  });\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvanMvYmFjay9sYW5ndWFnZS5qcz80NGY3Il0sIm5hbWVzIjpbIiQiLCJkb2N1bWVudCIsInJlYWR5Iiwib24iLCJlIiwicHJldmVudERlZmF1bHQiLCJfdG9rZW4iLCJhdHRyIiwiZm9ybURhdGEiLCJGb3JtRGF0YSIsImFqYXhTZXR1cCIsImhlYWRlcnMiLCJhamF4IiwidHlwZSIsInVybCIsImRhdGEiLCJjb250ZW50VHlwZSIsInByb2Nlc3NEYXRhIiwic3VjY2VzcyIsInJlcyIsInN0YXR1cyIsImVhY2giLCJlcnJvcnMiLCJrZXkiLCJlcnJfdmFsdWUiLCJyZW1vdmVDbGFzcyIsInRleHQiLCJ2YWwiLCJjbGljayIsImxvY2F0aW9uIiwicmVsb2FkIl0sIm1hcHBpbmdzIjoiQUFBQUEsQ0FBQyxDQUFDQyxRQUFELENBQUQsQ0FBWUMsS0FBWixDQUFrQixVQUFTRixDQUFULEVBQVk7QUFDMUJBLEVBQUFBLENBQUMsQ0FBQ0MsUUFBRCxDQUFELENBQVlFLEVBQVosQ0FBZSxRQUFmLEVBQXlCLGVBQXpCLEVBQTBDLFVBQVNDLENBQVQsRUFBVztBQUNqREEsSUFBQUEsQ0FBQyxDQUFDQyxjQUFGOztBQUVBLFFBQUlDLE1BQU0sR0FBR04sQ0FBQyxDQUFDLHlCQUFELENBQUQsQ0FBNkJPLElBQTdCLENBQWtDLFNBQWxDLENBQWI7O0FBRUEsUUFBSUMsUUFBUSxHQUFHLElBQUlDLFFBQUosQ0FBYVQsQ0FBQyxDQUFDLGVBQUQsQ0FBRCxDQUFtQixDQUFuQixDQUFiLENBQWY7QUFFQUEsSUFBQUEsQ0FBQyxDQUFDVSxTQUFGLENBQVk7QUFDUkMsTUFBQUEsT0FBTyxFQUFFO0FBQ0wsd0JBQWdCTDtBQURYO0FBREQsS0FBWjtBQUtBTixJQUFBQSxDQUFDLENBQUNZLElBQUYsQ0FBTztBQUNIQyxNQUFBQSxJQUFJLEVBQUUsTUFESDtBQUVIQyxNQUFBQSxHQUFHLEVBQUUscUJBRkY7QUFHSEMsTUFBQUEsSUFBSSxFQUFFUCxRQUhIO0FBSUhRLE1BQUFBLFdBQVcsRUFBRSxLQUpWO0FBS0hDLE1BQUFBLFdBQVcsRUFBRSxLQUxWO0FBTUhDLE1BQUFBLE9BQU8sRUFBRSxpQkFBU0MsR0FBVCxFQUFhO0FBQ2xCLFlBQUdBLEdBQUcsQ0FBQ0MsTUFBSixJQUFjLEdBQWpCLEVBQXNCO0FBQ2xCcEIsVUFBQUEsQ0FBQyxDQUFDcUIsSUFBRixDQUFPRixHQUFHLENBQUNHLE1BQVgsRUFBbUIsVUFBVUMsR0FBVixFQUFlQyxTQUFmLEVBQTBCO0FBQ3pDeEIsWUFBQUEsQ0FBQyxDQUFDLDRCQUFELENBQUQsQ0FBZ0N5QixXQUFoQyxDQUE0QyxRQUE1QztBQUNBekIsWUFBQUEsQ0FBQyxDQUFDLG1DQUFELENBQUQsQ0FBdUMwQixJQUF2QyxDQUE0Q0YsU0FBNUM7QUFDSCxXQUhEO0FBSUg7O0FBQ0QsWUFBR0wsR0FBRyxDQUFDQyxNQUFKLElBQWMsR0FBakIsRUFBc0I7QUFDbEJwQixVQUFBQSxDQUFDLENBQUMscUJBQUQsQ0FBRCxDQUF5QjJCLEdBQXpCLENBQTZCLEVBQTdCO0FBQ0EzQixVQUFBQSxDQUFDLENBQUMsNkJBQUQsQ0FBRCxDQUFpQ3lCLFdBQWpDLENBQTZDLFFBQTdDO0FBQ0F6QixVQUFBQSxDQUFDLENBQUMsb0NBQUQsQ0FBRCxDQUF3QzBCLElBQXhDLENBQTZDUCxHQUFHLENBQUNELE9BQWpEO0FBQ0g7QUFDSjtBQWxCRSxLQUFQO0FBb0JILEdBaENEO0FBa0NBbEIsRUFBQUEsQ0FBQyxDQUFDLFVBQUQsQ0FBRCxDQUFjNEIsS0FBZCxDQUFvQixVQUFTeEIsQ0FBVCxFQUFZO0FBQzdCQSxJQUFBQSxDQUFDLENBQUNDLGNBQUY7QUFDQ3dCLElBQUFBLFFBQVEsQ0FBQ0MsTUFBVDtBQUNILEdBSEQ7QUFJSCxDQXZDRCIsInNvdXJjZXNDb250ZW50IjpbIiQoZG9jdW1lbnQpLnJlYWR5KGZ1bmN0aW9uKCQpIHtcbiAgICAkKGRvY3VtZW50KS5vbignc3VibWl0JywgJyNhZGRMYW5nLWFqYXgnICxmdW5jdGlvbihlKXtcbiAgICAgICAgZS5wcmV2ZW50RGVmYXVsdCgpO1xuXG4gICAgICAgIGxldCBfdG9rZW4gPSAkKCdtZXRhW25hbWU9XCJjc3JmLXRva2VuXCJdJykuYXR0cignY29udGVudCcpXG5cbiAgICAgICAgbGV0IGZvcm1EYXRhID0gbmV3IEZvcm1EYXRhKCQoJyNhZGRMYW5nLWFqYXgnKVswXSk7XG5cbiAgICAgICAgJC5hamF4U2V0dXAoe1xuICAgICAgICAgICAgaGVhZGVyczoge1xuICAgICAgICAgICAgICAgICdYLUNTUkYtVE9LRU4nOiBfdG9rZW5cbiAgICAgICAgICAgIH1cbiAgICAgICAgfSk7XG4gICAgICAgICQuYWpheCh7XG4gICAgICAgICAgICB0eXBlOiBcIlBPU1RcIixcbiAgICAgICAgICAgIHVybDogXCIvZGFzaGJvYXJkL2xhbmd1YWdlXCIsXG4gICAgICAgICAgICBkYXRhOiBmb3JtRGF0YSxcbiAgICAgICAgICAgIGNvbnRlbnRUeXBlOiBmYWxzZSxcbiAgICAgICAgICAgIHByb2Nlc3NEYXRhOiBmYWxzZSxcbiAgICAgICAgICAgIHN1Y2Nlc3M6IGZ1bmN0aW9uKHJlcyl7XG4gICAgICAgICAgICAgICAgaWYocmVzLnN0YXR1cyA9PSA0MDApIHtcbiAgICAgICAgICAgICAgICAgICAgJC5lYWNoKHJlcy5lcnJvcnMsIGZ1bmN0aW9uIChrZXksIGVycl92YWx1ZSkge1xuICAgICAgICAgICAgICAgICAgICAgICAgJCgnI2FkZExhbmd1YWdlIC5hbGVydC1kYW5nZXInKS5yZW1vdmVDbGFzcygnZC1ub25lJyk7XG4gICAgICAgICAgICAgICAgICAgICAgICAkKCcjYWRkTGFuZ3VhZ2UgLmFsZXJ0LWRhbmdlciBzdHJvbmcnKS50ZXh0KGVycl92YWx1ZSk7XG4gICAgICAgICAgICAgICAgICAgIH0pO1xuICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgICAgICBpZihyZXMuc3RhdHVzID09IDIwMCkge1xuICAgICAgICAgICAgICAgICAgICAkKCcjYWRkTGFuZy1hamF4IGlucHV0JykudmFsKCcnKTtcbiAgICAgICAgICAgICAgICAgICAgJCgnI2FkZExhbmd1YWdlIC5hbGVydC1zdWNjZXNzJykucmVtb3ZlQ2xhc3MoJ2Qtbm9uZScpO1xuICAgICAgICAgICAgICAgICAgICAkKCcjYWRkTGFuZ3VhZ2UgLmFsZXJ0LXN1Y2Nlc3Mgc3Ryb25nJykudGV4dChyZXMuc3VjY2Vzcyk7XG4gICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgfSxcbiAgICAgICAgfSk7XG4gICAgfSk7XG5cbiAgICAkKCcjcmVmcmVzaCcpLmNsaWNrKGZ1bmN0aW9uKGUpIHtcbiAgICAgICBlLnByZXZlbnREZWZhdWx0KClcbiAgICAgICAgbG9jYXRpb24ucmVsb2FkKCk7XG4gICAgfSk7XG59KTtcbiJdLCJmaWxlIjoiLi9yZXNvdXJjZXMvanMvYmFjay9sYW5ndWFnZS5qcy5qcyIsInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///./resources/js/back/language.js\n");

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
=======
/******/ 	"use strict";
/******/
/******/
/******/ })()
;
>>>>>>> main
