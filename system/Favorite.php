<?php
class Favorite {

  private $connection;

  function __construct() {
    $this->connection = new Database();
  }

  function processFormData($data) {
    if (isset($data['action']) && $data['action'] == 'like_button') {
      $this->setLike($data);
    }
    elseif (isset($data['action']) && $data['action'] == 'check_like_button') {
      $this->checkLike($data);
    }
  }

  function getLikes($data) {
    // Return array with everybody as Person objects with is_friend property
    $query =
      "SELECT * FROM favs WHERE user_id = ".mysql_real_escape_string($data);
    $likes = $this->connection->fetch_all($query);
    return $likes;
  }

  function checkLike($data) {
    $pic_id = $data['pic_id'];
    $user_id = $data['user_id'];

    $query =
      "SELECT * FROM favs WHERE user_id = ".
        mysql_real_escape_string($user_id)." AND pic_id = ".
        mysql_real_escape_string($pic_id);
    $like = $this->connection->fetch_all($query);

    $query =
      "SELECT id, pic_id FROM favs WHERE pic_id = ".
        mysql_real_escape_string($pic_id);
    $picLikes = $this->connection->fetch_all($query);

    if (count($like)>0) {
      $data['status'] = "liked";
    }
    else {
      $data['status'] = "blank";
    }
    $data['count_likes'] = count($picLikes);
    echo json_encode($data);
  }

  function setLike($data) {
    $pic_id = $data['pic_id'];
    $pic_secret = $data['pic_secret'];
    $user_id = $data['user_id'];
    $lat = $data['lat'];
    $lon = $data['lon'];
    $location = $data['like_location'];
    $title = $data['name'];

    $query =
      "SELECT * FROM favs WHERE user_id = ".
        mysql_real_escape_string($user_id)." AND pic_id = ".
        mysql_real_escape_string($pic_id);
    $like = $this->connection->fetch_all($query);

    if (count($like)==0) {
      $query =
        "INSERT INTO favs (pic_id, pic_secret, user_id, lat, lon, location, title, created_at) VALUES ('".
          mysql_real_escape_string($pic_id)."', '".
          mysql_real_escape_string($pic_secret)."','".
          mysql_real_escape_string($user_id)."', '".
          mysql_real_escape_string($lat)."', '".
          mysql_real_escape_string($lon)."','".
          mysql_real_escape_string($location)."','".
          mysql_real_escape_string($title)."', NOW())";
      mysql_query($query);

      $query = "SELECT id, pic_id FROM favs WHERE pic_id = ".
        mysql_real_escape_string($pic_id);
      $picLikes = $this->connection->fetch_all($query);
      $data['status'] = "like successful";
      $data['count_likes'] = count($picLikes);
      echo json_encode($data);
    }
    else {
      $query = "DELETE FROM favs WHERE id = ".
        mysql_real_escape_string($like[0]['id'])." AND user_id = ".
        mysql_real_escape_string($user_id)." AND pic_id = ".
        mysql_real_escape_string($pic_id);
      mysql_query($query);

      $query = "SELECT id, pic_id FROM favs WHERE pic_id = ".
        mysql_real_escape_string($pic_id);
      $picLikes = $this->connection->fetch_all($query);
      $data['status'] = "unlike successful";
      $data['count_likes'] = count($picLikes);
      echo json_encode($data);
    }
  }
}
