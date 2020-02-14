@extends('layouts.master')

@section('title', 'GIS')


@section('content')

@include('modals.incident-details')

@include('layouts.partials.sidebar')
<div class="col-md-9" style="float: left;">
	<nav class="navbar navbar-expand-md">
	    <a href="#" class="navbar-brand btn-secondary tab-menu btn" onclick="showArrivals()">Arrivals</a>
	    <a href="#" class="navbar-brand btn-secondary tab-menu btn btn-large" onclick="showIncidents()">Incident</a>
	    <a href="#" class="navbar-brand btn-secondary tab-menu btn btn-large" onclick="showGraphs()">Graphs</a>
	    
	</nav>

	<div class="loader"></div>
	
	<div id="map_container">
		<div id="mapid"></div>
	</div>
	
</div>
@endsection

@section('script')

<script type="text/javascript">
	
</script>
@endsection