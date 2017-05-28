/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

$(document).ready(function () {
    var $body = $("body");

    $body.scrollspy({target: '#navbar-main', offset: 30});
    $("#navbar-main").stick_in_parent({parent: $body, offset_top: 15});

    $('#api-key-button').click(function () {
        apiRequest('api/key', {}, function (data) {
            $('#pg-key').val(data.key);
        });
    });

    $('#form-playground').submit(function (e) {
        e.preventDefault();
        var key = $('#pg-key').val();
        var query = $('#pg-query').val();
        apiRequest('api', {key: key, query: query}, function (data) {
            $("#api-result").text(JSON.stringify(data, null, 2));
        });
    });
});

function apiRequest(url, params, callback) {
    params._token = window.Laravel.csrfToken;
    $.ajax({
        type: "POST",
        url: url,
        data: params,
        dataType: 'json'
    }).always(callback);
}