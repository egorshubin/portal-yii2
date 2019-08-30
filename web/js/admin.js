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

    /* Внешний вид иконки статуса при наведении в панели создания и редактирования мероприятия*/
    $('.panel-point.publishing').hover(
        function () {
            if ($(this).find('.fa').hasClass('fa-toggle-off')) {
                $(this).find('.fa').removeClass('fa-toggle-off').addClass('fa-toggle-on').removeClass('light-gray').addClass('light-blue');
            }
            else {
                $(this).find('.fa').removeClass('fa-toggle-on').addClass('fa-toggle-off').removeClass('light-blue').addClass('light-gray');
            }
        },
        function () {
            if ($(this).find('.fa').hasClass('fa-toggle-off')) {
                $(this).find('.fa').removeClass('fa-toggle-off').addClass('fa-toggle-on').removeClass('light-gray').addClass('light-blue');
            }
            else {
                $(this).find('.fa').removeClass('fa-toggle-on').addClass('fa-toggle-off').removeClass('light-blue').addClass('light-gray');
            }
        }
    );

    /*Переключаемся между вкладками*/
    $('.nav-link').click(function() {
        if (!$(this).hasClass('active')) {
            $('.opened-body').removeClass('opened-body').hide();
            var needId = $(this).attr('rel');
            $('#' + needId).addClass('opened-body').fadeIn();
            $('.active').removeClass('active');
            $(this).addClass('active');


        }
    })

});
