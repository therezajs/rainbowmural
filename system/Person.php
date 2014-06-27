<?php
class Person {

  private $data; // associative array
  private $connection;

  function __construct($data) {
    assert(isset($id));
    $this->data = $data;
    $this->connection = new Database();
  }

  static function currentUser() {
    // Returns a new object with current user
    return new Comment(array('id' => $_SESSION['id']));
  }

  function getComments() {
    // Returns array with everybody as Person objects with is_friend property
    $query =
      "SELECT
        id,
        comment,
        (select user_name from user where id = ".
          mysql_real_escape_string($this->id).") AS user_name
        FROM comments WHERE pic_id = ".
          mysql_real_escape_string($this->pic_id);
    $comments = $this->connection->fetch_all($query);
    return array_map(function($data) { return new Person($data); }, $comments);
  }

  function __get($name) {
    // Returns a property, one of id, name, email, or is_friend
    return $this->data[$name];
  }
}
