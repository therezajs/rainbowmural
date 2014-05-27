$(document).ready(function() {
  $(document).on("click", '#like_button', function() {
    $.post(
      $(this).attr('action'), $(this).serialize(), function(param) {

        if (param[0] == "like successful") {
          $('#like_btn').html("<span class='glyphicon glyphicon-heart' id='red'></span> liked");
        }
        else {
          $('#like_btn').html("<span class='glyphicon glyphicon-heart'></span> like");
        }
        if (param[1] == 1) {
          $('#likes_count').html("<p><span class='badge'>"+param[1]+"</span> like</p>");
        } else {
          $('#likes_count').html("<p><span class='badge'>"+param[1]+"</span> likes</p>");
        }
      }, "json");
    return false;
  });

  $(document).ready(function() {
    $.post(
      $('#check_like_button').attr('action'), $('#check_like_button').serialize(), function(param) {
        if (param[0] == "liked") {
          $('#like_btn').html("<span class='glyphicon glyphicon-heart' id='red'></span> liked");
        }
        if (param[1] == 1) {
          $('#likes_count').html("<p><span class='badge'>"+param[1]+"</span> like</p>");
        } else {
          $('#likes_count').html("<p><span class='badge'>"+param[1]+"</span> likes</p>");
        }
      }, "json");
    return false;
  });
});