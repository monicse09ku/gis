function showArrivals() {
	document.getElementById('map_container').innerHTML = "<div id='mapid'></div>";
	
	var mymap = L.map('mapid').setView([51.505, -0.09], 13);

	L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
		maxZoom: 18,
		attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
			'<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
			'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
		id: 'mapbox/streets-v11'
	}).addTo(mymap);

	//L.marker([51.5, -0.09]).addTo(mymap);

	L.circle([51.508, -0.11], {
		color: 'red',
		fillColor: '#f03',
		fillOpacity: 0.5,
		radius: 500
	}).addTo(mymap);

	L.polygon([
		[51.509, -0.08],
		[51.503, -0.06],
		[51.51, -0.047]
	]).addTo(mymap);
}

function showIncidents() {
	//$('.loader').hide();
	document.getElementById('map_container').innerHTML = "<div id='mapid'></div>";
	var myMap = L.map('mapid').setView([51.505, -0.09], 13);
L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
  maxZoom: 5,
  attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
    '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
    'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
  id: 'mapbox.streets'
}).addTo(myMap);

var latLong = [{
	  "lat": 23.59,
	  "lng": 85.56
	}, {
	  "lat": 9.19,
	  "lng": 92.77
	}, {
	  "lat": -4.18,
	  "lng": 37.83
	}, {
	  "lat": 4.73,
	  "lng": 11.1
	}, {
	  "lat": null,
	  "lng": null
	}, {
	  "lat": 5.49,
	  "lng": 10.85
	}, {
	  "lat": 1.4,
	  "lng": 9.51
	}, {
	  "lat": -10.61,
	  "lng": 29.3
	}, {
	  "lat": -9.27,
	  "lng": 35.04
	}, {
	  "lat": -6.22,
	  "lng": 30.59
	}, {
	  "lat": 1.5,
	  "lng": 30.03
	}, {
	  "lat": 1.17,
	  "lng": 28.76
	}, {
	  "lat": null,
	  "lng": null
	}, {
	  "lat": 1.71,
	  "lng": 15.95
	}, {
	  "lat": 2.2,
	  "lng": 22.61
	}, {
	  "lat": 0.679,
	  "lng": 34.77
	}];

// Here's where you iterate over the array of coordinate objects.
latLong.forEach(function(coord) {
  var circle = L.circle(coord, {
    color: 'red',
    fillColor: '#f03',
    fillOpacity: 0.5,
    radius: 50000,
    id: 'aaa'
  }).addTo(myMap).on("click", circleClick);
});

// Set the view to where some of the circles are drawn.
myMap.panTo([2, 22]);
}

$( document ).ready(function() {
    showArrivals();
});


function circleClick(e) {
    var clickedCircle = e.target;
console.log(clickedCircle.options)
  // do something, like:
  clickedCircle.bindPopup("some content").openPopup();
}