var base_url = '';
$( document ).ready(function() {
	$('.loader').show();

	$('#map_container').show();
	$('#graph_container').hide();

	$('.arrivals-layers').show();
	$('.incidents-layers').hide();
	$('.details-layers').hide();

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

function toggleSidebar() {
	if($('.legends-sidebar').is(":hidden")){
        $('.legends-sidebar').show();
    }else{
        $('.legends-sidebar').hide();
    }
}

function showArrivals() {
	$('.loader').show();

	$('.legends-sidebar').show();
	$('.toggle-sidebar-button').show();

	$('#map_container').show();
	$('#graph_container').hide();

	$('.arrivals-layers').show();
	$('.incidents-layers').hide();
	$('.details-layers').hide();

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
	document.getElementById('map_container').innerHTML = "<div id='mapid'></div>";
	var myMap = L.map('mapid').setView([40.00, 40.00], 4);
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
	  	}).bindPopup(value.country).addTo(myMap).on("click", arrivalsCircleClick);

	  	circle.on('mouseover',function(ev) {
		  	circle.openPopup();
		});
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

	/*if(arrival == 0){
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
	}*/

	if(arrival == 0){
		icon_size = [0, 0];
	}else if(arrival > 0 && arrival < 5000){
		icon_size = [9, 9];
	}else if(arrival >= 5001 && arrival < 10000){
		icon_size = [15, 15];
	}else if(arrival >= 10001 && arrival < 15000){
		icon_size = [22, 22];
	}else if(arrival >= 15001 && arrival < 25000){
		icon_size = [30, 30];
	}else if(arrival >= 25001 && arrival < 30000){
		icon_size = [43, 43];
	}else{
		icon_size = [60, 60];
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
			generateSingleArrivalsMap(single_arrivals.arrivals, true);
       	}
    });
}

function arrivalsDestinationCircleClick(e) {
	$('.loader').show();
    var clickedCircle = e.target;
	var url = base_url + '/get-single-arrival';

	$.ajax({
       	type:'POST',
       	url:url,
       	data:{
       		country:clickedCircle.options.data.country_to.name, 
       		total_arrival: 1,
       		year:$('.year').val()
       	},
       	success:function(data){
          	var single_arrivals = JSON.parse(data);
			generateSingleArrivalsMap(single_arrivals.arrivals, true);
       	}
    });
}

function arrivalsOriginCircleClick(e) {
	$('.loader').show();
    var clickedCircle = e.target;
	var url = base_url + '/get-single-arrival';

	$.ajax({
       	type:'POST',
       	url:url,
       	data:{
       		country:clickedCircle.options.data.country_from.name, 
       		total_arrival: -1,
       		year:$('.year').val()
       	},
       	success:function(data){
          	var single_arrivals = JSON.parse(data);
			generateSingleArrivalsMap(single_arrivals.arrivals, true);
       	}
    });
}

function refreshArrivals() {
	$('.loader').show();
	var show_lines = true;
	var url = base_url + '/refresh-arrival';
	if($('.country').val() === ''){
		show_lines = false;
		$('.arrivals-layers').show();
		$('.incidents-layers').hide();
		$('.details-layers').hide();
	}

	$.ajax({
       	type:'POST',
       	url:url,
       	data:{
       		country:$('.country').val(),
       		year:$('.year').val()
       	},
       	success:function(data){
          	var single_arrivals = JSON.parse(data);
          	if($('.country').val() === ''){
				generateArrivalsMap(single_arrivals.arrivals);
			}else{
				generateSingleArrivalsMap(single_arrivals.arrivals, show_lines);
			}
			
       	}
    });
}

