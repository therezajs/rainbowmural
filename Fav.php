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
            $this->setLike($data['pic_id'], $data['pic_secret'], $data['user_id'], $data['lat'], $data['lon'], $data['like_location'], $data['name']);
        }
        elseif (isset($data['action']) && $data['action'] == 'check_like_button')
        {
            $this->checkLike($data['pic_id'], $data['user_id']);
        }
    }

    function getLikes($user_id) {
        // Return array with everybody as Person objects with is_friend property
        $query =
            "SELECT * FROM favs WHERE user_id = ".$user_id;
            // echo $query;
        $likes = $this->connection->fetch_all($query);
        // return array_map(function($data) { return new Comment($data); }, $comments);
        return $likes;
    }

    function checkLike($pic_id, $user_id) {
    	$query =
            "SELECT * FROM favs WHERE user_id = ".$user_id." AND pic_id = ". $pic_id;
            // echo $query;
        $like = $this->connection->fetch_all($query);

        $query =
            "SELECT id, pic_id FROM favs WHERE pic_id = ".$pic_id;
            // echo $query;
        $picLikes = $this->connection->fetch_all($query);

        if (count($like)>0) {
        	$data[] = "liked";
    	}
        else {
            $data[] = "placeholder";
        }

        $data[] = count($picLikes);

        echo json_encode($data);
    }

    function setLike($pic_id, $pic_secret, $user_id, $lat, $lon, $location, $title) {

    	$query =
            "SELECT * FROM favs WHERE user_id = ".$user_id." AND pic_id = ". $pic_id;
            // echo $query;
        $like = $this->connection->fetch_all($query);


        if (count($like)==0) {
            $query = "INSERT INTO favs (pic_id, pic_secret, user_id, lat, lon, location, title, created_at) VALUES ('".$pic_id."', '".$pic_secret."','".$user_id."', '".$lat."', '".$lon."','".$location."','".$title."', NOW())";
            mysql_query($query);

            $query = "SELECT id, pic_id FROM favs WHERE pic_id = ".$pic_id;
            // echo $query;
            $picLikes = $this->connection->fetch_all($query);

        	$data[] = "like successful";
            $data[] = count($picLikes);

            echo json_encode($data);
    	}
    	else
    	{
    		$query = "DELETE FROM favs WHERE id = ". $like[0]['id'] ." AND user_id = ".$user_id." AND pic_id = ". $pic_id;
    		// echo $query;
    		mysql_query($query);

            $query = "SELECT id, pic_id FROM favs WHERE pic_id = ".$pic_id;
            // echo $query;
            $picLikes = $this->connection->fetch_all($query);

    		$data[] = "unlike successful";
            $data[] = count($picLikes);

            echo json_encode($data);

    	}

    }
}