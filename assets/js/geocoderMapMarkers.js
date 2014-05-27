var paramStr = window.location.search;
var paramArr = paramStr.split('&');
var pic_id = paramArr[2].split('=')[1];

var geocoder;
var map;
var lat;
var lon;
function initialize() {
  geocoder = new google.maps.Geocoder();
  lat = photo.location.latitude;
  lon = photo.location.longitude;
  var mapOptions = {
    center: new google.maps.LatLng(photo.location.latitude,photo.location.longitude),
    zoom: 14,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };
  map = new google.maps.Map(document.getElementById("map-canvas"),
    mapOptions);
  var ll = new google.maps.LatLng(photo.location.latitude,photo.location.longitude);
  var marker = new google.maps.Marker({
    position: ll,
    map: map,
    title: photo.title._content
  });
  var image = '../assets/images/red_dot.png';
  var current_dotMarker = null;
  photosNearby.forEach(function(each) {
    if (each.id != pic_id) {
      var myLatLng = new google.maps.LatLng(each.latitude,each.longitude);
      var dotMarker = new google.maps.Marker({
        position: myLatLng,
        map: map,
        icon: image
      });
      var contentString = '<a href="detail.php?lat=' +
        each.latitude + '&lon=' +
        each.longitude + '&id=' +
        each.id + '&secret=' +
        each.secret + '"><img class="images" src="http://www.flickr.com/photos/' +
        each.id + '_' +
        each.secret + '_s.jpg"></a>';
      var that = this;
      that.infowindow = new google.maps.InfoWindow({
        content: contentString
      });
      var infowindow = new google.maps.InfoWindow({
        content: contentString
      });

      google.maps.event.addListener(dotMarker, 'mouseover', function() {
        if(current_dotMarker && this.__gm_id != current_dotMarker.__gm_id) {
          that.infowindow.close();
        }
        current_marker = marker;
        that.infowindow.content = contentString;
        that.infowindow.setOptions({ disableAutoPan : true });
        that.infowindow.open(map, dotMarker);
      });
    }
  });
  codeLatLng();
}

google.maps.event.addDomListener(window, 'load', initialize);

function codeLatLng() {
  var latlng = new google.maps.LatLng(lat, lon);
  geocoder.geocode({'latLng': latlng}, function(results, status) {
    if (status == google.maps.GeocoderStatus.OK) {
      if (results[0]) {
        $('#like_location').html("<input type='hidden' name='like_location' value='" + results[3].formatted_address + "'>");
        $('#location').html((results[0].formatted_address).split(',').join('<br>'));
      }
    } else {
      alert("Geocoder failed due to: " + status);
    }
  });
}