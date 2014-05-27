$(document).ready(function(){
  $(document).on("mouseenter", ".item", function(){
    var heart_sm = $(this).find(".check_heart_button");
    var little_heart = $(this).find("span");
    $(this).find("h4").css("color", "white");
    $(this).find("h4").css("text-shadow", "0 0 2px black");
    $.post(
      $(heart_sm).attr('action'), $(heart_sm).serialize(), function(param) {
        if (param[0] == "liked") {
          $(little_heart).css("color", "red");
        } else {
          $(little_heart).css("color", "white");
        }
      }, "json");
    return false;
  });

  $(document).on("mouseleave", ".item", function(){
    $(this).find("h4").css("color", "transparent");
    $(this).find("h4").css("text-shadow", "0 0 2px transparent");
    $(this).find("span").css("color", "transparent");
  });

  $(document).on("click", '.heart_btn', function() {
    var heart = $(this).parent(".item");
    $.post(
      $(this).attr('action'), $(this).serialize(), function(param) {
        if (param[0] == "unlike successful") {
          $(heart).fadeOut("slow");
        }
      }, "json");
    return false;
  });
});
