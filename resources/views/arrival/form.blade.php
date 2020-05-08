<div class="card-body">
  <!-- Horizontal Form -->
  <div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">Arrival Form</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <form v-on:submit.prevent class="form-horizontal">
      <div class="box-body">
        <div class="col-md-3 col-sm-12">
          <label for="inputEmail3" class="control-label">Country To</label>
          <select v-model="arrival.country_id" class="form-control" >
            <option disabled value="">Please select one</option>
            @foreach($countries as $country)
            <option value="{{$country->id}}">{{$country->name}}</option>
            @endforeach
          </select>
        </div>
        <div class="col-md-3 col-sm-12">
          <label for="inputEmail3" class="control-label">Country From</label>
          <select v-model="arrival.country_from_id" class="form-control" >
            <option disabled value="">Please select one</option>
            @foreach($countries as $country)
            <option value="{{$country->id}}">{{$country->name}}</option>
            @endforeach
          </select>
        </div>
        <div class="col-md-3 col-sm-12">
          <label for="inputEmail3" class="control-label">Year</label>
          <select v-model="arrival.year" class="form-control" >
            <option disabled value="">Please select one</option>
            <option value="2008">2008</option>
            <option value="2009">2009</option>
            <option value="2010">2010</option>
            <option value="2011">2011</option>
            <option value="2012">2012</option>
            <option value="2013">2013</option>
            <option value="2014">2014</option>
            <option value="2015">2015</option>
            <option value="2016">2016</option>
            <option value="2017">2017</option>
            <option value="2018">2018</option>
            <option value="2019">2019</option>
            <option value="2020">2020</option>
          </select>
        </div>
        <div class="col-md-3 col-sm-12">
          <label for="inputEmail3" class="control-label">Region</label>
          <select v-model="arrival.region" class="form-control" >
            <option disabled value="">Please select one</option>
            <option value="Caribbean">Caribbean</option>
            <option value="Central America">Central America</option>
            <option value="Central Asia">Central Asia</option>
            <option value="Eastern Africa">Eastern Africa</option>
            <option value="Eastern Asia">Eastern Asia</option>
            <option value="Eastern Europe">Eastern Europe</option>
            <option value="Middle Africa">Middle Africa</option>
            <option value="Northern Africa">Northern Africa</option>
            <option value="Northern America">Northern America</option>
            <option value="Oceania">Oceania</option>
            <option value="Other">Other</option>
            <option value="South America">South America</option>
            <option value="South-eastern Asia">South-eastern Asia</option>
            <option value="Southern Africa">Southern Africa</option>
            <option value="Southern Asia">Southern Asia</option>
            <option value="Southern Europe">Southern Europe</option>
            <option value="Western Africa">Western Africa</option>
            <option value="Western Asia">Western Asia</option>
            <option value="Western Europe">Western Europe</option>
          </select>
        </div>
        <div class="col-md-4 col-sm-12">
          <label for="inputPassword3" class="control-label">Total</label>
          <input type="text" v-model="arrival.total" class="form-control"> 
        </div>
        <div class="col-md-4 col-sm-12">
          <label for="inputPassword3" class="control-label">Value</label>
          <input type="text" v-model="arrival.value" class="form-control"> 
        </div>
        <div class="col-md-4 col-sm-12">
          <label for="inputPassword3" class="control-label">Percentage</label>
          <input type="text" v-model="arrival.percentage" class="form-control"> 
        </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <button @click="closeArrivalForm()" type="submit" class="btn btn-default pull-right">Cancel</button>
        <button type="submit" style="margin-right: 10px" class="btn btn-info pull-right" @click="saveArrival()">Save Arrival</button>
      </div>
    </form>
  </div>
  <!-- /.box -->
  
</div>