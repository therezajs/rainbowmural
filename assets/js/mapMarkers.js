
var paramStr = window.location.search;
var paramArr = paramStr.split('&');
var lat = paramArr[0].split('=')[1];
var lon = paramArr[1].split('=')[1];

function initialize() {
  var mapOptions = {
    center: new google.maps.LatLng(lat,lon),
    zoom: 12,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };
  var map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);
  var current_marker = null;
  photos.forEach(function(each) {
    var ll = new google.maps.LatLng(each.latitude,each.longitude);
    var marker = new google.maps.Marker({
      position: ll,
      map: map,
      title: each.title
    });
    var contentString = '<a href="detail.php?lat=' + each.latitude + '&lon=' + each.longitude + '&id=' + each.id + '&secret=' + each.secret + '"><img class="images" src="http://www.flickr.com/photos/'+each.id+'_'+each.secret+'_s.jpg"></a>';

    var that = this;
    that.infowindow = new google.maps.InfoWindow({
      content: contentString
    });

    google.maps.event.addListener(marker, 'mouseover', function() {
      if(current_marker && this.__gm_id != current_marker.__gm_id)
      {
        that.infowindow.close();
      }
      current_marker = marker;
      that.infowindow.content = contentString;
      that.infowindow.setOptions({ disableAutoPan : true });
      that.infowindow.open(map, current_marker);
    });
  });
}

google.maps.event.addDomListener(window, 'load', initialize);
