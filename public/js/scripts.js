/*function initMap() {
	// The location of Uluru
	var uluru = {lat: -25.344, lng: 131.036};
	// The map, centered at Uluru
	var map = new google.maps.Map(
	  document.getElementById('map'), {zoom: 4, center: uluru});
	// The marker, positioned at Uluru
	var marker = new google.maps.Marker({position: uluru, map: map});
}*/

function showCTDCGlobalDataset() {
	$('#regions_div_container').hide();
	$('#mapid').show();
	$('#ctdc-corridor').hide();
	$('#ctdc-dataset-layers').show();

	var map = L.map('mapid', {
	    center: [51.505, -0.09],
	    zoom: 13
	});
}

function showCTDCGlobalCorridor() {
	//$('.loader').hide();
	$('#mapid').hide();
	$('#regions_div_container').show();
	$('#ctdc-corridor').show();
	$('#ctdc-dataset-layers').hide();
}

google.charts.load('current', {
'packages':['geochart'],
// Note: you will need to get a mapsApiKey for your project.
// See: https://developers.google.com/chart/interactive/docs/basic_load_libs#load-settings
'mapsApiKey': 'AIzaSyD-9tSrke72PouQMnMX-a7eZSW0jkFMBWY'
});
google.charts.setOnLoadCallback(drawRegionsMap);

function drawRegionsMap() {
var data = google.visualization.arrayToDataTable([
  ['Country', 'Popularity'],
  ['Germany', 200],
  ['United States', 300],
  ['Brazil', 400],
  ['Canada', 500],
  ['France', 600],
  ['RU', 700]
]);

var options = {};

var chart = new google.visualization.GeoChart(document.getElementById('regions_div'));

chart.draw(data, options);
}

$( document ).ready(function() {
    $('#regions_div_container').hide();
	initMap();
	$('#ctdc-corridor').hide();
	$('#ctdc-dataset-layers').show();
});


function initMap(){
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

	/*L.polygon([
		[51.509, -0.08],
		[51.503, -0.06],
		[51.51, -0.047]
	]).addTo(mymap);*/
}