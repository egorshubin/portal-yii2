jQuery(document).ready(function ($) {
    "use strict";
    var adminRoot = '/admin/';
    tinyMCE.init({
        // General options
        mode: "specific_textareas",
        editor_selector: "content-editor",
        theme: "modern",
        language: "ru",
        branding: false,
        plugins: 'link image lists code takepart',
        menubar: false,
        toolbar: 'undo redo | bold italic underline | bullist numlist | link unlink | takepart | code',
        convert_urls: false
    });

    /*Menu toggler*/
    $('.menu-toggler').click(function () {
        $('.hidden-menu').slideToggle();
    });

    $('.status-icon').hover(
        function () {
            if ($(this).hasClass('fa-toggle-off')) {
                $(this).removeClass('fa-toggle-off').addClass('fa-toggle-on').removeClass('red').addClass('blue');
            } else if ($(this).hasClass('fa-toggle-on')) {
                $(this).removeClass('fa-toggle-on').addClass('fa-toggle-off').removeClass('blue').addClass('red');
            } else if ($(this).hasClass('fa-repeat')) {
                $(this).removeClass('blue').addClass('red');
            }
        },
        function () {
            if ($(this).hasClass('fa-toggle-off')) {
                $(this).removeClass('fa-toggle-off').addClass('fa-toggle-on').removeClass('red').addClass('blue');
            } else if ($(this).hasClass('fa-toggle-on')) {
                $(this).removeClass('fa-toggle-on').addClass('fa-toggle-off').removeClass('blue').addClass('red');
            } else if ($(this).hasClass('fa-repeat')) {
                $(this).removeClass('red').addClass('blue');
            }
        }
    );

    /* Внешний вид иконки статуса при наведении в панели создания и редактирования мероприятия*/
    $('.panel-icon.publishing').hover(
        function () {
            if ($(this).find('.fa').hasClass('fa-toggle-off')) {
                $(this).find('.fa').removeClass('fa-toggle-off').addClass('fa-toggle-on').removeClass('light-gray').addClass('light-blue');
            } else {
                $(this).find('.fa').removeClass('fa-toggle-on').addClass('fa-toggle-off').removeClass('light-blue').addClass('light-gray');
            }
        },
        function () {
            if ($(this).find('.fa').hasClass('fa-toggle-off')) {
                $(this).find('.fa').removeClass('fa-toggle-off').addClass('fa-toggle-on').removeClass('light-gray').addClass('light-blue');
            } else {
                $(this).find('.fa').removeClass('fa-toggle-on').addClass('fa-toggle-off').removeClass('light-blue').addClass('light-gray');
            }
        }
    );

    /*Переключаемся между вкладками*/
    $('.nav-link').click(function () {
        if (!$(this).hasClass('active')) {
            $('.opened-body').removeClass('opened-body').hide();
            var needId = $(this).attr('rel');
            $('#' + needId).addClass('opened-body').fadeIn();
            $('.active').removeClass('active');
            $(this).addClass('active');


        }
    })

    /*Открываем окно смены порядка*/
    $("#reorder-button").click(function () {
        if (!$(this).hasClass('reorder-button-active')) {
            $("#type-listing-normal").hide();
            $("#type-listing-order").fadeIn();
            $("#see-right-button").hide();
            $(this).addClass('reorder-button-active').addClass('cancel-button');
            $(this).html('Закрыть <i class="fa fa-times"></i>')
        } else {
            $("#type-listing-order").hide();
            $("#type-listing-normal").fadeIn();
            $("#see-right-button").fadeIn();
            $(this).removeClass('reorder-button-active').removeClass('cancel-button');
            $(this).html('Порядок <i class="fa fa-exchange fa-rotate-90"></i>');
        }
    })

    /*sortable*/
    $("#sortable").sortable({
        revert: true
    });

    /* Данная функция посылает ajax запрос на смену порядка*/
    function sendReorder(string, catId) {

        var workingPhp = adminRoot + 'category/reorder';

        $.ajax({
            type: 'POST',
            url: workingPhp,
            data: {'data': string, 'categoryId': catId}
        })

    }

    /*Смена порядка*/
    $("#reorder-button-confirm").click(function () {
        var reorderArray = [];
        $('#sortable li').each(function (i, elem) {
            var cId = $(elem).find('.draggable-list-item-flex').attr('data-id');
            var cDb = $(elem).find('.draggable-list-item-flex').attr('data-db-name');
            var cOr = i + 1;

            var reorderString = cId + ',' + cDb + ',' + cOr;
            reorderArray.push(reorderString);
        });
        var finalString = reorderArray.join('/');
        var catId = $('#type-listing-order').attr('data-category-id');
        sendReorder(finalString, catId);
    })

    /*Here we see validation errors and move that block to be seen from everywhere*/
    if ($('.error-summary')) {
        $('.error-summary').prependTo('.content-wrapper')
    }

    /*Saving form*/
    $('.save').click(function () {
        $('form').submit();
        $('.undercover-loading').show();
    })

    /*Анимация-крутилка*/
    function change(idName, replaceId) {
        if (document.getElementById(idName) != null) {
            if (document.getElementById(idName).style.display == 'none') {
                document.getElementById(idName).style.display = '';
                document.getElementById(replaceId).style.display = 'none';
            } else {
                document.getElementById(idName).style.display = 'none';
                document.getElementById(replaceId).style.display = '';
            }
        }
        return false;
    }

    /* Данная функция посылает ajax запрос на отображение газет по году*/
    function sendYear(string) {
        var workingPhp = adminRoot + 'paperissue/loadbyyear';

        $.ajax({
            type: 'POST',
            url: workingPhp,
            data: {'data': string}
        })
            .done(function (data) {
                if (document.getElementById('loader') != null) {
                    change('loader', 'delete-all-wrapper');
                }
                document.getElementById("papers-list").innerHTML = data;
                change('loader', 'delete-all-wrapper');
            });

    }

    /*Ajax подгрузка списков газет*/
    $('.button-year').click(function () {
        if (!$(this).hasClass('button-empty-active')) {
            var string = $(this).attr('data-year') + '/' + $(this).attr('data-id');
            sendYear(string);
            $('.button-empty-active').removeClass('button-empty-active');
            $(this).addClass('button-empty-active');
        }
    })
})
;
