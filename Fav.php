<?php
class Fav {

    // private $data; // associative array
    private $connection;

    function __construct() {
        // Make sure object is initialized into a valid state
        // assert(isset($data['id']));
        // $this->data = $data;
        $this->connection = new Database();
    }


    function processFormData($data) {

        if (isset($data['action']) && $data['action'] == 'like_button')
        {
            $this->setLike($data['pic_id'], $data['user_id']);
        }
    }

    function getLikes($user_id) {
        // Return array with everybody as Person objects with is_friend property
        $query =
            "SELECT *FROM favs WHERE user_id = ".$user_id;
            // echo $query;
        $likes = $this->connection->fetch_all($query);
        // return array_map(function($data) { return new Comment($data); }, $comments);
        return $likes;
    }

    function setLike($pic_id, $user_id) {

    	$query =
            "SELECT * FROM favs WHERE user_id = ".$user_id." AND pic_id = ". $pic_id;
            echo $query;
        $like = $this->connection->fetch_all($query);

        if (count($like)==0) {
            $query = "INSERT INTO favs (pic_id, user_id) VALUES ('".$pic_id."','".$user_id."')";
            mysql_query($query);

        	echo json_encode("like successful");
    	}

    }
}