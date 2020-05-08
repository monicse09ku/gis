<div class="card-body">
  <!-- Horizontal Form -->
  <div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">Incident Form</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <form v-on:submit.prevent class="form-horizontal">
      <div class="box-body">
        <div class="col-md-3 col-sm-12">
          <label for="inputEmail3" class="control-label">Region</label>
          <select v-model="incident.region" class="form-control" >
            <option disabled value="">Please select one</option>
            <option value="Europe">Europe</option>
            <option value="Mediterranean">Mediterranean</option>
          </select>
        </div>
        <div class="col-md-3 col-sm-12">
          <label for="inputEmail3" class="control-label">Year</label>
          <select v-model="incident.year" class="form-control" >
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
          <label for="inputEmail3" class="control-label">Month</label>
          <select v-model="incident.month" class="form-control" >
            <option disabled value="">Please select one</option>
            <option value="Jan">Jan</option>
            <option value="Feb">Feb</option>
            <option value="Mar">Mar</option>
            <option value="Apr">Apr</option>
            <option value="May">May</option>
            <option value="Jun">Jun</option>
            <option value="Jul">Jul</option>
            <option value="Aug">Aug</option>
            <option value="Sep">Sep</option>
            <option value="Oct">Oct</option>
            <option value="Nov">Nov</option>
            <option value="Dec">Dec</option>
          </select>
        </div>
        <div class="col-md-3 col-sm-12">
          <label for="inputPassword3" class="control-label">Number of Death</label>
          <input type="text" v-model="incident.number_of_death" class="form-control"> 
        </div>
        <div class="col-md-3 col-sm-12">
          <label for="inputPassword3" class="control-label">Min. Est. No. of Missing</label>
          <input type="text" v-model="incident.minimum_estimated_number_of_missing" class="form-control"> 
        </div>
        <div class="col-md-3 col-sm-12">
          <label for="inputPassword3" class="control-label">Total Dead &amp; Missing</label>
          <input type="text" v-model="incident.total_dead_and_missing" class="form-control"> 
        </div>
        <div class="col-md-3 col-sm-12">
          <label for="inputPassword3" class="control-label">Number of Survivors</label>
          <input type="text" v-model="incident.number_of_survivors" class="form-control"> 
        </div>
        <div class="col-md-3 col-sm-12">
          <label for="inputPassword3" class="control-label">Cause of Death</label>
          <select v-model="incident.cause_of_death" class="form-control" >
            <option disabled value="">Please select one</option>
            <option value="Hypothermia">Hypothermia</option>
            <option value="Accident">Accident</option>
            <option value="Drowning">Drowning</option>
            <option value="Starvation">Starvation</option>
            <option value="Suffocation">Suffocation</option>
            <option value="Unknown">Unknown</option>
            <option value="Burned">Burned</option>
          </select> 
        </div>
        <div class="col-md-6 col-sm-12">
          <label for="inputPassword3" class="control-label">Location Description</label>
          <input type="text" v-model="incident.location_description" class="form-control"> 
        </div>
        <div class="col-md-3 col-sm-12">
          <label for="inputPassword3" class="control-label">Latitude</label>
          <input type="text" v-model="incident.latitude" class="form-control"> 
        </div>
        <div class="col-md-3 col-sm-12">
          <label for="inputPassword3" class="control-label">Longitude</label>
          <input type="text" v-model="incident.longitude" class="form-control"> 
        </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <button @click="closeIncidentForm()" type="submit" class="btn btn-default pull-right">Cancel</button>
        <button type="submit" style="margin-right: 10px" class="btn btn-info pull-right" @click="saveIncident()">Save Incident</button>
      </div>
    </form>
  </div>
  <!-- /.box -->
  
</div>