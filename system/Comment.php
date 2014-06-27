<?php
class Comment {

  private $connection;

  function __construct() {
    $this->connection = new Database();
  }

  function processFormData($data) {
    if (isset($data['action']) && $data['action'] == 'comment') {
      $this->insertComment($data);
    }
  }

  function getComments($data) {
    $query =
      "SELECT id, comment, (select user_name from users where user_id = id ) AS user FROM comments WHERE pic_id = ".
        mysql_real_escape_string($data);
    $comments = $this->connection->fetch_all($query);
    return $comments;
  }

  function insertComment($data) {
    $pic_id = $data['pic_id'];
    $user_id = $data['user_id'];
    $comment = $data['comment'];

    if (isset($comment) AND $comment != '') {
      $query = "INSERT INTO comments (pic_id, user_id, comment) VALUES ('".
        mysql_real_escape_string($pic_id)."','".
        mysql_real_escape_string($user_id)."','".
        mysql_real_escape_string($comment)."')";
    mysql_query($query);

    $data['status'] = "comment successful";
    echo json_encode($data);
    }
  }
}
