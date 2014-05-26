<?php

class Comment {

  private $connection;

  function __construct() {
    $this->connection = new Database();
  }

  function processFormData($data) {
    if (isset($data['action']) && $data['action'] == 'comment') {
      $this->insertComment($data['pic_id'], $data['user_id'], $data['comment']);
    }
  }

  function getComments($pic_id) {
    $query =
      "SELECT id, comment, (select user_name from users where user_id = id ) AS user FROM comments WHERE pic_id = ".$pic_id;
    $comments = $this->connection->fetch_all($query);
    return $comments;
  }

  function insertComment($pic_id, $user_id, $comment) {
    if (isset($comment) AND $comment != '') {
      $query = "INSERT INTO comments (pic_id, user_id, comment) VALUES ('".$pic_id."','".$user_id."','".$comment."')";
    mysql_query($query);

    $posts = $this->connection->fetch_all("SELECT id FROM comments");
    $end = end($posts);
    $query = "SELECT comment, (select user_name from users where user_id = id ) AS user FROM comments WHERE id = ".$end['id'];
    $comments = $this->connection->fetch_all($query);
    $html = "<p><strong class='user'>".$comments[0]['user']."</strong>  ".$comments[0]['comment']."</p>";

    $data['html'] = $html;
    echo json_encode($data);
    }
  }
}
