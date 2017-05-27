/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

$(document).ready(function () {
    $('body').scrollspy({target: '#navbar-main', offset: 30});
    $("#navbar-main").stick_in_parent({parent: $("body"), offset_top: 15})
});