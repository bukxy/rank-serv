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

/***/ "./resources/js/front.js":
/*!*******************************!*\
  !*** ./resources/js/front.js ***!
  \*******************************/
/***/ (() => {

eval("$(document).ready(function ($) {\n  var selectGame = $('.js-single-game');\n  selectGame.select2({\n    placeholder: 'Select a game'\n  });\n  selectGame.val(null).trigger('change');\n  var listTag = $('.js-add-server-tag');\n  listTag.select2({\n    placeholder: 'Select tags'\n  });\n\n  var _token = $('meta[name=\"csrf-token\"]').attr('content');\n\n  selectGame.on('change', function (e) {\n    e.preventDefault();\n    $.ajaxSetup({\n      headers: {\n        'X-CSRF-TOKEN': _token\n      }\n    });\n    var id = $('.js-single-game option:selected').val();\n    $.ajax({\n      url: \"/my-account/getGameTags/\" + id,\n      type: \"post\",\n      data: {\n        id: id,\n        _token: _token\n      },\n      success: function success(res) {\n        $('.js-add-server-tag option').remove();\n        $.each(res.success, function (i, item) {\n          listTag.append($('<option>', {\n            value: item.id,\n            text: item.name\n          }));\n        });\n      }\n    });\n  });\n  var listHost = $('.js-add-server-host');\n  listHost.select2({\n    placeholder: 'Select Country'\n  });\n  listHost.val(null).trigger('change');\n  var listLanguage = $('.js-add-server-lang');\n  listLanguage.select2({\n    placeholder: 'Select lang'\n  });\n  listLanguage.val(null).trigger('change');\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvanMvZnJvbnQuanM/MTRhOCJdLCJuYW1lcyI6WyIkIiwiZG9jdW1lbnQiLCJyZWFkeSIsInNlbGVjdEdhbWUiLCJzZWxlY3QyIiwicGxhY2Vob2xkZXIiLCJ2YWwiLCJ0cmlnZ2VyIiwibGlzdFRhZyIsIl90b2tlbiIsImF0dHIiLCJvbiIsImUiLCJwcmV2ZW50RGVmYXVsdCIsImFqYXhTZXR1cCIsImhlYWRlcnMiLCJpZCIsImFqYXgiLCJ1cmwiLCJ0eXBlIiwiZGF0YSIsInN1Y2Nlc3MiLCJyZXMiLCJyZW1vdmUiLCJlYWNoIiwiaSIsIml0ZW0iLCJhcHBlbmQiLCJ2YWx1ZSIsInRleHQiLCJuYW1lIiwibGlzdEhvc3QiLCJsaXN0TGFuZ3VhZ2UiXSwibWFwcGluZ3MiOiJBQUFBQSxDQUFDLENBQUNDLFFBQUQsQ0FBRCxDQUFZQyxLQUFaLENBQWtCLFVBQVNGLENBQVQsRUFBWTtBQUMxQixNQUFJRyxVQUFVLEdBQUdILENBQUMsQ0FBQyxpQkFBRCxDQUFsQjtBQUNJRyxFQUFBQSxVQUFVLENBQUNDLE9BQVgsQ0FBbUI7QUFDZkMsSUFBQUEsV0FBVyxFQUFFO0FBREUsR0FBbkI7QUFHSkYsRUFBQUEsVUFBVSxDQUFDRyxHQUFYLENBQWUsSUFBZixFQUFxQkMsT0FBckIsQ0FBNkIsUUFBN0I7QUFDQSxNQUFJQyxPQUFPLEdBQUdSLENBQUMsQ0FBQyxvQkFBRCxDQUFmO0FBQ0lRLEVBQUFBLE9BQU8sQ0FBQ0osT0FBUixDQUFnQjtBQUNaQyxJQUFBQSxXQUFXLEVBQUU7QUFERCxHQUFoQjs7QUFJSixNQUFJSSxNQUFNLEdBQUdULENBQUMsQ0FBQyx5QkFBRCxDQUFELENBQTZCVSxJQUE3QixDQUFrQyxTQUFsQyxDQUFiOztBQUNBUCxFQUFBQSxVQUFVLENBQUNRLEVBQVgsQ0FBYyxRQUFkLEVBQXVCLFVBQVNDLENBQVQsRUFBVztBQUM5QkEsSUFBQUEsQ0FBQyxDQUFDQyxjQUFGO0FBQ0FiLElBQUFBLENBQUMsQ0FBQ2MsU0FBRixDQUFZO0FBQ1JDLE1BQUFBLE9BQU8sRUFBRTtBQUNMLHdCQUFnQk47QUFEWDtBQURELEtBQVo7QUFLQSxRQUFJTyxFQUFFLEdBQUdoQixDQUFDLENBQUMsaUNBQUQsQ0FBRCxDQUFxQ00sR0FBckMsRUFBVDtBQUNBTixJQUFBQSxDQUFDLENBQUNpQixJQUFGLENBQU87QUFDSEMsTUFBQUEsR0FBRyxFQUFFLDZCQUE2QkYsRUFEL0I7QUFFSEcsTUFBQUEsSUFBSSxFQUFFLE1BRkg7QUFHSEMsTUFBQUEsSUFBSSxFQUFFO0FBQ0ZKLFFBQUFBLEVBQUUsRUFBRUEsRUFERjtBQUVGUCxRQUFBQSxNQUFNLEVBQUVBO0FBRk4sT0FISDtBQU9IWSxNQUFBQSxPQUFPLEVBQUUsaUJBQVNDLEdBQVQsRUFBYTtBQUNsQnRCLFFBQUFBLENBQUMsQ0FBQywyQkFBRCxDQUFELENBQStCdUIsTUFBL0I7QUFDQXZCLFFBQUFBLENBQUMsQ0FBQ3dCLElBQUYsQ0FBT0YsR0FBRyxDQUFDRCxPQUFYLEVBQW9CLFVBQUNJLENBQUQsRUFBSUMsSUFBSixFQUFhO0FBQzdCbEIsVUFBQUEsT0FBTyxDQUFDbUIsTUFBUixDQUFlM0IsQ0FBQyxDQUFDLFVBQUQsRUFBYTtBQUN6QjRCLFlBQUFBLEtBQUssRUFBRUYsSUFBSSxDQUFDVixFQURhO0FBRXpCYSxZQUFBQSxJQUFJLEVBQUdILElBQUksQ0FBQ0k7QUFGYSxXQUFiLENBQWhCO0FBSUgsU0FMRDtBQU1IO0FBZkUsS0FBUDtBQWlCSCxHQXpCRDtBQTJCQSxNQUFJQyxRQUFRLEdBQUcvQixDQUFDLENBQUMscUJBQUQsQ0FBaEI7QUFDQStCLEVBQUFBLFFBQVEsQ0FBQzNCLE9BQVQsQ0FBaUI7QUFDYkMsSUFBQUEsV0FBVyxFQUFFO0FBREEsR0FBakI7QUFHQTBCLEVBQUFBLFFBQVEsQ0FBQ3pCLEdBQVQsQ0FBYSxJQUFiLEVBQW1CQyxPQUFuQixDQUEyQixRQUEzQjtBQUVBLE1BQUl5QixZQUFZLEdBQUdoQyxDQUFDLENBQUMscUJBQUQsQ0FBcEI7QUFDQWdDLEVBQUFBLFlBQVksQ0FBQzVCLE9BQWIsQ0FBcUI7QUFDakJDLElBQUFBLFdBQVcsRUFBRTtBQURJLEdBQXJCO0FBR0EyQixFQUFBQSxZQUFZLENBQUMxQixHQUFiLENBQWlCLElBQWpCLEVBQXVCQyxPQUF2QixDQUErQixRQUEvQjtBQUNILENBbEREIiwic291cmNlc0NvbnRlbnQiOlsiJChkb2N1bWVudCkucmVhZHkoZnVuY3Rpb24oJCkge1xuICAgIGxldCBzZWxlY3RHYW1lID0gJCgnLmpzLXNpbmdsZS1nYW1lJyk7XG4gICAgICAgIHNlbGVjdEdhbWUuc2VsZWN0Mih7XG4gICAgICAgICAgICBwbGFjZWhvbGRlcjogJ1NlbGVjdCBhIGdhbWUnXG4gICAgICAgIH0pO1xuICAgIHNlbGVjdEdhbWUudmFsKG51bGwpLnRyaWdnZXIoJ2NoYW5nZScpO1xuICAgIGxldCBsaXN0VGFnID0gJCgnLmpzLWFkZC1zZXJ2ZXItdGFnJylcbiAgICAgICAgbGlzdFRhZy5zZWxlY3QyKHtcbiAgICAgICAgICAgIHBsYWNlaG9sZGVyOiAnU2VsZWN0IHRhZ3MnXG4gICAgICAgIH0pO1xuXG4gICAgbGV0IF90b2tlbiA9ICQoJ21ldGFbbmFtZT1cImNzcmYtdG9rZW5cIl0nKS5hdHRyKCdjb250ZW50JylcbiAgICBzZWxlY3RHYW1lLm9uKCdjaGFuZ2UnLGZ1bmN0aW9uKGUpe1xuICAgICAgICBlLnByZXZlbnREZWZhdWx0KCk7XG4gICAgICAgICQuYWpheFNldHVwKHtcbiAgICAgICAgICAgIGhlYWRlcnM6IHtcbiAgICAgICAgICAgICAgICAnWC1DU1JGLVRPS0VOJzogX3Rva2VuXG4gICAgICAgICAgICB9XG4gICAgICAgIH0pO1xuICAgICAgICBsZXQgaWQgPSAkKCcuanMtc2luZ2xlLWdhbWUgb3B0aW9uOnNlbGVjdGVkJykudmFsKClcbiAgICAgICAgJC5hamF4KHtcbiAgICAgICAgICAgIHVybDogXCIvbXktYWNjb3VudC9nZXRHYW1lVGFncy9cIiArIGlkLFxuICAgICAgICAgICAgdHlwZTogXCJwb3N0XCIsXG4gICAgICAgICAgICBkYXRhOiB7XG4gICAgICAgICAgICAgICAgaWQ6IGlkLFxuICAgICAgICAgICAgICAgIF90b2tlbjogX3Rva2VuXG4gICAgICAgICAgICB9LFxuICAgICAgICAgICAgc3VjY2VzczogZnVuY3Rpb24ocmVzKXtcbiAgICAgICAgICAgICAgICAkKCcuanMtYWRkLXNlcnZlci10YWcgb3B0aW9uJykucmVtb3ZlKCk7XG4gICAgICAgICAgICAgICAgJC5lYWNoKHJlcy5zdWNjZXNzLCAoaSwgaXRlbSkgPT4ge1xuICAgICAgICAgICAgICAgICAgICBsaXN0VGFnLmFwcGVuZCgkKCc8b3B0aW9uPicsIHtcbiAgICAgICAgICAgICAgICAgICAgICAgIHZhbHVlOiBpdGVtLmlkLFxuICAgICAgICAgICAgICAgICAgICAgICAgdGV4dCA6IGl0ZW0ubmFtZVxuICAgICAgICAgICAgICAgICAgICB9KSk7XG4gICAgICAgICAgICAgICAgfSk7XG4gICAgICAgICAgICB9XG4gICAgICAgIH0pO1xuICAgIH0pO1xuXG4gICAgbGV0IGxpc3RIb3N0ID0gJCgnLmpzLWFkZC1zZXJ2ZXItaG9zdCcpO1xuICAgIGxpc3RIb3N0LnNlbGVjdDIoe1xuICAgICAgICBwbGFjZWhvbGRlcjogJ1NlbGVjdCBDb3VudHJ5JyxcbiAgICB9KTtcbiAgICBsaXN0SG9zdC52YWwobnVsbCkudHJpZ2dlcignY2hhbmdlJyk7XG5cbiAgICBsZXQgbGlzdExhbmd1YWdlID0gJCgnLmpzLWFkZC1zZXJ2ZXItbGFuZycpO1xuICAgIGxpc3RMYW5ndWFnZS5zZWxlY3QyKHtcbiAgICAgICAgcGxhY2Vob2xkZXI6ICdTZWxlY3QgbGFuZycsXG4gICAgfSk7XG4gICAgbGlzdExhbmd1YWdlLnZhbChudWxsKS50cmlnZ2VyKCdjaGFuZ2UnKTtcbn0pO1xuIl0sImZpbGUiOiIuL3Jlc291cmNlcy9qcy9mcm9udC5qcy5qcyIsInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///./resources/js/front.js\n");

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
=======
/******/ 	"use strict";
/******/
/******/
/******/ })()
;
>>>>>>> main
