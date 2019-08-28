jQuery(document).ready(function ($) {
    "use strict";
    /*Menu toggler*/
    $('.menu-toggler').click(function () {
        $('.hidden-menu').slideToggle();
    });

    $('.status-icon').hover(
        function () {
            if ($(this).hasClass('fa-toggle-off')) {
                $(this).removeClass('fa-toggle-off').addClass('fa-toggle-on').removeClass('red').addClass('blue');
            }
            else if ($(this).hasClass('fa-toggle-on')) {
                $(this).removeClass('fa-toggle-on').addClass('fa-toggle-off').removeClass('blue').addClass('red');
            }
            else if ($(this).hasClass('fa-repeat')) {
                $(this).removeClass('blue').addClass('red');
            }
        },
        function () {
            if ($(this).hasClass('fa-toggle-off')) {
                $(this).removeClass('fa-toggle-off').addClass('fa-toggle-on').removeClass('red').addClass('blue');
            }
            else if ($(this).hasClass('fa-toggle-on')) {
                $(this).removeClass('fa-toggle-on').addClass('fa-toggle-off').removeClass('blue').addClass('red');
            }
            else if ($(this).hasClass('fa-repeat')) {
                $(this).removeClass('red').addClass('blue');
            }
        }
    );
});
