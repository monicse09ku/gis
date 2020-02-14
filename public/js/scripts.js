var base_url = '';
$( document ).ready(function() {
	$('.loader').show();

	$('.arrivals-layers').show();
	$('.incidents-layers').hide();

	$('.year').show();
	$('.country').show();
	$('.month').hide();

	$('.arrivals-refresh').show();
	$('.incidents-refresh').hide();
	$('.graph-refresh').hide();

	$('.year').val(2018);
	$('.country').val();
	$('.month').val();

	$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

	base_url = $('#myurl').val();
    showArrivals();
});

function showArrivals() {
	$('.loader').show();

	$('.arrivals-layers').show();
	$('.incidents-layers').hide();

	$('.year').show();
	$('.country').show();
	$('.month').hide();

	$('.arrivals-refresh').show();
	$('.incidents-refresh').hide();
	$('.graph-refresh').hide();

	$('.year').val(2018);
	$('.country').val('');
	$('.month').val();

	
	document.getElementById('map_container').innerHTML = "<div id='mapid'></div>";

	var url = base_url + '/get-arrivals';

	$.ajax({
       	type:'POST',
       	url:url,
       	data:{year:2018},
       	success:function(data){
          	var arrivals = JSON.parse(data);
			generateArrivalsMap(arrivals.arrivals);
       	}
    });
}

function generateArrivalsMap(arrivals) {
	var myMap = L.map('mapid').setView([47.00, 9.00], 4);
	L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
	  maxZoom: 13,
	  attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
	    '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
	    'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
	  id: 'mapbox.streets'
	}).addTo(myMap);

	/*var host = 'https://maps.omniscale.net/v2/{id}/style.grayscale/{z}/{x}/{y}.png';

    var attribution = '&copy; 2019 &middot; <a href="https://maps.omniscale.com/">Omniscale</a> ' +
        '&middot; Map data: <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>';

    var myMap = L.map('mapid').setView([47.00, 9.00], 4);
      L.tileLayer(host, {
        id: 'gis-1925f3ae',
        attribution: attribution
      }).addTo(myMap);

    myMap.attributionControl.setPrefix(false);*/

	$.each( arrivals, function( key, value ) {
	  	var circle = L.marker([value.latitude, value.longitude], {
	    	color: 'red',
	    	icon: getArrivalMarker(value.total_arrival),
	    	data: value
	  	}).addTo(myMap).on("click", arrivalsCircleClick);
	});

	$('.loader').hide();
// Set the view to where some of the circles are drawn.
//myMap.panTo([53.00, 9.00]);
}

function getArrivalMarker(total_arivals) {
	var icon_size = 0;
	var image = 'circular-shape-green64.png';
	if(total_arivals < 0){
		image = 'circular-shape-blue64.png';
	}
	
	var arrival = Math.abs(total_arivals);

	if(arrival == 0){
		icon_size = [0, 0];
	}else if(arrival > 0 && arrival < 1000){
		icon_size = [5, 5];
	}else if(arrival >= 1000 && arrival < 2000){
		icon_size = [9, 9];
	}else if(arrival >= 2000 && arrival < 4000){
		icon_size = [13, 13];
	}else if(arrival >= 4000 && arrival < 8000){
		icon_size = [17, 17];
	}else if(arrival >= 8000 && arrival < 12000){
		icon_size = [21, 21];
	}else if(arrival >= 12000 && arrival < 15000){
		icon_size = [25, 25];
	}else{
		icon_size = [30, 30];
	}

	var greenIcon = L.icon({
	    iconUrl: base_url + '/images/' + image,
	    //shadowUrl: 'leaf-shadow.png',

	    iconSize:    icon_size , // size of the icon
	    //shadowSize:   [50, 64], // size of the shadow
	    //iconAnchor:   [22, 94], // point of the icon which will correspond to marker's location
	    //shadowAnchor: [4, 62],  // the same for the shadow
	    //popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
	});

	return greenIcon;
}

function arrivalsCircleClick(e) {
	$('.loader').show();
    var clickedCircle = e.target;
	console.log(clickedCircle.options);
	var url = base_url + '/get-single-arrival';

	$.ajax({
       	type:'POST',
       	url:url,
       	data:{
       		country:clickedCircle.options.data.country, 
       		total_arrival: clickedCircle.options.data.total_arrival,
       		year:$('.year').val()
       	},
       	success:function(data){
          	var single_arrivals = JSON.parse(data);
			generateSingleArrivalsMap(single_arrivals.arrivals);
       	}
    });
}

function refreshArrivals() {
	$('.loader').show();

	var url = base_url + '/refresh-arrival';

	$.ajax({
       	type:'POST',
       	url:url,
       	data:{
       		country:$('.country').val(),
       		year:$('.year').val()
       	},
       	success:function(data){
          	var single_arrivals = JSON.parse(data);
			generateSingleArrivalsMap(single_arrivals.arrivals);
       	}
    });
}