function generateSingleArrivalsMap(arrivals, show_lines = true) {
	
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
	  	var circle1 = L.marker([value.country_to.lat, value.country_to.lon], {
	    	color: 'red',
	    	icon: getSingleArrivalMarker(value, 'country_to'),
	    	data: value
	  	}).bindPopup(value.country_to.name).addTo(myMap).on("click", arrivalsDestinationCircleClick);
	  	circle1.on('mouseover',function(ev) {
		 	 circle1.openPopup();
		});

	  	var circle2 = L.marker([value.country_from.lat, value.country_from.lon], {
	    	color: 'red',
	    	icon: getSingleArrivalMarker(value, 'country_from'),
	    	data: value
	  	}).bindPopup(value.country_from.name).addTo(myMap).on("click", arrivalsOriginCircleClick);
	  	circle2.on('mouseover',function(ev) {
		 	 circle2.openPopup();
		});

	  	if(show_lines){
	  		var pointA = new L.LatLng(value.country_to.lat, value.country_to.lon);
			var pointB = new L.LatLng(value.country_from.lat, value.country_from.lon);
			var pointList = [pointA, pointB];

			var firstpolyline = new L.Polyline(pointList, {
			    color: 'red',
			    weight: 3,
			    opacity: 0.5,
			    smoothFactor: 1
			});
			firstpolyline.addTo(myMap);
			myMap.panTo([value.country_to.lat, value.country_to.lon]);

			var arrow = L.polyline([ 
				[value.country_from.lat, value.country_from.lon],
				[value.country_to.lat, value.country_to.lon]
			], {}).addTo(myMap);
		    var arrowHead = L.polylineDecorator(arrow, {
		        patterns: [
		            {offset: '100%', repeat: 0, symbol: L.Symbol.arrowHead({pixelSize: 15, polygon: false, pathOptions: {stroke: true}})}
		        ]
		    }).addTo(myMap);

		    showDetails(arrivals);
	  	}
	  	
	});

	
	
	$('.loader').hide();
// Set the view to where some of the circles are drawn.
//myMap.panTo([53.00, 9.00]);
}

function getSingleArrivalMarker(arrival, to_or_from_country) {
	var icon_size = 0;
	var arrival = Math.abs(arrival.value);

	if(arrival == 0){
		icon_size = [0, 0];
	}else if(arrival > 0 && arrival < 5000){
		icon_size = [9, 9];
	}else if(arrival >= 5001 && arrival < 10000){
		icon_size = [15, 15];
	}else if(arrival >= 10001 && arrival < 15000){
		icon_size = [22, 22];
	}else if(arrival >= 15001 && arrival < 25000){
		icon_size = [30, 30];
	}else if(arrival >= 25001 && arrival < 30000){
		icon_size = [43, 43];
	}else{
		icon_size = [60, 60];
	}
	
	if(to_or_from_country == 'country_to'){
		var image = 'circular-shape-green64.png';
	}else{
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

function showDetails(arrivals) {

	var destination_details = '';
	if(arrivals[0].country_id === arrivals[1].country_id){

		var total_migrants = 0;

		$('.arrivals-layers').hide();
		$('.details-layers').show();

		$.each( arrivals, function( key, value ) {
			total_migrants = total_migrants + value.value;
			destination_details += '<tr><td>' + value.country_from.iso3 + '</td><td>' + value.value + '</td><td>' + value.percentage +'%</td></tr>'
		})

		$('.destination-country').html(arrivals[0].country_to.name);
		$('.destination-label').html('country of migration destination');
		$('.origin-label').html('country of origin');
		$('.total-migrants').html(total_migrants);
		$('.destination-details').html(destination_details);
	}else{
		var total_migrants = 0;

		$('.arrivals-layers').hide();
		$('.details-layers').show();

		$.each( arrivals, function( key, value ) {
			total_migrants = total_migrants + value.value;
			destination_details += '<tr><td>' + value.country_to.iso3 + '</td><td>' + value.value + '</td><td>' +value.percentage +'%</td></tr>'
		})

		$('.destination-country').html(arrivals[0].country_from.name);
		$('.destination-label').html('country of migration origin');
		$('.origin-label').html('country of migration');
		$('.total-migrants').html(total_migrants);
		$('.destination-details').html(destination_details);
	}
}



function showIncidents() {
	$('.loader').show();

	$('.legends-sidebar').show();
	$('.toggle-sidebar-button').show();

	$('#map_container').show();
	$('#graph_container').hide();
	
	$('.arrivals-layers').hide();
	$('.incidents-layers').show();
	$('.details-layers').hide();

	$('.year').show();
	$('.country').hide();
	$('.month').show();

	$('.arrivals-refresh').hide();
	$('.incidents-refresh').show();
	$('.graph-refresh').hide();

	$('.year').val(2018);
	$('.country').val();
	$('.month').val('');

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
	
	var myMap = L.map('mapid').setView([40.00, 10.00], 5);
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
		//}).addTo(myMap).on("click", incidentCircleClick);
		}).bindPopup(
		'<b>Region: </b>' + coord.region + '</br>' + 
		'<b>Time: </b>' + coord.month + ', ' + coord.year + '</br>' + 
		'<b>Total Dead and Missing: </b>' + coord.total_dead_and_missing + '</br>' + 
		'<b>Cause of Death: </b>' + coord.cause_of_death 
		).addTo(myMap);

		circle.on('mouseover',function(ev) {
		 	 circle.openPopup();
		});

	});
	$('.loader').hide();
