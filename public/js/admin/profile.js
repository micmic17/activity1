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

/***/ "./resources/js/admin/profile.js":
/*!***************************************!*\
  !*** ./resources/js/admin/profile.js ***!
  \***************************************/
/***/ (() => {

eval("var fileButton = document.getElementById('my_file');\nvar uploadButton = document.getElementById('upload_logo');\nvar file_name = document.getElementById('file_name');\nvar img = document.getElementsByClassName('card-img-top')[0];\n\nuploadButton.onclick = function () {\n  fileButton.click();\n  fileButton.addEventListener('change', function (event) {\n    var filename = fileButton.value.split(\"\\\\\");\n    img.src = URL.createObjectURL(event.target.files[0]);\n    ;\n    file_name.innerHTML = filename[filename.length - 1];\n  });\n};//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvanMvYWRtaW4vcHJvZmlsZS5qcz82MzNlIl0sIm5hbWVzIjpbImZpbGVCdXR0b24iLCJkb2N1bWVudCIsImdldEVsZW1lbnRCeUlkIiwidXBsb2FkQnV0dG9uIiwiZmlsZV9uYW1lIiwiaW1nIiwiZ2V0RWxlbWVudHNCeUNsYXNzTmFtZSIsIm9uY2xpY2siLCJjbGljayIsImFkZEV2ZW50TGlzdGVuZXIiLCJldmVudCIsImZpbGVuYW1lIiwidmFsdWUiLCJzcGxpdCIsInNyYyIsIlVSTCIsImNyZWF0ZU9iamVjdFVSTCIsInRhcmdldCIsImZpbGVzIiwiaW5uZXJIVE1MIiwibGVuZ3RoIl0sIm1hcHBpbmdzIjoiQUFBQSxJQUFJQSxVQUFVLEdBQUdDLFFBQVEsQ0FBQ0MsY0FBVCxDQUF3QixTQUF4QixDQUFqQjtBQUNBLElBQUlDLFlBQVksR0FBR0YsUUFBUSxDQUFDQyxjQUFULENBQXdCLGFBQXhCLENBQW5CO0FBQ0EsSUFBSUUsU0FBUyxHQUFHSCxRQUFRLENBQUNDLGNBQVQsQ0FBd0IsV0FBeEIsQ0FBaEI7QUFDQSxJQUFJRyxHQUFHLEdBQUdKLFFBQVEsQ0FBQ0ssc0JBQVQsQ0FBZ0MsY0FBaEMsRUFBZ0QsQ0FBaEQsQ0FBVjs7QUFFQUgsWUFBWSxDQUFDSSxPQUFiLEdBQXVCLFlBQU07QUFDM0JQLEVBQUFBLFVBQVUsQ0FBQ1EsS0FBWDtBQUNBUixFQUFBQSxVQUFVLENBQUNTLGdCQUFYLENBQTRCLFFBQTVCLEVBQXNDLFVBQUNDLEtBQUQsRUFBVztBQUMvQyxRQUFJQyxRQUFRLEdBQUdYLFVBQVUsQ0FBQ1ksS0FBWCxDQUFpQkMsS0FBakIsQ0FBdUIsSUFBdkIsQ0FBZjtBQUVBUixJQUFBQSxHQUFHLENBQUNTLEdBQUosR0FBVUMsR0FBRyxDQUFDQyxlQUFKLENBQW9CTixLQUFLLENBQUNPLE1BQU4sQ0FBYUMsS0FBYixDQUFtQixDQUFuQixDQUFwQixDQUFWO0FBQXFEO0FBQ3JEZCxJQUFBQSxTQUFTLENBQUNlLFNBQVYsR0FBc0JSLFFBQVEsQ0FBQ0EsUUFBUSxDQUFDUyxNQUFULEdBQWtCLENBQW5CLENBQTlCO0FBQ0QsR0FMRDtBQU1ELENBUkQiLCJzb3VyY2VzQ29udGVudCI6WyJsZXQgZmlsZUJ1dHRvbiA9IGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdteV9maWxlJyk7XG5sZXQgdXBsb2FkQnV0dG9uID0gZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ3VwbG9hZF9sb2dvJyk7XG5sZXQgZmlsZV9uYW1lID0gZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ2ZpbGVfbmFtZScpXG5sZXQgaW1nID0gZG9jdW1lbnQuZ2V0RWxlbWVudHNCeUNsYXNzTmFtZSgnY2FyZC1pbWctdG9wJylbMF07XG5cbnVwbG9hZEJ1dHRvbi5vbmNsaWNrID0gKCkgPT4ge1xuICBmaWxlQnV0dG9uLmNsaWNrKCk7XG4gIGZpbGVCdXR0b24uYWRkRXZlbnRMaXN0ZW5lcignY2hhbmdlJywgKGV2ZW50KSA9PiB7XG4gICAgbGV0IGZpbGVuYW1lID0gZmlsZUJ1dHRvbi52YWx1ZS5zcGxpdChcIlxcXFxcIik7XG5cbiAgICBpbWcuc3JjID0gVVJMLmNyZWF0ZU9iamVjdFVSTChldmVudC50YXJnZXQuZmlsZXNbMF0pOztcbiAgICBmaWxlX25hbWUuaW5uZXJIVE1MID0gZmlsZW5hbWVbZmlsZW5hbWUubGVuZ3RoIC0gMV07XG4gIH0pO1xufTsiXSwiZmlsZSI6Ii4vcmVzb3VyY2VzL2pzL2FkbWluL3Byb2ZpbGUuanMuanMiLCJzb3VyY2VSb290IjoiIn0=\n//# sourceURL=webpack-internal:///./resources/js/admin/profile.js\n");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval-source-map devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./resources/js/admin/profile.js"]();
/******/ 	
/******/ })()
;