function initMap() {
	// The location of Uluru
	var uluru = {lat: -25.344, lng: 131.036};
	// The map, centered at Uluru
	var map = new google.maps.Map(
	  document.getElementById('map'), {zoom: 4, center: uluru});
	// The marker, positioned at Uluru
	var marker = new google.maps.Marker({position: uluru, map: map});
}

function showCTDCGlobalDataset() {
	$('#regions_div_container').hide();
	$('#map').show();
	$('#ctdc-corridor').hide();
	$('#ctdc-dataset-layers').show();
}

function showCTDCGlobalCorridor() {
	//$('.loader').hide();
	$('#map').hide();
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
	$('#map').show();
	$('#ctdc-corridor').hide();
	$('#ctdc-dataset-layers').show();
});