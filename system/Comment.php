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
      "SELECT id, comment, (select user_name from users where user_id = id ) AS user FROM comments WHERE pic_id = ".
        mysql_real_escape_string($pic_id);
    $comments = $this->connection->fetch_all($query);
    return $comments;
  }

  function insertComment($pic_id, $user_id, $comment) {
    if (isset($comment) AND $comment != '') {
      $query = "INSERT INTO comments (pic_id, user_id, comment) VALUES ('".
        mysql_real_escape_string($pic_id)."','".
        mysql_real_escape_string($user_id)."','".
        mysql_real_escape_string($comment)."')";
    mysql_query($query);

    $data[] = "comment successful";
    echo json_encode($data);
    }
  }
}