// Set the view to where some of the circles are drawn.
//myMap.panTo([53.00, 9.00]);
}


function incidentCircleClick(e) {
    var clickedCircle = e.target;
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
	var image = 'circular-shape-red64.png';

	if(total_dead_and_missing == 0){
		icon_size = [0, 0];
	}else if(total_dead_and_missing > 0 && total_dead_and_missing < 100){
		icon_size = [9, 9];
	}else if(total_dead_and_missing >= 100 && total_dead_and_missing < 200){
		icon_size = [15, 15];
	}else if(total_dead_and_missing >= 200 && total_dead_and_missing < 300){
		icon_size = [22, 22];
	}else if(total_dead_and_missing >= 300 && total_dead_and_missing < 400){
		icon_size = [30, 30];
	}else if(total_dead_and_missing >= 400 && total_dead_and_missing < 500){
		icon_size = [43, 43];
	}else{
		icon_size = [60, 60];
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

	$('.legends-sidebar').hide();
	$('.toggle-sidebar-button').hide();

	$('#map_container').hide();
	$('#graph_container').show();
	
	$('.arrivals-layers').hide();
	$('.incidents-layers').hide();

	$('.year').hide();
	$('.country').hide();
	$('.month').hide();

	$('.arrivals-refresh').hide();
	$('.incidents-refresh').hide();
	$('.graph-refresh').hide();

	$('.year').val(2018);
	$('.country').val();
	$('.month').val();


	var url = base_url + '/incidents-graph-data';

	$.ajax({
       	type:'POST',
       	url:url,
       	success:function(data){
          	var incidents = JSON.parse(data);
          	
			showIncidentGraph(incidents.incidents);
			showRegionalIncidentGraph(incidents.regional_data);
       	}
    })


    var url = base_url + '/arrivals-graph-data';

	$.ajax({
       	type:'POST',
       	url:url,
       	success:function(data){
          	var arrivals = JSON.parse(data);
          	
			showArrivalsDestinationGraph(arrivals.countries, arrivals.arrivals);
			showOriginsDestinationGraph(arrivals.origin_countries, arrivals.origins);
			showRegionalArrivalsDestinationGraph(arrivals.regions, arrivals.region_arrivals);
       	}
    })



	$('.loader').hide();
}

function showIncidentGraph(incidents){
	Highcharts.chart('incidents-graph-container', {
	    chart: {
	        type: 'column',
	        height: 500
	    },
	    title: {
	        text: 'Year Wise Incident Number &amp; Its Cause'
	    },
	    xAxis: {
	        categories: ['2014', '2015', '2016', '2017', '2018']
	    },
	    yAxis: {
	        min: 0,
	        title: {
	            text: 'Total Number of Incidents'
	        }
	    },
	    tooltip: {
	        pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b> ({point.percentage:.0f}%)<br/>',
	        shared: true
	    },
	    plotOptions: {
	        column: {
	            stacking: 'percent'
	        }
	    },
	    series: incidents
	});

}

function showRegionalIncidentGraph(regional_data) {

	Highcharts.chart('regional-graph-container', {
	    chart: {
	        plotBackgroundColor: null,
	        plotBorderWidth: null,
	        plotShadow: false,
	        type: 'pie'
	    },
	    title: {
	        text: 'Number of Incidents in the Region'
	    },
	    tooltip: {
	        pointFormat: '{series.name}: <b>{point.y} : {point.percentage:.1f}%</b>'
	    },
	    accessibility: {
	        point: {
	            valueSuffix: '%'
	        }
	    },
	    plotOptions: {
	        pie: {
	            allowPointSelect: true,
	            cursor: 'pointer',
	            dataLabels: {
	                enabled: true,
	                format: '<b>{point.name}</b>: {point.y} : {point.percentage:.1f} %'
	            }
	        }
	    },
	    series: [{
	        name: 'Brands',
	        colorByPoint: true,
	        data: regional_data
	    }]
	});
}

function showArrivalsDestinationGraph(countries, data) {

	Highcharts.chart('arrival-graph-container', {
		chart: {
	        height: 600
	    },
	    title: {
	        text: 'Migration Destination By Country'
	    },

	    /*subtitle: {
	        text: 'Source: thesolarfoundation.com'
	    },*/

	    yAxis: {
	        title: {
	            text: 'Number of Migrants'
	        }
	    },
	    xAxis: {
	    	categories: countries,
	        title: {
	            text: 'Destination Countries'
	        }
	    },
	    legend: {
	        layout: 'vertical',
	        align: 'right',
	        verticalAlign: 'middle'
	    },

	    plotOptions: {
	        /*series: {
	            label: {
	                connectorAllowed: false
	            },
	            pointStart: 2010
	        }*/
	    },

	    series: data,

	    responsive: {
	        rules: [{
	            condition: {
	                maxWidth: 500
	            },
	            chartOptions: {
	                legend: {
	                    layout: 'horizontal',
	                    align: 'center',
	                    verticalAlign: 'bottom'
	                }
	            }
	        }]
	    }

	});// body...
}

function showOriginsDestinationGraph(countries, data) {

	Highcharts.chart('origin-graph-container', {
		chart: {
	        height: 600
	    },
	    title: {
	        text: 'Migration Origins'
	    },

	    /*subtitle: {
	        text: 'Source: thesolarfoundation.com'
	    },*/

	    yAxis: {
	        title: {
	            text: 'Number of Migrants'
	        }
	    },
	    xAxis: {
	    	categories: countries,
	        title: {
	            text: 'Origin Countries'
	        }
	    },
	    legend: {
	        layout: 'vertical',
	        align: 'right',
	        verticalAlign: 'middle'
	    },

	    plotOptions: {
	        /*series: {
	            label: {
	                connectorAllowed: false
	            },
	            pointStart: 2010
	        }*/
	    },

	    series: data,

	    responsive: {
	        rules: [{
	            condition: {
	                maxWidth: 500
	            },
	            chartOptions: {
	                legend: {
	                    layout: 'horizontal',
	                    align: 'center',
	                    verticalAlign: 'bottom'
	                }
	            }
	        }]
	    }

	});// body...
}

function showRegionalArrivalsDestinationGraph(countries, data) {

	Highcharts.chart('region-arrival-graph-container', {
		chart: {
	        height: 600
	    },
	    title: {
	        text: 'Migration Origin by Region'
	    },

	    /*subtitle: {
	        text: 'Source: thesolarfoundation.com'
	    },*/

	    yAxis: {
	        title: {
	            text: 'Number of Migrants'
	        }
	    },
	    xAxis: {
	    	categories: countries,
	        title: {
	            text: 'Regions'
	        }
	    },
	    legend: {
	        layout: 'vertical',
	        align: 'right',
	        verticalAlign: 'middle'
	    },

	    plotOptions: {
	        /*series: {
	            label: {
	                connectorAllowed: false
	            },
	            pointStart: 2010
	        }*/
	    },

	    series: data,

	    responsive: {
	        rules: [{
	            condition: {
	                maxWidth: 500
	            },
	            chartOptions: {
	                legend: {
	                    layout: 'horizontal',
	                    align: 'center',
	                    verticalAlign: 'bottom'
	                }
	            }
	        }]
	    }

	});// body...
}

