<?php
    include('connection.php');
    // session_start();

class Comment {

    // private $data; // associative array
    private $connection;

    function __construct() {
        // Make sure object is initialized into a valid state
        // assert(isset($data['id']));
        // $this->data = $data;
        $this->connection = new Database();
    }

    function processFormData($data) {

        if (isset($data['action']) && $data['action'] == 'comment')
        {
            $this->insertComment($data['pic_id'], $data['user_id'], $data['comment']);
        }
    }

    // static function currentUser() {
    //     // Returns a new object with current user
    //     return new Comment(array('id' => $_SESSION['id']));
    // }

    function getComments($pic_id) {
        // Return array with everybody as Person objects with is_friend property
        $query =
            "SELECT id, comment, (select user_name from users where user_id = id ) AS user FROM comments WHERE pic_id = ".$pic_id;
            // echo $query;
        $comments = $this->connection->fetch_all($query);
        // return array_map(function($data) { return new Comment($data); }, $comments);
        return $comments;
    }

    function insertComment($pic_id, $user_id, $comment) {

        if (isset($comment) AND $comment != '') {
            $query = "INSERT INTO comments (pic_id, user_id, comment) VALUES ('".$pic_id."','".$user_id."','".$comment."')";
            mysql_query($query);



        $posts = $this->connection->fetch_all("SELECT id FROM comments");
        $end = end($posts);
        $query = "SELECT comment, (select user_name from users where user_id = id ) AS user FROM comments WHERE id = ".$end['id'];
            // echo $query;
        $comments = $this->connection->fetch_all($query);
        // var_dump($comments);
        $html = "<tr><td>".$comments[0]['user']."</td><td>".$comments[0]['comment']."</td></tr>";

        $data['html'] = $html;
        echo json_encode($data);
    }

    }

    // function __get($name) {
    //     // Returns a property, one of id, name, email, or is_friend
    //     return $this->data[$name];
    // }

}

$data = new Comment();
$data->processFormData($_POST);



