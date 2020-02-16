@extends('layouts.master')

@section('title', 'GIS')

@section('content')

@include('modals.incident-details')

@include('layouts.partials.sidebar')
<div class="col-md-9" style="float: left;">
	<div class="col-md-6" style="float: left;">
		<nav class="navbar navbar-expand-md">
		    <a href="#" class="navbar-brand btn-secondary tab-menu btn" onclick="showArrivals()">Arrivals</a>
		    <a href="#" class="navbar-brand btn-secondary tab-menu btn btn-large" onclick="showIncidents()">Incident</a>
		    <a href="#" class="navbar-brand btn-secondary tab-menu btn btn-large" onclick="showGraphs()">Graphs</a>
		    <a href="#" class="navbar-brand tab-menu" style="padding: 0;">
		    	<select class="form-control year" style="width: 150px">
					<option value="">Select Year</option>
					<option value="2019">2019</option>
					<option value="2018">2018</option>
					<option value="2017">2017</option>
					<option value="2016">2016</option>
					<option value="2015">2015</option>
					<option value="2014">2014</option>
					<option value="2013">2013</option>
					<option value="2012">2012</option>
					<option value="2011">2011</option>
					<option value="2010">2010</option>
					<option value="2009">2009</option>
				</select>
		    </a>
		    <a href="#" class="navbar-brand tab-menu" style="padding: 0;">
		    	<select class="form-control month" style="width: 150px">
					<option value="">Select Month</option>
					<option value="Jan">January</option>
					<option value="Feb">February</option>
					<option value="Mar">March</option>
					<option value="Apr">April</option>
					<option value="May">May</option>
					<option value="Jun">June</option>
					<option value="Jul">July</option>
					<option value="Aug">August</option>
					<option value="Sep">September</option>
					<option value="Oct">October</option>
					<option value="Nov">November</option>
					<option value="Dec">December</option>
				</select>
		    </a>
		    <a href="#" class="navbar-brand tab-menu" style="padding: 0;">
		    	<select class="form-control country" style="width: 150px">
					<option value="">Select Country</option>
					<option value="Australia">Australia</option>
					<option value="Belgium">Belgium</option>
					<option value="Bulgaria">Bulgaria</option>
					<option value="Croatia">Croatia</option>
					<option value="Cyprus">Cyprus</option>
					<option value="Czech Rep.">Czech Rep.</option>
					<option value="Denmark">Denmark</option>
					<option value="Estonia">Estonia</option>
					<option value="Finland">Finland</option>
					<option value="France">France</option>
					<option value="Germany">Germany</option>
					<option value="Greece">Greece</option>
					<option value="Hungary">Hungary</option>
					<option value="Ireland">Ireland</option>
					<option value="Italy">Italy</option>
					<option value="Luxembourg">Luxembourg</option>
					<option value="Malta">Malta</option>
					<option value="Netherlands">Netherlands</option>
					<option value="Norway">Norway</option>
					<option value="Poland">Poland</option>
					<option value="Portugal">Portugal</option>
					<option value="Romania">Romania</option>
					<option value="Slovakia">Slovakia</option>
					<option value="Spain">Spain</option>
					<option value="Sweden">Sweden</option>
					<option value="Switzerland">Switzerland</option>
					<option value="United Kingdom">United Kingdom</option>
				</select>
		    </a>
		    <a href="#" class="navbar-brand tab-menu" style="padding: 0; margin-right: 0">
		    	<a href="#" class="btn btn-info btn-lg arrivals-refresh" onclick="refreshArrivals()">
		          	<i class="fas fa-sync-alt"></i>
		        </a>
		        <a href="#" class="btn btn-primary btn-lg incidents-refresh" onclick="refreshIncidents()">
		          	<i class="fas fa-sync-alt"></i>
		        </a>
		        <a href="#" class="btn btn-success btn-lg graph-refresh">
		          	<i class="fas fa-sync-alt"></i>
		        </a>
		    </a>
		</nav>
	</div>

	<div class="loader"></div>
	
	<div id="map_container">
		<div id="mapid"></div>
	</div>

	<div id="graph_container" style="float: left;width: 100%;">
		<div id="incidents-graph-container" style="float: left;width: 70%"></div>
		<div id="regional-graph-container" style="float: left;width: 30%"></div>
	</div>
	
</div>
@endsection

@section('script')

<script type="text/javascript">
	
</script>
@endsection