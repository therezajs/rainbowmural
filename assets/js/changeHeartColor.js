$(document).ready(function() {

  // checks if picture is liked and displays the heart sign accordingly
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

  // changes the color of title
  $(document).on("mouseleave", ".item", function(){
    $(this).find("h4").css("color", "transparent");
    $(this).find("h4").css("text-shadow", "0 0 2px transparent");
    $(this).find("span").css("color", "transparent");
  });

  // like and unlike a picture
  $(document).on("click", '.heart_btn', function() {
    var heart = $(this);
    $.post(
      $(this).attr('action'), $(this).serialize(), function(param) {
        if (param[0] == "like successful") {
          $(heart).find(".heart_span").html("<span class='glyphicon glyphicon-heart' id='red'></span>");
        }
        else {
          $(heart).find(".heart_span").html("<span class='glyphicon glyphicon-heart'></span>");
        }
      }, "json");
    return false;
  });
});