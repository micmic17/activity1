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

/***/ "./resources/js/admin/employees.js":
/*!*****************************************!*\
  !*** ./resources/js/admin/employees.js ***!
  \*****************************************/
/***/ (() => {

eval("window.onload = function (event) {\n  addEmployee();\n};\n\nvar addEmployee = function addEmployee() {\n  var validationField = document.getElementById('validationField');\n  var ul = validationField.firstElementChild;\n  $('#add_employee_modal').on('submit', function (e) {\n    e.preventDefault();\n    e.originalEvent.submitter.setAttribute(\"disabled\", true);\n    var form = $('#add_employee_modal');\n    var data = form.serialize();\n    removeValidationMessage();\n    axios({\n      method: 'post',\n      url: '/employee',\n      data: data\n    }).then(function (response) {\n      if (response.status === 200) {\n        form[0].reset();\n        addMessage(['Successfully added an employee'], 'success');\n        setTimeout(function () {\n          window.location.reload();\n        }, 1500);\n      }\n    })[\"catch\"](function (error) {\n      e.originalEvent.submitter.removeAttribute(\"disabled\");\n      var validationField = document.getElementById('validationField');\n\n      if (Object.keys(error.response.data.errors).length > 0) {\n        var errors = Object.values(error.response.data.errors);\n        addMessage(errors, 'error');\n      }\n    });\n  });\n\n  var addMessage = function addMessage() {\n    var message = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : [];\n    var type = arguments.length > 1 ? arguments[1] : undefined;\n    validationField.classList.remove('d-none');\n\n    if (type == 'success') {\n      validationField.classList.add('alert-success');\n\n      for (var i = 0; i < message.length; i++) {\n        var li = document.createElement('li');\n        li.textContent = message[i];\n        ul.appendChild(li);\n      }\n    } else {\n      validationField.classList.add('alert-danger');\n\n      for (var _i = 0; _i < message.length; _i++) {\n        var _li = document.createElement('li');\n\n        _li.textContent = message[_i];\n        ul.appendChild(_li);\n      }\n    }\n  };\n\n  var removeValidationMessage = function removeValidationMessage() {\n    if (ul.childElementCount > 0) {\n      validationField.classList.remove('alert-danger', 'alert-success');\n\n      while (ul.firstChild && !ul.firstChild.remove()) {\n        ;\n      }\n    }\n  };\n};//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvanMvYWRtaW4vZW1wbG95ZWVzLmpzPzZmMDgiXSwibmFtZXMiOlsid2luZG93Iiwib25sb2FkIiwiZXZlbnQiLCJhZGRFbXBsb3llZSIsInZhbGlkYXRpb25GaWVsZCIsImRvY3VtZW50IiwiZ2V0RWxlbWVudEJ5SWQiLCJ1bCIsImZpcnN0RWxlbWVudENoaWxkIiwiJCIsIm9uIiwiZSIsInByZXZlbnREZWZhdWx0Iiwib3JpZ2luYWxFdmVudCIsInN1Ym1pdHRlciIsInNldEF0dHJpYnV0ZSIsImZvcm0iLCJkYXRhIiwic2VyaWFsaXplIiwicmVtb3ZlVmFsaWRhdGlvbk1lc3NhZ2UiLCJheGlvcyIsIm1ldGhvZCIsInVybCIsInRoZW4iLCJyZXNwb25zZSIsInN0YXR1cyIsInJlc2V0IiwiYWRkTWVzc2FnZSIsInNldFRpbWVvdXQiLCJsb2NhdGlvbiIsInJlbG9hZCIsImVycm9yIiwicmVtb3ZlQXR0cmlidXRlIiwiT2JqZWN0Iiwia2V5cyIsImVycm9ycyIsImxlbmd0aCIsInZhbHVlcyIsIm1lc3NhZ2UiLCJ0eXBlIiwiY2xhc3NMaXN0IiwicmVtb3ZlIiwiYWRkIiwiaSIsImxpIiwiY3JlYXRlRWxlbWVudCIsInRleHRDb250ZW50IiwiYXBwZW5kQ2hpbGQiLCJjaGlsZEVsZW1lbnRDb3VudCIsImZpcnN0Q2hpbGQiXSwibWFwcGluZ3MiOiJBQUFBQSxNQUFNLENBQUNDLE1BQVAsR0FBZ0IsVUFBQ0MsS0FBRCxFQUFXO0FBQ3pCQyxFQUFBQSxXQUFXO0FBQ1osQ0FGRDs7QUFJQSxJQUFJQSxXQUFXLEdBQUcsU0FBZEEsV0FBYyxHQUFNO0FBQ3RCLE1BQUlDLGVBQWUsR0FBR0MsUUFBUSxDQUFDQyxjQUFULENBQXdCLGlCQUF4QixDQUF0QjtBQUNBLE1BQUlDLEVBQUUsR0FBR0gsZUFBZSxDQUFDSSxpQkFBekI7QUFFQUMsRUFBQUEsQ0FBQyxDQUFDLHFCQUFELENBQUQsQ0FBeUJDLEVBQXpCLENBQTRCLFFB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QUFPLENBQUNLLEVBQUQsQ0FBeEI7QUFFQXBDLFFBQUFBLEVBQUUsQ0FBQ3dDLFdBQUgsQ0FBZUgsR0FBZjtBQUNEO0FBQ0Y7QUFDRixHQXJCRDs7QUF1QkEsTUFBSXpCLHVCQUF1QixHQUFHLFNBQTFCQSx1QkFBMEIsR0FBTTtBQUNsQyxRQUFJWixFQUFFLENBQUN5QyxpQkFBSCxHQUF1QixDQUEzQixFQUE4QjtBQUM1QjVDLE1BQUFBLGVBQWUsQ0FBQ29DLFNBQWhCLENBQTBCQyxNQUExQixDQUFpQyxjQUFqQyxFQUFpRCxlQUFqRDs7QUFDQSxhQUFPbEMsRUFBRSxDQUFDMEMsVUFBSCxJQUFpQixDQUFDMUMsRUFBRSxDQUFDMEMsVUFBSCxDQUFjUixNQUFkLEVBQXpCO0FBQWdEO0FBQWhEO0FBQ0Q7QUFDRixHQUxEO0FBTUQsQ0FuRUQiLCJzb3VyY2VzQ29udGVudCI6WyJ3aW5kb3cub25sb2FkID0gKGV2ZW50KSA9PiB7XG4gIGFkZEVtcGxveWVlKCk7XG59O1xuXG5sZXQgYWRkRW1wbG95ZWUgPSAoKSA9PiB7XG4gIGxldCB2YWxpZGF0aW9uRmllbGQgPSBkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgndmFsaWRhdGlvbkZpZWxkJyk7XG4gIGxldCB1bCA9IHZhbGlkYXRpb25GaWVsZC5maXJzdEVsZW1lbnRDaGlsZDtcblxuICAkKCcjYWRkX2VtcGxveWVlX21vZGFsJykub24oJ3N1Ym1pdCcsIChlKSA9PiB7XG4gICAgZS5wcmV2ZW50RGVmYXVsdCgpO1xuICAgIGUub3JpZ2luYWxFdmVudC5zdWJtaXR0ZXIuc2V0QXR0cmlidXRlKFwiZGlzYWJsZWRcIiwgdHJ1ZSk7XG4gICAgbGV0IGZvcm0gPSAkKCcjYWRkX2VtcGxveWVlX21vZGFsJyk7XG4gICAgbGV0IGRhdGEgPSBmb3JtLnNlcmlhbGl6ZSgpO1xuXG4gICAgcmVtb3ZlVmFsaWRhdGlvbk1lc3NhZ2UoKTtcblxuICAgIGF4aW9zKHtcbiAgICAgICAgbWV0aG9kOiAncG9zdCcsXG4gICAgICAgIHVybDogJy9lbXBsb3llZScsXG4gICAgICAgIGRhdGFcbiAgICAgIH0pLnRoZW4oZnVuY3Rpb24ocmVzcG9uc2UpIHtcbiAgICAgICAgaWYgKHJlc3BvbnNlLnN0YXR1cyA9PT0gMjAwKSB7XG4gICAgICAgICAgZm9ybVswXS5yZXNldCgpO1xuICAgICAgICAgIGFkZE1lc3NhZ2UoWydTdWNjZXNzZnVsbHkgYWRkZWQgYW4gZW1wbG95ZWUnXSwgJ3N1Y2Nlc3MnKTtcblxuICAgICAgICAgIHNldFRpbWVvdXQoKCkgPT4ge1xuICAgICAgICAgICAgd2luZG93LmxvY2F0aW9uLnJlbG9hZCgpO1xuICAgICAgICAgIH0sIDE1MDApO1xuICAgICAgICB9XG4gICAgICB9KVxuICAgICAgLmNhdGNoKGZ1bmN0aW9uKGVycm9yKSB7XG4gICAgICAgIGUub3JpZ2luYWxFdmVudC5zdWJtaXR0ZXIucmVtb3ZlQXR0cmlidXRlKFwiZGlzYWJsZWRcIik7XG4gICAgICAgIGxldCB2YWxpZGF0aW9uRmllbGQgPSBkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgndmFsaWRhdGlvbkZpZWxkJyk7XG5cbiAgICAgICAgaWYgKE9iamVjdC5rZXlzKGVycm9yLnJlc3BvbnNlLmRhdGEuZXJyb3JzKS5sZW5ndGggPiAwKSB7XG4gICAgICAgICAgbGV0IGVycm9ycyA9IE9iamVjdC52YWx1ZXMoZXJyb3IucmVzcG9uc2UuZGF0YS5lcnJvcnMpO1xuXG4gICAgICAgICAgYWRkTWVzc2FnZShlcnJvcnMsICdlcnJvcicpO1xuICAgICAgICB9XG4gICAgICB9KTtcbiAgfSk7XG5cbiAgbGV0IGFkZE1lc3NhZ2UgPSAobWVzc2FnZSA9IFtdLCB0eXBlKSA9PiB7XG4gICAgdmFsaWRhdGlvbkZpZWxkLmNsYXNzTGlzdC5yZW1vdmUoJ2Qtbm9uZScpO1xuXG4gICAgaWYgKHR5cGUgPT0gJ3N1Y2Nlc3MnKSB7XG4gICAgICB2YWxpZGF0aW9uRmllbGQuY2xhc3NMaXN0LmFkZCgnYWxlcnQtc3VjY2VzcycpO1xuICAgICAgZm9yIChsZXQgaSA9IDA7IGkgPCBtZXNzYWdlLmxlbmd0aDsgaSsrKSB7XG4gICAgICAgIGxldCBsaSA9IGRvY3VtZW50LmNyZWF0ZUVsZW1lbnQoJ2xpJyk7XG4gICAgICAgIGxpLnRleHRDb250ZW50ID0gbWVzc2FnZVtpXTtcblxuICAgICAgICB1bC5hcHBlbmRDaGlsZChsaSk7XG4gICAgICB9XG4gICAgfSBlbHNlIHtcbiAgICAgIHZhbGlkYXRpb25GaWVsZC5jbGFzc0xpc3QuYWRkKCdhbGVydC1kYW5nZXInKTtcblxuICAgICAgZm9yIChsZXQgaSA9IDA7IGkgPCBtZXNzYWdlLmxlbmd0aDsgaSsrKSB7XG4gICAgICAgIGxldCBsaSA9IGRvY3VtZW50LmNyZWF0ZUVsZW1lbnQoJ2xpJyk7XG4gICAgICAgIGxpLnRleHRDb250ZW50ID0gbWVzc2FnZVtpXTtcblxuICAgICAgICB1bC5hcHBlbmRDaGlsZChsaSk7XG4gICAgICB9XG4gICAgfVxuICB9XG5cbiAgbGV0IHJlbW92ZVZhbGlkYXRpb25NZXNzYWdlID0gKCkgPT4ge1xuICAgIGlmICh1bC5jaGlsZEVsZW1lbnRDb3VudCA+IDApIHtcbiAgICAgIHZhbGlkYXRpb25GaWVsZC5jbGFzc0xpc3QucmVtb3ZlKCdhbGVydC1kYW5nZXInLCAnYWxlcnQtc3VjY2VzcycpO1xuICAgICAgd2hpbGUgKHVsLmZpcnN0Q2hpbGQgJiYgIXVsLmZpcnN0Q2hpbGQucmVtb3ZlKCkpO1xuICAgIH1cbiAgfVxufSJdLCJmaWxlIjoiLi9yZXNvdXJjZXMvanMvYWRtaW4vZW1wbG95ZWVzLmpzLmpzIiwic291cmNlUm9vdCI6IiJ9\n//# sourceURL=webpack-internal:///./resources/js/admin/employees.js\n");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval-source-map devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./resources/js/admin/employees.js"]();
/******/ 	
/******/ })()
;