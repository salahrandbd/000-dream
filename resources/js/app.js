import '../scss/app.scss';
import 'bootstrap-icons/font/bootstrap-icons.css';

import * as bootstrap from 'bootstrap';
window.bootstrap = bootstrap;

import $ from 'jquery';
window.$ = $;

import './flash-message';

$(window).on('load', () => {
  const hamburgerMenuIcon = $('.hamburger-menu-icon');
  const sidebar = $('.sidebar');

  hamburgerMenuIcon.on('click', () => {
    sidebar.toggleClass('active');
  });
});

