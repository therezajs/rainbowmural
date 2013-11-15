<?php
class Picture {

    // private $data; // associative array
    // private $connection;

    // function __construct($data) {
    //     // Make sure object is initialized into a valid state

    //     $this->data = $data;
    //     $this->connection = new Database();
    // }

    function getRandomPics($lat, $lon, $limit) {

        $params = array(
        'method'    => 'flickr.photos.search',
        'api_key'   => '8abd07e60daeea28e2170bedcf9b984c',
        'tags' => 'mural, street art, graffiti',
        'tag_mode' => 'any',
        'sort' => 'interestingness_desc',
        'has_geo' => TRUE,
        'lat' => $lat,
        'lon' => $lon,
        'per_page' => $limit,
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

        // echo '<br><br>';
        // var_dump($rsp_obj);
        // if ($rsp_obj['stat'] == 'ok'){
        //     for ($i=0; $i < $limit ; $i++) {
        //         $id = $rsp_obj['photos']['photo'][$i]['id'];
        //         $title = $rsp_obj['photos']['photo'][$i]['owner'];
        //         $farm = $rsp_obj['photos']['photo'][$i]['farm'];
        //         $server = $rsp_obj['photos']['photo'][$i]['server'];
        //         $secret = $rsp_obj['photos']['photo'][$i]['secret'];
        //     }


        // }else{

        //     var_dump($rsp_obj);
        // }
    }

    function getCityPics($lat, $lon) {
        // $lat and $lon of requested city

        $params = array(
        'method'    => 'flickr.photos.search',
        'api_key'   => '8abd07e60daeea28e2170bedcf9b984c',
        'tags' => 'mural, street art, graffiti',
        'tag_mode' => 'any',
        'sort' => 'interestingness_desc',
        'has_geo' => TRUE,
        'lat' => $lat,
        'lon' => $lon,
        'per_page' => '50',
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

    function getPic() {
    }

    // function __get($name) {
    //     // Returns a property, one of id, name, email, or is_friend
    //     return $this->data[$name];
    // }

}

