$(document).ready(function(){
    //slider ============================
    $('.js-slider').slick({
        infinite: true,
        arrows : false,
        speed: 800,
        fade: true,
        cssEase: 'linear',
        autoplay : true
    });

    //Tabs - Tabs Content ===============
    $('.news__inner>.c-tabs li').click(function(){
        var item = $(this);
        var showContent = item.data('content');
        var activeColor = item.data('color');

        item.addClass('active');
        item.css({
           'background-color' : activeColor,
           'border-top-color' : activeColor
        });

        $(".c-tabs li").not(item).removeClass("active");
        $(".c-tabs li").not(item).css("background-color","");

        $('#'+showContent).fadeIn();
        $('.c-listpost').not('#'+showContent).hide();
    });

});
// FILTER SERVICE
$(function () {
    $('#serviceSearch :input[type="checkbox"]').change(function () {
      let parent = $("#serviceSearch");
      var checked = [];
  
      parent.find("input[name='cats[]']:checked").each(function () {
        checked.push(parseInt($(this).val()));
      });
  
      let data = {
        action: "ajax_services_filter",
        input: checked,
      };
  
      let process = $.ajax({
        type: "post",
        url: ajaxurl,
        data: data,
        dataType: "json",
  
        success: function (response) {
          if (response.type == "success") {
            $(".is-ajaxServicesPosts").html(response.content);
            $(".is-ajaxServicesCount").html(response.count);
  
            return false;
          }
  
          if (response.type == "empty") {
            $(".is-ajaxServicesPosts").html("");
            $(".is-ajaxServicesCount").html("0");
  
            return false;
          }
        },
      });
  
      return false;
    })
});
// RESET BUTTON 
$("input[type=reset]").click(function() {
  $(this).closest('form').find("input[type=text], textarea").val('');
  $(this).closest('form').find("input[type=text]").removeAttr('value');
  $(this).closest('form').find('textarea').empty();
});
