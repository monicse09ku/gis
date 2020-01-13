@extends('layouts.master')

@section('title', 'GIS')


@section('content')
@include('layouts.partials.sidebar')
<div class="col-md-9" style="float: left;">
	<nav class="navbar navbar-expand-md">
	    <a href="#" class="navbar-brand btn-secondary tab-menu btn" onclick="showCTDCGlobalDataset()">Arrivals</a>
	    <a href="#" class="navbar-brand btn-secondary tab-menu btn btn-large" onclick="showCTDCGlobalCorridor()">Incident</a>
	    <!-- <a href="#" class="navbar-brand btn-secondary tab-menu btn btn-large">CTDC IOM DATASET</a>
	    <a href="#" class="navbar-brand btn-secondary tab-menu btn btn-large">US STATES</a> -->
	    
	    
	</nav>

	<!-- <div class="loader"></div> -->

	<div id="mapid"></div>

	<div id="regions_div_container">
		<div id="regions_div"></div>
	</div>
	
</div>
@endsection

@section('script')

<script type="text/javascript">
	
</script>
@endsection