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

eval("$(document).ready(function ($) {\n  var selectGame = $('.js-single-game');\n  selectGame.select2({\n    placeholder: 'Select a game'\n  });\n  selectGame.val(null).trigger('change');\n  var listTag = $('.js-add-server-tag');\n  listTag.select2({\n    placeholder: 'Select tags'\n  });\n\n  var _token = $('meta[name=\"csrf-token\"]').attr('content');\n\n  selectGame.on('change', function (e) {\n    e.preventDefault();\n    $.ajaxSetup({\n      headers: {\n        'X-CSRF-TOKEN': _token\n      }\n    });\n    var id = $('.js-single-game option:selected').val();\n    $.ajax({\n      url: \"/my-account/getGameTags/\" + id,\n      type: \"post\",\n      data: {\n        id: id,\n        _token: _token\n      },\n      success: function success(res) {\n        $('.js-add-server-tag option').remove();\n        $.each(res.success, function (i, item) {\n          listTag.append($('<option>', {\n            value: item.id,\n            text: item.name\n          }));\n        });\n      }\n    });\n  });\n  var listHost = $('.js-add-server-host');\n  listHost.select2({\n    placeholder: 'Select Country'\n  });\n  listHost.val(null).trigger('change');\n  var listLanguage = $('.js-add-server-lang');\n  listLanguage.select2({\n    placeholder: 'Select lang'\n  });\n  listLanguage.val(null).trigger('change');\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvanMvZnJvbnQuanM/MTRhOCJdLCJuYW1lcyI6WyIkIiwiZG9jdW1lbnQiLCJyZWFkeSIsInNlbGVjdEdhbWUiLCJzZWxlY3QyIiwicGxhY2Vob2xkZXIiLCJ2YWwiLCJ0cmlnZ2VyIiwibGlzdFRhZyIsIl90b2tlbiIsImF0dHIiLCJvbiIsImUiLCJwcmV2ZW50RGVmYXVsdCIsImFqYXhTZXR1cCIsImhlYWRlcnMiLCJpZCIsImFqYXgiLCJ1cmwiLCJ0eXBlIiwiZGF0YSIsInN1Y2Nlc3MiLCJyZXMiLCJyZW1vdmUiLCJlYWNoIiwiaSIsIml0ZW0iLCJhcHBlbmQiLCJ2YWx1ZSIsInRleHQiLCJuYW1lIiwibGlzdEhvc3QiLCJsaXN0TGFuZ3VhZ2UiXSwibWFwcGluZ3MiOiJBQUFBQSxDQUFDLENBQUNDLFFBQUQsQ0FBRCxDQUFZQyxLQUFaLENBQWtCLFVBQVNGLENBQVQsRUFBWTtBQUMxQixNQUFJRyxVQUFVLEdBQUdILENBQUMsQ0FBQyxpQkFBRCxDQUFsQjtBQUNJRyxFQUFBQSxVQUFVLENBQUNDLE9BQVgsQ0FBbUI7QUFDZkMsSUFBQUEsV0FBVyxFQUFFO0FBREUsR0FBbkI7QUFHSkYsRUFBQUEsVUFBVSxDQUFDRyxHQUFYLENBQWUsSUFBZixFQUFxQkMsT0FBckIsQ0FBNkIsUUFBN0I7QUFDQSxNQUFJQyxPQUFPLEdBQUdSLENBQUMsQ0FBQyxvQkFBRCxDQUFmO0FBQ0lRLEVBQUFBLE9BQU8sQ0FBQ0osT0FBUixDQUFnQjtBQUNaQyxJQUFBQSxXQUFXLEVBQUU7QUFERCxHQUFoQjs7QUFJSixNQUFJSSxNQUFNLEdBQUdULENBQUMsQ0FBQyx5QkFBRCxDQUFELENBQTZCVSxJQUE3QixDQUFrQyxTQUFsQyxDQUFiOztBQUNBUCxFQUFBQSxVQUFVLENBQUNRLEVBQVgsQ0FBYyxRQUFkLEVBQXVCLFVBQVNDLENBQVQsRUFBVztBQUM5QkEsSUFBQUEsQ0FBQyxDQUFDQyxjQUFGO0FBQ0FiLElBQUFBLENBQUMsQ0FBQ2MsU0FBRixDQUFZO0FBQ1JDLE1BQUFBLE9BQU8sRUFBRTtBQUNMLHdCQUFnQk47QUFEWDtBQURELEtBQVo7QUFLQSxRQUFJTyxFQUFFLEdBQUdoQixDQUFDLENBQUMsaUNBQUQsQ0FBRCxDQUFxQ00sR0FBckMsRUFBVDtBQUNBTixJQUFBQSxDQUFDLENBQUNpQixJQUFGLENBQU87QUFDSEMsTUFBQUEsR0FBRyxFQUFFLDZCQUE2QkYsRUFEL0I7QUFFSEcsTUFBQUEsSUFBSSxFQUFFLE1BRkg7QUFHSEMsTUFBQUEsSUFBSSxFQUFFO0FBQ0ZKLFFBQUFBLEVBQUUsRUFBRUEsRUFERjtBQUVGUCxRQUFBQSxNQUFNLEVBQUVBO0FBRk4sT0FISDtBQU9IWSxNQUFBQSxPQUFPLEVBQUUsaUJBQVNDLEdBQVQsRUFBYTtBQUNsQnRCLFFBQUFBLENBQUMsQ0FBQywyQkFBRCxDQUFELENBQStCdUIsTUFBL0I7QUFDQXZCLFFBQUFBLENBQUMsQ0FBQ3dCLElBQUYsQ0FBT0YsR0FBRyxDQUFDRCxPQUFYLEVBQW9CLFVBQUNJLENBQUQsRUFBSUMsSUFBSixFQUFhO0FBQzdCbEIsVUFBQUEsT0FBTyxDQUFDbUIsTUFBUixDQUFlM0IsQ0FBQyxDQUFDLFVBQUQsRUFBYTtBQUN6QjRCLFlBQUFBLEtBQUssRUFBRUYsSUFBSSxDQUFDVixFQURhO0FBRXpCYSxZQUFBQSxJQUFJLEVBQUdILElBQUksQ0FBQ0k7QUFGYSxXQUFiLENBQWhCO0FBSUgsU0FMRDtBQU1IO0FBZkUsS0FBUDtBQWlCSCxHQXpCRDtBQTJCQSxNQUFJQyxRQUFRLEdBQUcvQixDQUFDLENBQUMscUJBQUQsQ0FBaEI7QUFDQStCLEVBQUFBLFFBQVEsQ0FBQzNCLE9BQVQsQ0FBaUI7QUFDYkMsSUFBQUEsV0FBVyxFQUFFO0FBREEsR0FBakI7QUFHQTBCLEVBQUFBLFFBQVEsQ0FBQ3pCLEdBQVQsQ0FBYSxJQUFiLEVBQW1CQyxPQUFuQixDQUEyQixRQUEzQjtBQUVBLE1BQUl5QixZQUFZLEdBQUdoQyxDQUFDLENBQUMscUJBQUQsQ0FBcEI7QUFDQWdDLEVBQUFBLFlBQVksQ0FBQzVCLE9BQWIsQ0FBcUI7QUFDakJDLElBQUFBLFdBQVcsRUFBRTtBQURJLEdBQXJCO0FBR0EyQixFQUFBQSxZQUFZLENBQUMxQixHQUFiLENBQWlCLElBQWpCLEVBQXVCQyxPQUF2QixDQUErQixRQUEvQjtBQUNILENBbEREIiwic291cmNlc0NvbnRlbnQiOlsiJChkb2N1bWVudCkucmVhZHkoZnVuY3Rpb24oJCkge1xyXG4gICAgbGV0IHNlbGVjdEdhbWUgPSAkKCcuanMtc2luZ2xlLWdhbWUnKTtcclxuICAgICAgICBzZWxlY3RHYW1lLnNlbGVjdDIoe1xyXG4gICAgICAgICAgICBwbGFjZWhvbGRlcjogJ1NlbGVjdCBhIGdhbWUnXHJcbiAgICAgICAgfSk7XHJcbiAgICBzZWxlY3RHYW1lLnZhbChudWxsKS50cmlnZ2VyKCdjaGFuZ2UnKTtcclxuICAgIGxldCBsaXN0VGFnID0gJCgnLmpzLWFkZC1zZXJ2ZXItdGFnJylcclxuICAgICAgICBsaXN0VGFnLnNlbGVjdDIoe1xyXG4gICAgICAgICAgICBwbGFjZWhvbGRlcjogJ1NlbGVjdCB0YWdzJ1xyXG4gICAgICAgIH0pO1xyXG5cclxuICAgIGxldCBfdG9rZW4gPSAkKCdtZXRhW25hbWU9XCJjc3JmLXRva2VuXCJdJykuYXR0cignY29udGVudCcpXHJcbiAgICBzZWxlY3RHYW1lLm9uKCdjaGFuZ2UnLGZ1bmN0aW9uKGUpe1xyXG4gICAgICAgIGUucHJldmVudERlZmF1bHQoKTtcclxuICAgICAgICAkLmFqYXhTZXR1cCh7XHJcbiAgICAgICAgICAgIGhlYWRlcnM6IHtcclxuICAgICAgICAgICAgICAgICdYLUNTUkYtVE9LRU4nOiBfdG9rZW5cclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH0pO1xyXG4gICAgICAgIGxldCBpZCA9ICQoJy5qcy1zaW5nbGUtZ2FtZSBvcHRpb246c2VsZWN0ZWQnKS52YWwoKVxyXG4gICAgICAgICQuYWpheCh7XHJcbiAgICAgICAgICAgIHVybDogXCIvbXktYWNjb3VudC9nZXRHYW1lVGFncy9cIiArIGlkLFxyXG4gICAgICAgICAgICB0eXBlOiBcInBvc3RcIixcclxuICAgICAgICAgICAgZGF0YToge1xyXG4gICAgICAgICAgICAgICAgaWQ6IGlkLFxyXG4gICAgICAgICAgICAgICAgX3Rva2VuOiBfdG9rZW5cclxuICAgICAgICAgICAgfSxcclxuICAgICAgICAgICAgc3VjY2VzczogZnVuY3Rpb24ocmVzKXtcclxuICAgICAgICAgICAgICAgICQoJy5qcy1hZGQtc2VydmVyLXRhZyBvcHRpb24nKS5yZW1vdmUoKTtcclxuICAgICAgICAgICAgICAgICQuZWFjaChyZXMuc3VjY2VzcywgKGksIGl0ZW0pID0+IHtcclxuICAgICAgICAgICAgICAgICAgICBsaXN0VGFnLmFwcGVuZCgkKCc8b3B0aW9uPicsIHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgdmFsdWU6IGl0ZW0uaWQsXHJcbiAgICAgICAgICAgICAgICAgICAgICAgIHRleHQgOiBpdGVtLm5hbWVcclxuICAgICAgICAgICAgICAgICAgICB9KSk7XHJcbiAgICAgICAgICAgICAgICB9KTtcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH0pO1xyXG4gICAgfSk7XHJcblxyXG4gICAgbGV0IGxpc3RIb3N0ID0gJCgnLmpzLWFkZC1zZXJ2ZXItaG9zdCcpO1xyXG4gICAgbGlzdEhvc3Quc2VsZWN0Mih7XHJcbiAgICAgICAgcGxhY2Vob2xkZXI6ICdTZWxlY3QgQ291bnRyeScsXHJcbiAgICB9KTtcclxuICAgIGxpc3RIb3N0LnZhbChudWxsKS50cmlnZ2VyKCdjaGFuZ2UnKTtcclxuXHJcbiAgICBsZXQgbGlzdExhbmd1YWdlID0gJCgnLmpzLWFkZC1zZXJ2ZXItbGFuZycpO1xyXG4gICAgbGlzdExhbmd1YWdlLnNlbGVjdDIoe1xyXG4gICAgICAgIHBsYWNlaG9sZGVyOiAnU2VsZWN0IGxhbmcnLFxyXG4gICAgfSk7XHJcbiAgICBsaXN0TGFuZ3VhZ2UudmFsKG51bGwpLnRyaWdnZXIoJ2NoYW5nZScpO1xyXG59KTtcclxuIl0sImZpbGUiOiIuL3Jlc291cmNlcy9qcy9mcm9udC5qcy5qcyIsInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///./resources/js/front.js\n");

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