import './bootstrap.js';

/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import './styles/app.scss'

// app.js

const $ = require('jquery');
// this "modifies" the jquery module: adding behavior to it
// the bootstrap module doesn't export/return anything
require('bootstrap');

// or you can include specific pieces
require('bootstrap/js/dist/tooltip');
require('bootstrap/js/dist/popover');

//$(document).ready(function() {
//    $('[data-toggle="popover"]').popover();
//});

import noUiSlider from 'nouislider';
import 'nouislider/dist/nouislider.css';
import Filter from './modules/Filter';

const sliderMileage = document.getElementById('mileage-slider');
const sliderReleaseYear = document.getElementById('releaseYear-slider');
const sliderPrice = document.getElementById('price-slider');

const filter = new Filter(document.querySelector('.js-filter'));
const actionUrl = document.querySelector('[data-action-url]').getAttribute('data-action-url');

if (sliderMileage){
  const minMileageInput = document.getElementById('minMileage');
  const maxMileageInput = document.getElementById('maxMileage');
  const minMileageValue = parseInt(sliderMileage.dataset.min, 10);
  const maxMileageValue = parseInt(sliderMileage.dataset.max, 10);
  const range = noUiSlider.create(sliderMileage, {
      start: [minMileageInput.value || minMileageValue, maxMileageInput.value || maxMileageValue],
      connect: true,
      step: 100,
      range: {
          'min': minMileageValue,
          'max': maxMileageValue
      }
  })
  range.on('slide', function (values, handle) {
    filter.loadUrl(actionUrl + '?minMileage=' + values [0] + '&maxMileage=' + values[1]);
    if (handle === 0) {
      minMileageInput.value = Math.round(values[0]);
    }
    if (handle === 1) {
      maxMileageInput.value = Math.round(values[1]);
    }
  })
  range.on('end', function (values, handle) {
    minMileageInput.dispatchEvent(new Event('change'))
  });
}

if (sliderReleaseYear){
  const minReleaseYearInput = document.getElementById('minReleaseYear');
  const maxReleaseYearInput = document.getElementById('maxReleaseYear');
  const minReleaseYearValue = parseInt(sliderReleaseYear.dataset.min, 10);
  const maxReleaseYearValue = parseInt(sliderReleaseYear.dataset.max, 10);
  const range = noUiSlider.create(sliderReleaseYear, {
    start: [minReleaseYearInput.value || minReleaseYearValue, maxReleaseYearInput.value || maxReleaseYearValue],
    connect: true,
    step: 1,
    range: {
      'min': minReleaseYearValue,
      'max': maxReleaseYearValue
    }
  })
  range.on('slide', function (values, handle) {
    filter.loadUrl(actionUrl + '?minReleaseYear=' + values [0] + '&maxReleaseYear=' + values[1]);
    if (handle === 0) {
      minReleaseYearInput.value = Math.round(values[0]);
    }
    if (handle === 1) {
      maxReleaseYearInput.value = Math.round(values[1]);
    }
  })
  range.on('end', function (values, handle) {
    minReleaseYearInput.dispatchEvent(new Event('change'))
  });
}

if (sliderPrice){
  const minPriceInput = document.getElementById('minPrice');
  const maxPriceInput = document.getElementById('maxPrice');
  const minPriceValue = parseInt(sliderPrice.dataset.min, 10);
  const maxPriceValue = parseInt(sliderPrice.dataset.max, 10);
  const range = noUiSlider.create(sliderPrice, {
      start: [minPriceInput.value || minPriceValue, maxPriceInput.value || maxPriceValue],
      connect: true,
      step: 100,
      range: {
          'min': minPriceValue,
          'max': maxPriceValue
      }
  })
  range.on('slide', function (values, handle) {
    filter.loadUrl(actionUrl + '?minPrice=' + values [0] + '&maxPrice=' + values[1]);
    if (handle === 0) {
      minPriceInput.value = Math.round(values[0]);
    }
    if (handle === 1) {
      maxPriceInput.value = Math.round(values[1]);
    }
  })
  range.on('end', function (values, handle) {
    minPriceInput.dispatchEvent(new Event('change'))
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