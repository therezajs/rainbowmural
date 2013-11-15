<?php
#
# build the API URL to call
#
// API Key: 8693270a9110a8a81910efea61aaf448
// secret key: c5afad442ba13489

// http://api.flickr.com/services
function getInfo() {
$params = array(
	'api_key'	=> '8693270a9110a8a81910efea61aaf448',
	'method'	=> 'flickr.photos.getInfo',
	'photo_id'	=> '251875545',
	'format'	=> 'php_serial',
);

$encoded_params = array();

foreach ($params as $k => $v){

	$encoded_params[] = urlencode($k).'='.urlencode($v);
}


#
# call the API and decode the response
#

$url = "http://api.flickr.com/services/rest/?".implode('&', $encoded_params);

$rsp = file_get_contents($url);

echo $url . "<br>";

$rsp_obj = unserialize($rsp);


#
# display the photo title (or an error if it failed)
#

if ($rsp_obj['stat'] == 'ok'){

	$photo_title = $rsp_obj['photo']['title']['_content'];

	echo "Title is $photo_title!<br>";
	var_dump($rsp_obj);
}else{

	echo "Call failed!";
}
}

function getGeoLocation(){
	$params = array(
	'api_key'	=> '8693270a9110a8a81910efea61aaf448',
	'method'	=> 'flickr.photos.geo.getLocation',
	'photo_id'	=> '251875545',
	'format'	=> 'php_serial',
	);

	$encoded_params = array();

	foreach ($params as $k => $v){

		$encoded_params[] = urlencode($k).'='.urlencode($v);
	}
	$url = "http://api.flickr.com/services/rest/?".implode('&', $encoded_params);

	$rsp = file_get_contents($url);

	$rsp_obj = unserialize($rsp);

	if ($rsp_obj['stat'] == 'ok'){

		$photo_title = $rsp_obj['photo']['title']['_content'];


		echo "Title is $photo_title!<br>";
		var_dump($rsp_obj);
	}else{

			var_dump($rsp_obj);
	}
}

function tags($tag) {
	$params = array(
	'api_key'	=> '8693270a9110a8a81910efea61aaf448',
	'method'	=> 'flickr.tags.getRelated',
	'tag' => $tag
	);

	$encoded_params = array();

	foreach ($params as $k => $v){

		$encoded_params[] = urlencode($k).'='.urlencode($v);
	}
	$url = "http://api.flickr.com/services/rest/?".implode('&', $encoded_params);

	echo $url . "<br>";

	$rsp = file_get_contents($url);

	echo $rsp . "<br>";

	$street_tags = " graffiti stencil art street wall paint sticker urban london mural banksy spray tag red city nyc berlin stickers germany paris pasteup france painting spraypaint tags urbanart grafitti graff newyork face yellow girl blue poster sanfrancisco love newyorkcity black barcelona door wheatpaste pink sign spain arte graf uk stencils heart bw color green canon skull artist nikon colors melbourne white train brooklyn ";
	$tags = explode(" ", $street_tags);

	foreach ($tags as $tag) {
		echo $tag . "<br>";
	}
}

function getCluster($tag) {
	$params = array(
	'api_key'	=> '8693270a9110a8a81910efea61aaf448',
	'method'	=> 'flickr.tags.getClusters',
	'tag' => $tag,
	'format'	=> 'php_serial',
	);

	$encoded_params = array();

	foreach ($params as $k => $v){

		$encoded_params[] = urlencode($k).'='.urlencode($v);
	}
	$url = "http://api.flickr.com/services/rest/?".implode('&', $encoded_params);

	echo $url . "<br>";

	$rsp = file_get_contents($url);

	echo $rsp . "<br>";
	$rsp_obj = unserialize($rsp);

	if ($rsp_obj['stat'] == 'ok'){

		$photo_title = $rsp_obj['photo']['title']['_content'];


		echo "Title is $photo_title!<br>";
		var_dump($rsp_obj);
	}else{

		var_dump($rsp_obj);
	}

}

function search($tag) {
	$params = array(
	'api_key'	=> '8693270a9110a8a81910efea61aaf448',
	'method'	=> 'flickr.photos.search',
	'tag' => $tag,
	'tag-mode' => 'all',
	'has_geo' => TRUE,
	'format'	=> 'php_serial',
	);

	$encoded_params = array();

	foreach ($params as $k => $v){

		$encoded_params[] = urlencode($k).'='.urlencode($v);
	}
	$url = "http://api.flickr.com/services/rest/?".implode('&', $encoded_params);


	$rsp = file_get_contents($url);

	$rsp_obj = unserialize($rsp);
	echo '<br><br>';
	var_dump($rsp_obj);
	if ($rsp_obj['stat'] == 'ok'){
		for ($i=0; $i < 250 ; $i++) {
			$photo_id = $rsp_obj['photos']['photo'][$i]['id'];
			$photo_title = $rsp_obj['photos']['photo'][$i]['title'];
			echo $photo_title ." - ". $photo_id . "<br>";
		}


	}else{

		var_dump($rsp_obj);
	}
}
getInfo();
search('street art , murals, sanfrancisco');
// echo "http://flickr.com/photos/' . $flickr->username . '/' . $photo->attributes()->id . '"><img src="http://farm' . $photo->attributes()->farm . '.static.flickr.com/' . $photo->attributes()->server . '/' . $photo->attributes()->id . '_' . $photo->attributes()->secret . '_s.jpg" ';
