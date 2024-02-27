import './bootstrap.js';

/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import './styles/app.scss'

console.log('This log comes from assets/app.js - welcome to AssetMapper! 🎉')

// app.js

const $ = require('jquery');
// this "modifies" the jquery module: adding behavior to it
// the bootstrap module doesn't export/return anything
require('bootstrap');

// or you can include specific pieces
require('bootstrap/js/dist/tooltip');
//require('bootstrap/js/dist/popover');

//$(document).ready(function() {
//    $('[data-toggle="popover"]').popover();
//});

import noUiSlider from 'nouislider';
import 'nouislider/dist/nouislider.css';

const sliderMileage = document.getElementById('mileage-slider');
const minMileageInput = document.getElementById('minMileage');
const maxMileageInput = document.getElementById('maxMileage');

const sliderReleaseYear = document.getElementById('releaseYear-slider');
const minReleaseYearInput = document.getElementById('minReleaseYear');
const maxReleaseYearInput = document.getElementById('maxReleaseYear');

const sliderPrice = document.getElementById('price-slider');
const minPriceInput = document.getElementById('minPrice');
const maxPriceInput = document.getElementById('maxPrice');


if (sliderMileage){
  const minMileage = parseInt(minMileageInput.value, 10);
  const maxMileage = parseInt(maxMileageInput.value, 10);
  const range = noUiSlider.create(sliderMileage, {
      start: [minMileage, maxMileage],
      connect: true,
      step: 100,
      range: {
          'min': minMileage,
          'max': maxMileage
      }
  })
  range.on('update', function (values, handle) {
    if (handle === 0) {
      minMileageInput.value = parseInt(values[0], 10);
    }
    if (handle === 1) {
      maxMileageInput.value = parseInt(values[1], 10);
    }
  });
}

if (sliderReleaseYear){
  const minReleaseYear = parseInt(minReleaseYearInput.value, 10);
  const maxReleaseYear = parseInt(maxReleaseYearInput.value, 10);
  const range = noUiSlider.create(sliderReleaseYear, {
    start: [minReleaseYear, maxReleaseYear],
    connect: true,
    step: 1,
    range: {
      'min': minReleaseYear,
      'max': maxReleaseYear
    }
  })
  range.on('update', function (values, handle) {
    if (handle === 0) {
      minReleaseYearInput.value = parseInt(values[0], 10);
    }
    if (handle === 1) {
      maxReleaseYearInput.value = parseInt(values[1], 10);
    }
  });
}

if (sliderPrice){
  const minPrice = parseInt(minPriceInput.value, 10);
  const maxPrice = parseInt(maxPriceInput.value, 10);
  const range = noUiSlider.create(sliderPrice, {
      start: [minPrice, maxPrice],
      connect: true,
      step: 100,
      range: {
          'min': minPrice,
          'max': maxPrice
      }
  })
  range.on('update', function (values, handle) {
    if (handle === 0) {
      minPriceInput.value = parseInt(values[0], 10);
    }
    if (handle === 1) {
      maxPriceInput.value = parseInt(values[1], 10);
    }
  });
}

let barBetweenHandlesMileage = document.querySelector('#mileage-slider .noUi-connect');
let barBetweenHandlesReleaseYear = document.querySelector('#releaseYear-slider .noUi-connect');
let barBetweenHandlesPrice = document.querySelector('#price-slider .noUi-connect');

if (barBetweenHandlesMileage) {
    barBetweenHandlesMileage.style.background = '#D92332';
}

if (barBetweenHandlesReleaseYear) {
    barBetweenHandlesReleaseYear.style.background = '#D92332';
}

if (barBetweenHandlesPrice) {
    barBetweenHandlesPrice.style.background = '#D92332';
}

