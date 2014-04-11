<?php
class Picture {

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
    'sort' => 'interestingness-asc',
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
    $parts = explode(" ", $name);
    $newName = implode("+", $parts);

    $url = "http://maps.googleapis.com/maps/api/geocode/json?address=".$newName."&sensor=false";

    $rsp = file_get_contents($url);
    $rsp_obj = json_decode($rsp, true);
    // var_dump($rsp_obj);
    if ($rsp_obj['status'] == 'OK') {
      header("location: ../application/map.php?lat=".$rsp_obj['results'][0]['geometry']['location']['lat']."&lon=".$rsp_obj['results'][0]['geometry']['location']['lng']."&place=".$rsp_obj['results'][0]['formatted_address']);
    }
    else
    {
      $message[] = "Oops, something went wrong. Please search for a city name";
      $_SESSION['messages'] = $message;
      header('location: ../application/home.php');
    }
  }

  function getCityPics($lat, $lon, $page) {
    // $lat and $lon of requested city

    $params = array(
    'method'    => 'flickr.photos.search',
    'api_key'   => '8693270a9110a8a81910efea61aaf448',
    'tags' => 'Mural, Street Art, Graffiti, Urban Art, Wall Art',
    'tag_mode' => 'any',
    'sort' => 'relevance',
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
  function getPicsNearby($lat, $lon) {
    // $lat and $lon of requested city

    $params = array(
    'method'    => 'flickr.photos.search',
    'api_key'   => '8693270a9110a8a81910efea61aaf448',
    'tags' => 'Mural, Street Art, Graffiti, Urban Art, Wall Art',
    'tag_mode' => 'any',
    'sort' => 'relevance',
    'has_geo' => TRUE,
    'lat' => $lat,
    'lon' => $lon,
    'radius' => '0.5',
    'per_page' => '50',
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

}

$picture = new Picture();
$picture->processFormData($_POST);