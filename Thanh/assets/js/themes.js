$(document).ready(function () {
    //slider ============================
    $('.js-slider').slick({
        infinite: true,
        arrows: false,
        speed: 800,
        fade: true,
        cssEase: 'linear',
        autoplay: true
    });

    //Tabs - Tabs Content ===============
    $('.c-tabs li').click(function () {
        var item = $(this);
        var showContent = item.data('content');
        var activeColor = item.data('color');
        var checklink = item.children('a');
        if (checklink.length == 0) {
            $('.c-listpost').removeClass('active');
            $(".c-tabs li").not(item).removeClass("active");
            $(".c-tabs li").not(item).css("background-color", "");
            item.addClass('active');
            item.css({
                'background-color': activeColor,
                'border-top-color': activeColor
            });
            $('.c-listpost').not('#' + showContent).hide();
            $('#' + showContent).fadeIn();
            $('#' + showContent).addClass('active');
        }
    });
    $('.chkbutton').change(function () {
        let parent = $('#serviceSearch'),
            checked = [],
            checked2 = [];
        parent.find("input[name='service-category[]']:checked").each(function () {
            checked.push(parseInt($(this).val()));
        });
        parent.find("input[name='service-category2[]']:checked").each(function () {
            checked2.push(parseInt($(this).val()));
        });
        let data = {};
        data.action = "filter_service_category";
        data.checked = checked;
        data.checked2 = checked2;
        $.ajax({
            url: ajaxurl,
            dataType: "json",
            type: "POST",
            data: data,
            success: function (response) {
                if (response.type == "success") {
                    $(".c-column").html(response.content);
                    $(".p-service__result span").html(response.count + "件が該当しました");
                }

                if (response.type == "empty") {
                    $(".c-column").html("");
                    $(".p-service__result span").html("0件が該当しました");
                }
            },
        });
    });
    $(".mw_wp_form form").validate({
        rules: {
            "firstname": {
                required: true
            },
            "lastname": {
                required: true
            },
            "email": {
                required: true,
                email: true,
            },
            "emailconfirm": {
                required: true,
                email: true,
            },
            "message": {
                required: true
            },
            "tel": {
                fnType: true
            }
        },
        messages: {
            "firstname": {
                required: "この項目は必須です。"
            },
            "lastname": {
                required: "この項目は必須です。"
            },
            "email": {
                required: "この項目は必須です。",
                email: "例） example@gmail.com"
            },
            "emailconfirm": {
                required: "この項目は必須です。",
                email: "例） example@gmail.com"
            },
            "message": {
                required: "この項目は必須です。"
            },
        }
    });
    $.validator.addMethod('fnType', function (value) {
        if (value.length == 0) {
            return true;
        }
        return value.match(/\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})/);
    }, '有効な電話番号を入力してください');
    $(".mw_wp_form form .c-btn__submit").click(function () {
        if ($(".mw_wp_form form").valid()) {
            return true;
        }
    });
	//ajax news
    $("body").on("click", ".c-ajax a", function (e) {
        e.preventDefault();
        parent = $(this).parent(),
            grandfa = parent.parent();
        var hrefthis = $(this).attr('href'),
            paged = hrefthis.split("/page/")[1],
            cate = grandfa.attr("data-content");
        id = grandfa.attr("id");
        var loading='<div class="loader"></div>';
        if (!paged) paged = 1;
        $.ajax({
            type: "post",
            dataType: "json",
            url: ajaxurl,
            data: {
                action: "ajax_load_page",
                paged: paged,
                cat: cate,
                id: id,
                slug: 'news'
            },
            beforeSend: function () {
                $(".c-listpost.active").empty();
                $(".c-listpost.active").append(loading);
              },
            success: function (result) {
                $(".c-listpost.active").empty();
                if (result.type == "success") {
                    $(".c-listpost.active").html(result.content);
                }
                if (result.type == "empty") {
                    $(".c-listpost.active").html("");
                }
            }
        });
        return false;
    })
	//ajax publish
	$("body").on("click", ".c-ajaxpublish a", function (e) {
        e.preventDefault();
        parent = $(this).parent(),
            grandfa = parent.parent();
        var hrefthis = $(this).attr('href'),
            paged = hrefthis.split("/page/")[1];
        var loading = '<div class="loader"></div>';
        if (!paged) paged = 1;
        $.ajax({
            type: "post",
            dataType: "json",
            url: ajaxurl,
            data: {
                action: "ajax_load_pagepublish",
                paged: paged,
                slug: 'publish'
            },
            beforeSend: function () {
                $(".p-publish__content").empty();
                $(".p-publish__content").append(loading);
            },
            success: function (result) {
                $(".p-publish__content").empty();
                if (result.type == "success") {
                    $(".p-publish__content").html(result.content);
                }
                if (result.type == "empty") {
                    $(".p-publish__content").html("");
                }
            }
        });
        return false;
    })
});