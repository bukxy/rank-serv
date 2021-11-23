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

/***/ "./resources/js/front.js":
/*!*******************************!*\
  !*** ./resources/js/front.js ***!
  \*******************************/
/***/ (() => {

eval("$(document).ready(function () {\n  var selectGame = $('.js-single-game');\n  selectGame.select2({\n    placeholder: 'Select a game'\n  });\n  selectGame.val(null).trigger('change');\n  var listTag = $('.js-add-server-tag');\n  listTag.select2({\n    placeholder: 'Select tags'\n  });\n  selectGame.on('change', function (e) {\n    e.preventDefault();\n\n    var _token = $('meta[name=\"csrf-token\"]').attr('content');\n\n    $.ajaxSetup({\n      headers: {\n        'X-CSRF-TOKEN': _token\n      }\n    });\n    var id = $('.js-single-game option:selected').val();\n    $.ajax({\n      url: \"/my-account/getGameTags/\" + id,\n      type: \"post\",\n      data: {\n        id: id,\n        _token: _token\n      },\n      success: function success(res) {\n        $('.js-add-server-tag option').remove();\n        $.each(res.success, function (i, item) {\n          listTag.append($('<option>', {\n            value: item.id,\n            text: item.name\n          }));\n        });\n      }\n    });\n  });\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvanMvZnJvbnQuanM/MTRhOCJdLCJuYW1lcyI6WyIkIiwiZG9jdW1lbnQiLCJyZWFkeSIsInNlbGVjdEdhbWUiLCJzZWxlY3QyIiwicGxhY2Vob2xkZXIiLCJ2YWwiLCJ0cmlnZ2VyIiwibGlzdFRhZyIsIm9uIiwiZSIsInByZXZlbnREZWZhdWx0IiwiX3Rva2VuIiwiYXR0ciIsImFqYXhTZXR1cCIsImhlYWRlcnMiLCJpZCIsImFqYXgiLCJ1cmwiLCJ0eXBlIiwiZGF0YSIsInN1Y2Nlc3MiLCJyZXMiLCJyZW1vdmUiLCJlYWNoIiwiaSIsIml0ZW0iLCJhcHBlbmQiLCJ2YWx1ZSIsInRleHQiLCJuYW1lIl0sIm1hcHBpbmdzIjoiQUFBQUEsQ0FBQyxDQUFDQyxRQUFELENBQUQsQ0FBWUMsS0FBWixDQUFrQixZQUFXO0FBQ3pCLE1BQUlDLFVBQVUsR0FBR0gsQ0FBQyxDQUFDLGlCQUFELENBQWxCO0FBQ0lHLEVBQUFBLFVBQVUsQ0FBQ0MsT0FBWCxDQUFtQjtBQUNmQyxJQUFBQSxXQUFXLEVBQUU7QUFERSxHQUFuQjtBQUdKRixFQUFBQSxVQUFVLENBQUNHLEdBQVgsQ0FBZSxJQUFmLEVBQXFCQyxPQUFyQixDQUE2QixRQUE3QjtBQUNBLE1BQUlDLE9BQU8sR0FBR1IsQ0FBQyxDQUFDLG9CQUFELENBQWY7QUFDSVEsRUFBQUEsT0FBTyxDQUFDSixPQUFSLENBQWdCO0FBQ1pDLElBQUFBLFdBQVcsRUFBRTtBQURELEdBQWhCO0FBSUpGLEVBQUFBLFVBQVUsQ0FBQ00sRUFBWCxDQUFjLFFBQWQsRUFBdUIsVUFBU0MsQ0FBVCxFQUFXO0FBQzlCQSxJQUFBQSxDQUFDLENBQUNDLGNBQUY7O0FBQ0EsUUFBSUMsTUFBTSxHQUFHWixDQUFDLENBQUMseUJBQUQsQ0FBRCxDQUE2QmEsSUFBN0IsQ0FBa0MsU0FBbEMsQ0FBYjs7QUFDQWIsSUFBQUEsQ0FBQyxDQUFDYyxTQUFGLENBQVk7QUFDUkMsTUFBQUEsT0FBTyxFQUFFO0FBQ0wsd0JBQWdCSDtBQURYO0FBREQsS0FBWjtBQUtBLFFBQUlJLEVBQUUsR0FBR2hCLENBQUMsQ0FBQyxpQ0FBRCxDQUFELENBQXFDTSxHQUFyQyxFQUFUO0FBQ0FOLElBQUFBLENBQUMsQ0FBQ2lCLElBQUYsQ0FBTztBQUNIQyxNQUFBQSxHQUFHLEVBQUUsNkJBQTZCRixFQUQvQjtBQUVIRyxNQUFBQSxJQUFJLEVBQUUsTUFGSDtBQUdIQyxNQUFBQSxJQUFJLEVBQUU7QUFDRkosUUFBQUEsRUFBRSxFQUFFQSxFQURGO0FBRUZKLFFBQUFBLE1BQU0sRUFBRUE7QUFGTixPQUhIO0FBT0hTLE1BQUFBLE9BQU8sRUFBRSxpQkFBU0MsR0FBVCxFQUFhO0FBQ2xCdEIsUUFBQUEsQ0FBQyxDQUFDLDJCQUFELENBQUQsQ0FBK0J1QixNQUEvQjtBQUNBdkIsUUFBQUEsQ0FBQyxDQUFDd0IsSUFBRixDQUFPRixHQUFHLENBQUNELE9BQVgsRUFBb0IsVUFBQ0ksQ0FBRCxFQUFJQyxJQUFKLEVBQWE7QUFDN0JsQixVQUFBQSxPQUFPLENBQUNtQixNQUFSLENBQWUzQixDQUFDLENBQUMsVUFBRCxFQUFhO0FBQ3pCNEIsWUFBQUEsS0FBSyxFQUFFRixJQUFJLENBQUNWLEVBRGE7QUFFekJhLFlBQUFBLElBQUksRUFBR0gsSUFBSSxDQUFDSTtBQUZhLFdBQWIsQ0FBaEI7QUFJSCxTQUxEO0FBTUg7QUFmRSxLQUFQO0FBaUJILEdBMUJEO0FBMkJILENBdENEIiwic291cmNlc0NvbnRlbnQiOlsiJChkb2N1bWVudCkucmVhZHkoZnVuY3Rpb24oKSB7XG4gICAgbGV0IHNlbGVjdEdhbWUgPSAkKCcuanMtc2luZ2xlLWdhbWUnKTtcbiAgICAgICAgc2VsZWN0R2FtZS5zZWxlY3QyKHtcbiAgICAgICAgICAgIHBsYWNlaG9sZGVyOiAnU2VsZWN0IGEgZ2FtZSdcbiAgICAgICAgfSk7XG4gICAgc2VsZWN0R2FtZS52YWwobnVsbCkudHJpZ2dlcignY2hhbmdlJyk7XG4gICAgbGV0IGxpc3RUYWcgPSAkKCcuanMtYWRkLXNlcnZlci10YWcnKVxuICAgICAgICBsaXN0VGFnLnNlbGVjdDIoe1xuICAgICAgICAgICAgcGxhY2Vob2xkZXI6ICdTZWxlY3QgdGFncydcbiAgICAgICAgfSk7XG5cbiAgICBzZWxlY3RHYW1lLm9uKCdjaGFuZ2UnLGZ1bmN0aW9uKGUpe1xuICAgICAgICBlLnByZXZlbnREZWZhdWx0KCk7XG4gICAgICAgIGxldCBfdG9rZW4gPSAkKCdtZXRhW25hbWU9XCJjc3JmLXRva2VuXCJdJykuYXR0cignY29udGVudCcpXG4gICAgICAgICQuYWpheFNldHVwKHtcbiAgICAgICAgICAgIGhlYWRlcnM6IHtcbiAgICAgICAgICAgICAgICAnWC1DU1JGLVRPS0VOJzogX3Rva2VuXG4gICAgICAgICAgICB9XG4gICAgICAgIH0pO1xuICAgICAgICBsZXQgaWQgPSAkKCcuanMtc2luZ2xlLWdhbWUgb3B0aW9uOnNlbGVjdGVkJykudmFsKClcbiAgICAgICAgJC5hamF4KHtcbiAgICAgICAgICAgIHVybDogXCIvbXktYWNjb3VudC9nZXRHYW1lVGFncy9cIiArIGlkLFxuICAgICAgICAgICAgdHlwZTogXCJwb3N0XCIsXG4gICAgICAgICAgICBkYXRhOiB7XG4gICAgICAgICAgICAgICAgaWQ6IGlkLFxuICAgICAgICAgICAgICAgIF90b2tlbjogX3Rva2VuXG4gICAgICAgICAgICB9LFxuICAgICAgICAgICAgc3VjY2VzczogZnVuY3Rpb24ocmVzKXtcbiAgICAgICAgICAgICAgICAkKCcuanMtYWRkLXNlcnZlci10YWcgb3B0aW9uJykucmVtb3ZlKCk7XG4gICAgICAgICAgICAgICAgJC5lYWNoKHJlcy5zdWNjZXNzLCAoaSwgaXRlbSkgPT4ge1xuICAgICAgICAgICAgICAgICAgICBsaXN0VGFnLmFwcGVuZCgkKCc8b3B0aW9uPicsIHtcbiAgICAgICAgICAgICAgICAgICAgICAgIHZhbHVlOiBpdGVtLmlkLFxuICAgICAgICAgICAgICAgICAgICAgICAgdGV4dCA6IGl0ZW0ubmFtZVxuICAgICAgICAgICAgICAgICAgICB9KSk7XG4gICAgICAgICAgICAgICAgfSk7XG4gICAgICAgICAgICB9XG4gICAgICAgIH0pO1xuICAgIH0pO1xufSk7XG4iXSwiZmlsZSI6Ii4vcmVzb3VyY2VzL2pzL2Zyb250LmpzLmpzIiwic291cmNlUm9vdCI6IiJ9\n//# sourceURL=webpack-internal:///./resources/js/front.js\n");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval-source-map devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./resources/js/front.js"]();
/******/ 	
/******/ })()
;