function generateSingleArrivalsMap(arrivals) {

	document.getElementById('map_container').innerHTML = "<div id='mapid'></div>";

	var myMap = L.map('mapid').setView([47.00, 9.00], 4);
	L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
	  maxZoom: 13,
	  attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
	    '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
	    'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
	  id: 'mapbox.streets'
	}).addTo(myMap);

	$.each( arrivals, function( key, value ) {
	  	var circle1 = L.marker([value.latitude, value.longitude], {
	    	color: 'red',
	    	icon: getSingleArrivalMarker(value, 'country_to'),
	    	data: value
	  	}).addTo(myMap);

	  	var circle2 = L.marker([value.country_from_latitude, value.country_from_longitude], {
	    	color: 'red',
	    	icon: getSingleArrivalMarker(value, 'country_from'),
	    	data: value
	  	}).addTo(myMap);

	  	var pointA = new L.LatLng(value.latitude, value.longitude);
		var pointB = new L.LatLng(value.country_from_latitude, value.country_from_longitude);
		var pointList = [pointA, pointB];

		var firstpolyline = new L.Polyline(pointList, {
		    color: 'red',
		    weight: 3,
		    opacity: 0.5,
		    smoothFactor: 1
		});
		firstpolyline.addTo(myMap);
		myMap.panTo([value.latitude, value.longitude]);

		var arrow = L.polyline([ 
			[value.country_from_latitude, value.country_from_longitude],
			[value.latitude, value.longitude]
		], {}).addTo(myMap);
	    var arrowHead = L.polylineDecorator(arrow, {
	        patterns: [
	            {offset: '100%', repeat: 0, symbol: L.Symbol.arrowHead({pixelSize: 15, polygon: false, pathOptions: {stroke: true}})}
	        ]
	    }).addTo(myMap);
	});

	$('.loader').hide();
// Set the view to where some of the circles are drawn.
//myMap.panTo([53.00, 9.00]);
}

function getSingleArrivalMarker(arrival, to_or_from_country) {
	//console.log('arrival');console.log(arrival);return;
	
	if(to_or_from_country == 'country_to'){
		var icon_size = [15, 15];
		var image = 'circular-shape-green64.png';
	}else{
		var icon_size = [15, 15];
		var image = 'circular-shape-blue64.png';
	}

	var greenIcon = L.icon({
	    iconUrl: base_url + '/images/' + image,
	    //shadowUrl: 'leaf-shadow.png',

	    iconSize:    icon_size , // size of the icon
	    //shadowSize:   [50, 64], // size of the shadow
	    //iconAnchor:   [22, 94], // point of the icon which will correspond to marker's location
	    //shadowAnchor: [4, 62],  // the same for the shadow
	    //popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
	});

	return greenIcon;
}




function showIncidents() {
	$('.loader').show();
	
	$('.arrivals-layers').hide();
	$('.incidents-layers').show();

	$('.year').show();
	$('.country').hide();
	$('.month').show();

	$('.arrivals-refresh').hide();
	$('.incidents-refresh').show();
	$('.graph-refresh').hide();

	$('.year').val(2018);
	$('.country').val();
	$('.month').val();

	document.getElementById('map_container').innerHTML = "<div id='mapid'></div>";

	var url = base_url + '/get-incidents';

	$.ajax({
       	type:'POST',
       	url:url,
       	data:{year:2018},
       	success:function(data){
          	var incidents = JSON.parse(data);
			generateIncidentsMap(incidents.incidents);
       	}
    });
}

function refreshIncidents() {
	$('.loader').show();

	document.getElementById('map_container').innerHTML = "<div id='mapid'></div>";

	var url = base_url + '/refresh-incidents';

	$.ajax({
       	type:'POST',
       	url:url,
       	data:{
       		month:$('.month').val(),
       		year:$('.year').val()
       	},
       	success:function(data){
          	var incidents = JSON.parse(data);
			generateIncidentsMap(incidents.incidents);
       	}
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

	incidents.forEach(function(coord) {
		var circle = L.marker([coord.latitude, coord.longitude], {
			color: 'red',
			icon: getIcon(coord.total_dead_and_missing),
			data: coord
		}).addTo(myMap).on("click", incidentCircleClick);
	});
	$('.loader').hide();
// Set the view to where some of the circles are drawn.
//myMap.panTo([53.00, 9.00]);
}


function incidentCircleClick(e) {
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

function getIcon(total_dead_and_missing) {
	var icon_size = 0;
	var image = '1.png';

	if(total_dead_and_missing == 0){
		icon_size = [0, 0];
		image = '1.png';
	}else if(total_dead_and_missing > 0 && total_dead_and_missing < 100){
		icon_size = [40, 40];
		image = '2.png';
	}else if(total_dead_and_missing >= 100 && total_dead_and_missing < 200){
		icon_size = [45, 45];
		image = '3.png';
	}else if(total_dead_and_missing >= 200 && total_dead_and_missing < 300){
		icon_size = [50, 50];
		image = '4.png';
	}else if(total_dead_and_missing >= 300 && total_dead_and_missing < 400){
		icon_size = [55, 55];
		image = '5.png';
	}else if(total_dead_and_missing >= 400 && total_dead_and_missing < 500){
		icon_size = [60, 60];
		image = '6.png';
	}else{
		icon_size = [80, 80];
		image = '7.png';
	}

	var greenIcon = L.icon({
	    iconUrl: base_url + '/images/' + image,
	    //shadowUrl: 'leaf-shadow.png',

	    iconSize:    icon_size , // size of the icon
	    //shadowSize:   [50, 64], // size of the shadow
	    //iconAnchor:   [22, 94], // point of the icon which will correspond to marker's location
	    //shadowAnchor: [4, 62],  // the same for the shadow
	    //popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
	});

	return greenIcon;
}






function showGraphs(argument) {
	$('.loader').show();
	
	$('.arrivals-layers').hide();
	$('.incidents-layers').show();

	$('.year').show();
	$('.country').hide();
	$('.month').show();

	$('.arrivals-refresh').hide();
	$('.incidents-refresh').hide();
	$('.graph-refresh').show();

	$('.year').val(2018);
	$('.country').val();
	$('.month').val();

	$('.loader').hide();
}