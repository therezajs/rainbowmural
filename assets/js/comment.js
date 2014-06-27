$(document).ready(function() {
  $(document).on("click", '#like_button', function() {
    $.post(
      $(this).attr('action'), $(this).serialize(), function(param) {

        if (param['status'] == "like successful") {
          $('#like_btn').html("<span class='glyphicon glyphicon-heart' id='red'></span> liked");
        }
        else {
          $('#like_btn').html("<span class='glyphicon glyphicon-heart'></span> like");
        }
        if (param['count_likes'] == 1) {
          $('#likes_count').html("<p><span class='badge'>"+param['count_likes']+"</span> like</p>");
        } else {
          $('#likes_count').html("<p><span class='badge'>"+param['count_likes']+"</span> likes</p>");
        }
      }, "json");
    return false;
  });

  $(document).ready(function() {
    $.post(
      $('#check_like_button').attr('action'), $('#check_like_button').serialize(), function(param) {
        if (param['status'] == "liked") {
          $('#like_btn').html("<span class='glyphicon glyphicon-heart' id='red'></span> liked");
        }
        if (param['count_likes'] == 1) {
          $('#likes_count').html("<p><span class='badge'>"+param['count_likes']+"</span> like</p>");
        } else {
          $('#likes_count').html("<p><span class='badge'>"+param['count_likes']+"</span> likes</p>");
        }
      }, "json");
    return false;
  });
});

$(document).ready(function(){
    $(document).on("submit", '#comment', function() {
      var form = $(this);
      $.post(
        $(this).attr('action'), $(this).serialize(), function(param) {
          if (param['status'] == "comment successful") {
            $('#commentsTable').append("<p><strong>"+param['user_name']+"</strong> " + param['comment'] + "</p>");
          };
          $(form).each(function(){
              this.reset();
          })
        }, "json");
      return false;
    });
  });
