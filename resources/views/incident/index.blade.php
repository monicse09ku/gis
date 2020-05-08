@extends('layouts.admin')

@section('title', 'Incidents')

@section('content')
<incident-component inline-template>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card">
                  <button v-if="!showIncidentForm" type="button" class="btn btn-primary pull-right" @click="toggoleIncidentForm()">
                    Add Incident
                  </button>

                  <div v-if="showIncidentForm">

                    @include('incident.form')
                  </div>

                    <h1 class="card-header">Incident</h1>

                    <div class="card-body">

                        <div class="box">
                        <div class="box-header">
                          <h3 class="box-title">Incident Table</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body no-padding">
                          <table class="table table-striped">
                            <tr>
                              <th>Region</th>
                              <th>Time</th>
                              <th>Number of Death</th>
                              <th>Min. Est. No. of Missing</th>
                              <th>Total Dead &amp; Missing</th>
                              <th>No. of Survivors</th>
                              <th>Cause of Death</th>
                              <th>Location Description</th>
                              <th style="width: 120px">Actions</th>
                            </tr>
                            <tr v-for="incident in incidents">
                              <td v-text="incident.region"></td>
                              <td>
                                <span v-text="incident.month"></span>, 
                                <span v-text="incident.year"></span>
                              </td>
                              <td v-text="incident.number_of_death"></td>
                              <td v-text="incident.minimum_estimated_number_of_missing"></td>
                              <td v-text="incident.total_dead_and_missing"></td>
                              <td v-text="incident.number_of_survivors"></td>
                              <td v-text="incident.cause_of_death"></td>
                              <td v-text="incident.location_description"></td>
                              <td>
                                <button style="margin-bottom: 5px" @click="EditIncident(incident)" class="btn btn-warning"><i class="fa fa-edit"></i></button>
                                <button style="margin-bottom: 5px" @click="deleteIncident(incident.id)" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                              </td>
                            </tr>

                          </table>
                        </div>
                            <div v-if="pagination.total>0" class="box-footer">
                                <pagination :data="pagination" :limit="10" @pagination-change-page="fetchIncidents"></pagination>
                            </div>

                            <p style="padding: 5px; font-weight: bold;">Showing <span v-text="this.pagination.to"></span> data of Total <span v-text="this.pagination.total"></span></p>
                        <!-- /.box-body -->
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</incident-component>



@endsection
