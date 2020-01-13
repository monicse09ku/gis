@extends('layouts.master')

@section('title', 'GIS')


@section('content')
<div class="col-md-9" style="float: left;">
	<nav class="navbar navbar-expand-md">
	    <a href="#" class="navbar-brand btn-secondary tab-menu btn" onclick="showCTDCGlobalDataset()">CTDC GLOBAL DATASET</a>
	    <a href="#" class="navbar-brand btn-secondary tab-menu btn btn-large" onclick="showCTDCGlobalCorridor()">CTDC GLOBAL CORRIDOR</a>
	    <a href="#" class="navbar-brand btn-secondary tab-menu btn btn-large">CTDC IOM DATASET</a>
	    <a href="#" class="navbar-brand btn-secondary tab-menu btn btn-large">US STATES</a>
	    
	    </div>
	</nav>

	<!-- <div class="loader"></div> -->

	<div id="map"></div>

	<div id="regions_div_container">
		<div id="regions_div"></div>
	</div>
	
</div>
@endsection

@section('script')

<script type="text/javascript">
	
</script>
@endsection