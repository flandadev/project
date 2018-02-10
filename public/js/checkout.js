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
/******/ 	return __webpack_require__(__webpack_require__.s = 111);
/******/ })
/************************************************************************/
/******/ ({

/***/ 111:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(112);


/***/ }),

/***/ 112:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var price = $('[name="event-price"]').val() / 100;
var busprice = $('[name="bus"]').val() / 100;

price += busprice;
price = Math.round(price * 100) / 100;
$('button[type="submit"]').html('Pay ' + price + ' \u20AC');

$('[name="ticket"]').on('change', function () {
	var quantity = $(this).val();
	busprice = $('[name="bus"]').val() / 100;

	// GET THE BASE PRICE
	price = $('[name="event-price"]').val() / 100;

	// MULTIPLY TICKETS
	price = price * quantity;

	// ADD PRICE
	price = price + busprice * quantity;

	// ROUND
	price = Math.round(price * 100) / 100;

	$('button[type="submit"]').html('Pay ' + price + ' \u20AC');
});

$('[name="bus"]').on('change', function () {
	busprice = $('[name="bus"]').val() / 100;
	price = $('[name="event-price"]').val() / 100;

	price = price + busprice;
	price = price * $('[name="ticket"]').val();
	price = Math.round(price * 100) / 100;

	$('button[type="submit"]').html('Pay ' + price + ' \u20AC');

	console.log($('[name="bus"]').val() * $('[name="ticket"]').val());
});

/***/ })

/******/ });