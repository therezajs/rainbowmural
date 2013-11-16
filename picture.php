<?php
class Picture {

    // private $data; // associative array
    // private $connection;

    // function __construct($data) {
    //     // Make sure object is initialized into a valid state

    //     $this->data = $data;
    //     $this->connection = new Database();
    // }

    function processFormData($data) {

        if (isset($data['action']) && $data['action'] == 'city')
        {

            $this->findCity($data['name']);

        }
    }

    function getRandomPics($limit, $page) {

        $params = array(
        'method' => 'flickr.photos.search',
        'api_key' => '8693270a9110a8a81910efea61aaf448',
        'tags' => 'Mural, Street Art, Graffiti, Urban Art, Wall Art',
        'tag_mode' => 'any',
        'sort' => 'interestingness_desc',
        'has_geo' => TRUE,
        'per_page' => $limit,
        'page' => $page,
        'extras' => 'geo',
        'format' => 'php_serial',
        );

        $encoded_params = array();

        foreach ($params as $k => $v){

            $encoded_params[] = urlencode($k).'='.urlencode($v);
        }
        $url = "http://api.flickr.com/services/rest/?".implode('&', $encoded_params);
        $rsp = file_get_contents($url);


        $rsp_obj = unserialize($rsp);
        // var_dump($rsp_obj);
        return $rsp_obj;
    }

    function findCity($name) {
        $params = array(
        'method' => 'flickr.places.find',
        'api_key' => '8693270a9110a8a81910efea61aaf448',
        'query' => $name,
        'format' => 'php_serial',
        );

        $encoded_params = array();

        foreach ($params as $k => $v){

            $encoded_params[] = urlencode($k).'='.urlencode($v);
        }
        $url = "http://api.flickr.com/services/rest/?".implode('&', $encoded_params);
        $rsp = file_get_contents($url);


        $rsp_obj = unserialize($rsp);
        // var_dump($rsp_obj);
        if ($rsp_obj['stat'] == 'ok'){
            if ($rsp_obj['places']['total'] == 0) {
                $message[] = "City name not valid";
                $_SESSION['messages'] = $message;
                header('location: index.php');
            }
            else
            {
                header("location: map.php?lat=".$rsp_obj['places']['place'][0]['latitude']."&lon=".$rsp_obj['places']['place'][0]['longitude']."&place=".$rsp_obj['places']['place'][0]['woe_name']);
            }
        }
        else
        {
            $message[] = "Oops, something went wrong. please search for a city name";
            $_SESSION['messages'] = $message;
            header('location: index.php');
        }
    }

    function getCityPics($lat, $lon, $page) {
        // $lat and $lon of requested city

        $params = array(
        'method'    => 'flickr.photos.search',
        'api_key'   => '8693270a9110a8a81910efea61aaf448',
        'tags' => 'Mural, Street Art, Graffiti, Urban Art, Wall Art',
        'tag_mode' => 'any',
        'sort' => 'interestingness_desc',
        'has_geo' => TRUE,
        'lat' => $lat,
        'lon' => $lon,
        'per_page' => '50',
        'page' => $page,
        'extras' => 'geo',
        'format'    => 'php_serial',
        );

        $encoded_params = array();

        foreach ($params as $k => $v){

            $encoded_params[] = urlencode($k).'='.urlencode($v);
        }
        $url = "http://api.flickr.com/services/rest/?".implode('&', $encoded_params);
        $rsp = file_get_contents($url);


        $rsp_obj = unserialize($rsp);
        // var_dump($rsp_obj);
        return $rsp_obj;
    }

    function getPicInfo($photo_id) {
        $params = array(
        'method'    => 'flickr.photos.getInfo',
        'api_key'   => '8693270a9110a8a81910efea61aaf448',
        'photo_id' => $photo_id,
        'format'    => 'php_serial',
        );

        $encoded_params = array();

        foreach ($params as $k => $v){

            $encoded_params[] = urlencode($k).'='.urlencode($v);
        }
        $url = "http://api.flickr.com/services/rest/?".implode('&', $encoded_params);
        $rsp = file_get_contents($url);


        $rsp_obj = unserialize($rsp);
        // var_dump($rsp_obj);
        return $rsp_obj;
    }

    // function __get($name) {
    //     // Returns a property, one of id, name, email, or is_friend
    //     return $this->data[$name];
    // }

}

$picture = new Picture();
$picture->processFormData($_POST);