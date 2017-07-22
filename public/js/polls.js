/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 158);
/******/ })
/************************************************************************/
/******/ ({

/***/ 158:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(159);


/***/ }),

/***/ 159:
/***/ (function(module, exports) {

/**
 * Created by Ely Bascoy on 7/12/17.
 */

$(document).ready(function () {
    var counter = 0;

    /**
     * Dynamically adds choice fields, assigning a value if provided.
     * @param event
     * @param choiceValue
     */
    var addChoiceField = function addChoiceField() {
        var choiceValue = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : null;

        counter++;

        if (counter === 1) {
            $('#choices-form-group').removeAttr("style");
        }
        var newTextBoxDiv = $(document.createElement('div')).attr("id", 'choice-div-' + counter).attr("class", 'form-group');

        var formGroupHtml = '<label ' + 'class="col-lg-2 control-label" ' + 'for="choice-' + counter + '">' + 'Choice ' + counter + '</label>' + '<div class="col-lg-10">' + '<input type="text" ' + 'name="choices[]" id="choice-' + counter + '" ' + 'class="form-control" ' + 'placeholder="Enter new choice"';
        if (choiceValue !== null) {
            formGroupHtml += ' value="' + choiceValue + '"></div>';
        } else {
            formGroupHtml += '></div>';
        }
        newTextBoxDiv.after().html(formGroupHtml);
        newTextBoxDiv.appendTo("#choices-form-group");
    };

    // if we have old choice values, create and populate the fields
    if (typeof choices !== "undefined" && $.isArray(choices)) {
        for (var i = 0; i < choices.length; i++) {
            addChoiceField(choices[i]);
        }
    }

    // Add new choice fields dynamically
    $("#choice-button").click(function () {
        addChoiceField();
    });
});

/***/ })

/******/ });