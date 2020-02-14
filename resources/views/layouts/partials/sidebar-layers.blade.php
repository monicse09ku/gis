<div id="ctdc-dataset-layers-layers">
	<h4>Layers</h4>
	
	<select class="form-control year" style="margin-bottom: 20px">
		<option>Select Year</option>
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

	<select class="form-control country">
		<option>Select Country</option>
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

	<h4 class="incidents-layers">LEGENDS</h4>
	<div class="incidents-layers">
		<div class="col-md-12">
			<img src="{{ url('/images/2.png') }}" height="50" width="50">0 - 99 VICTIMS
		</div>
		<div class="col-md-12">
			<img src="{{ url('/images/3.png') }}" height="50" width="50">100 - 199 VICTIMS
		</div>
		<div class="col-md-12">
			<img src="{{ url('/images/4.png') }}" height="50" width="50">200 - 299 VICTIMS
		</div>
		<div class="col-md-12">
			<img src="{{ url('/images/5.png') }}" height="50" width="50">300 - 399 VICTIMS
		</div>
		<div class="col-md-12">
			<img src="{{ url('/images/6.png') }}" height="50" width="50">400 - 499 VICTIMS
		</div>
		<div class="col-md-12">
			<img src="{{ url('/images/7.png') }}" height="50" width="50"> > 500 VICTIMS
		</div>
	</div>

	<div class="arrivals-layers">
		<p style="font-weight: bold;">Migration Destination Country</p>
		<div class="row" style="margin-top:5px">
			<div class="col-md-2" style="float: left; text-align: center">
				<img src="{{ asset('/images/circular-shape-green64.png') }}" height="5" width="5">
			</div> 
			<div class="col-md-10" style="float: left;">0-999</div>
		</div>
		<div class="row" style="margin-top:5px">
			<div class="col-md-2" style="float: left; text-align: center">
				<img src="{{ asset('/images/circular-shape-green64.png') }}" height="9" width="9">
			</div> 
			<div class="col-md-10" style="float: left;">1000-1999</div>
		</div>
		<div class="row" style="margin-top:5px">
			<div class="col-md-2" style="float: left; text-align: center">
				<img src="{{ asset('/images/circular-shape-green64.png') }}" height="13" width="13">
			</div> 
			<div class="col-md-10" style="float: left;">2000-3999</div>
		</div>
		<div class="row" style="margin-top:5px">
			<div class="col-md-2" style="float: left; text-align: center">
				<img src="{{ asset('/images/circular-shape-green64.png') }}" height="17" width="17">
			</div> 
			<div class="col-md-10" style="float: left;">4000-7999</div>
		</div>
		<div class="row" style="margin-top:5px">
			<div class="col-md-2" style="float: left; text-align: center">
				<img src="{{ asset('/images/circular-shape-green64.png') }}" height="21" width="21">
			</div> 
			<div class="col-md-10" style="float: left;">8000-11999</div>
		</div>
		<div class="row" style="margin-top:5px">
			<div class="col-md-2" style="float: left; text-align: center">
				<img src="{{ asset('/images/circular-shape-green64.png') }}" height="25" width="25">
			</div> 
			<div class="col-md-10" style="float: left;">12000-15000</div>
		</div>
		<div class="row" style="margin-top:5px">
			<div class="col-md-2" style="float: left; text-align: center">
				<img src="{{ asset('/images/circular-shape-green64.png') }}" height="30" width="30">
			</div> 
			<div class="col-md-10" style="float: left;">>15000</div>
		</div>

		<p style="font-weight: bold;margin-top: 20px">Migration Origin Country</p>
		<div class="row" style="margin-top:5px">
			<div class="col-md-2" style="float: left; text-align: center">
				<img src="{{ asset('/images/circular-shape-blue64.png') }}" height="5" width="5">
			</div> 
			<div class="col-md-10" style="float: left;">0-999</div>
		</div>
		<div class="row" style="margin-top:5px">
			<div class="col-md-2" style="float: left; text-align: center">
				<img src="{{ asset('/images/circular-shape-blue64.png') }}" height="9" width="9">
			</div> 
			<div class="col-md-10" style="float: left;">1000-1999</div>
		</div>
		<div class="row" style="margin-top:5px">
			<div class="col-md-2" style="float: left; text-align: center">
				<img src="{{ asset('/images/circular-shape-blue64.png') }}" height="13" width="13">
			</div> 
			<div class="col-md-10" style="float: left;">2000-3999</div>
		</div>
		<div class="row" style="margin-top:5px">
			<div class="col-md-2" style="float: left; text-align: center">
				<img src="{{ asset('/images/circular-shape-blue64.png') }}" height="17" width="17">
			</div> 
			<div class="col-md-10" style="float: left;">4000-7999</div>
		</div>
		<div class="row" style="margin-top:5px">
			<div class="col-md-2" style="float: left; text-align: center">
				<img src="{{ asset('/images/circular-shape-blue64.png') }}" height="21" width="21">
			</div> 
			<div class="col-md-10" style="float: left;">8000-11999</div>
		</div>
		<div class="row" style="margin-top:5px">
			<div class="col-md-2" style="float: left; text-align: center">
				<img src="{{ asset('/images/circular-shape-blue64.png') }}" height="25" width="25">
			</div> 
			<div class="col-md-10" style="float: left;">12000-15000</div>
		</div>
		<div class="row" style="margin-top:5px">
			<div class="col-md-2" style="float: left; text-align: center">
				<img src="{{ asset('/images/circular-shape-blue64.png') }}" height="30" width="30">
			</div> 
			<div class="col-md-10" style="float: left;">>15000</div>
		</div>
	</div>
</div>