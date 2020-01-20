var base_url = '';
$( document ).ready(function() {
	base_url = $('#myurl').val();
    showArrivals();
});

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
	$('.loader').hide();
	document.getElementById('map_container').innerHTML = "<div id='mapid'></div>";

	var url = base_url + '/get-incidents';

	$.get( url, function( data ) {
		var incidents = JSON.parse(data);
		generateIncidentsMap(incidents.incidents);
	});
}

function generateIncidentsMap(incidents) {
	
	var myMap = L.map('mapid').setView([47.00, 9.00], 4);
	L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
	  maxZoom: 13,
	  attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
	    '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
	    'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
	  id: 'mapbox.streets'
	}).addTo(myMap);


// Here's where you iterate over the array of coordinate objects.
incidents.forEach(function(coord) {
  var circle = L.circle([coord.latitude, coord.longitude], {
    color: 'red',
    fillColor: '#f03',
    fillOpacity: 0.5,
    radius: getRadius(coord.total_dead_and_missing),
    data: coord
  }).addTo(myMap).on("click", circleClick);
});

// Set the view to where some of the circles are drawn.
//myMap.panTo([53.00, 9.00]);
}


function circleClick(e) {
    var clickedCircle = e.target;
console.log(clickedCircle.options)
  // do something, like:
  //clickedCircle.bindPopup("some content").openPopup();
  $('.region').html(clickedCircle.options.data.region);
  $('.time').html(clickedCircle.options.data.month + ', ' + clickedCircle.options.data.year);
  $('.number_of_death').html(clickedCircle.options.data.number_of_death);
  $('.minimum_estimated_number_of_missing').html(clickedCircle.options.data.minimum_estimated_number_of_missing);
  $('.total_dead_and_missing').html(clickedCircle.options.data.total_dead_and_missing);
  $('.number_of_survivors').html(clickedCircle.options.data.number_of_survivors);
  $('.cause_of_death').html(clickedCircle.options.data.cause_of_death);
  $('.location_description').html(clickedCircle.options.data.location_description);

  $('#incidentDetailModal').modal('show');
}

function getRadius(total_dead_and_missing) {
	if(total_dead_and_missing == 0){
		return 0;
	}else if(total_dead_and_missing > 0 && total_dead_and_missing < 50){
		return 10000;
	}else if(total_dead_and_missing >= 100 && total_dead_and_missing < 200){
		return 30000;
	}else if(total_dead_and_missing >= 200 && total_dead_and_missing < 300){
		return 50000;
	}else if(total_dead_and_missing >= 300 && total_dead_and_missing < 400){
		return 70000;
	}else if(total_dead_and_missing >= 400 && total_dead_and_missing < 500){
		return 90000;
	}else{
		return 110000;
	}
}