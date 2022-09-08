"use strict";

$(document).on('click', '.book-pickup', function () {
    $.post($(this).data('url'));
});

$(document).on('click', '.book-return', function () {
    $.post($(this).data('url'));
});
