<?php
class Commment {

    private $data; // associative array
    private $connection;

    function __construct($data) {
        // Make sure object is initialized into a valid state
        assert(isset($data['id']));
        $this->data = $data;
        $this->connection = new Database();
    }

    static function currentUser() {
        // Returns a new object with current user
        return new Comment(array('id' => $_SESSION['id']));
    }

    function getComments() {
        // Return array with everybody as Person objects with is_friend property
        $query =
            "SELECT
                id,
                comment,
                (select user_name from user where id = ".$this->id.") AS user_name
            FROM comments WHERE pic_id = ".$this->pic_id;
        $comments = $this->connection->fetch_all($query);
        return array_map(function($data) { return new Person($data); }, $comments);
    }

    function __get($name) {
        // Returns a property, one of id, name, email, or is_friend
        return $this->data[$name];
    }

}

