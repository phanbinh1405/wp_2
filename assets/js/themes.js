$(document).ready(function () {
  //slider ============================
    $(".js-slider").slick({
        infinite: true,
        arrows: false,
        speed: 800,
        fade: true,
        cssEase: "linear",
        autoplay: true,
    });

  //Tabs - Tabs Content ===============
    $(".c-tabs li:not(li.catlink)").click(function () {
        var item = $(this);
        var showContent = item.data("content");
        var activeColor = item.data("color");

        item.addClass("active");
        item.css({
        "background-color": activeColor,
        "border-top-color": activeColor,
        });

        $(".c-tabs li:not(li.catlink)").not(item).removeClass("active");
        $(".c-tabs li:not(li.catlink)").not(item).css("background-color", "");

        $("#" + showContent).fadeIn();
        $(".c-listpost")
        .not("#" + showContent)
        .hide();
    });

    // Reset form ====================
    $("input[type=reset]").click(function () {
        $(this).closest("form").find("input[type=text], textarea").val("");
        $(this).closest("form").find("input[type=text]").removeAttr("value");
        $(this).closest("form").find("textarea").empty();
    });

    // Query Ajax Service
    $(".chkbutton").click(function () {
        var form = $("#serviceSearch");
        var checked = [];
        form.find('input[type="checkbox"]:checked').each(function () {
        checked.push(parseInt($(this).val()));
        });
        $.ajax({
        type: "post",
        dataType: "json",
        url: ajaxurl,
        data: {
            action: "filter_service_categories",
            input: checked,
        },
        success: function (response) {
            if (response.type === 'success') {
            $(".is-ajaxServicesPosts").html(response.content);
            $('.is-ajaxServicesCount').html(`${response.count}件が該当しました`)
            console.log(response)
            } else {
            alert("エラーが発生しました");
            }
        },
        });
    });
    });
