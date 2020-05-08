@extends('layouts.admin')

@section('title', 'Arrival')

@section('content')
<arrival-component inline-template>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card">
                  <button v-if="!showArrivalForm" type="button" class="btn btn-primary pull-right" @click="toggoleArrivalForm()">
                    Add Arrival
                  </button>

                  <div v-if="showArrivalForm">

                    @include('arrival.form')
                  </div>

                    <h1 class="card-header">Arrival</h1>

                    <div class="card-body">

                        <div class="box">
                        <div class="box-header">
                          <h3 class="box-title">Arrival Table</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body no-padding">
                          <table class="table table-striped">
                            <tr>
                              <th>Country To</th>
                              <th>Country From</th>
                              <th>Year</th>
                              <th>Total</th>
                              <th>Region</th>
                              <th>Value</th>
                              <th>Percentage</th>
                              <th style="width: 120px">Actions</th>
                            </tr>
                            <tr v-for="arrival in arrivals">
                              <td v-text="arrival.country_from.name"></td>
                              <td v-text="arrival.country_to.name"></td>
                              <td v-text="arrival.year"></td>
                              <td v-text="arrival.total"></td>
                              <td v-text="arrival.region"></td>
                              <td v-text="arrival.value"></td>
                              <td v-text="arrival.percentage"></td>
                              <td>
                                <button style="margin-bottom: 5px" @click="EditArrival(arrival)" class="btn btn-warning"><i class="fa fa-edit"></i></button>
                                <button style="margin-bottom: 5px" @click="deleteArrival(arrival.id)" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                              </td>
                            </tr>

                          </table>
                        </div>
                            <div v-if="pagination.total>0" class="box-footer">
                                <pagination :data="pagination" :limit="10" @pagination-change-page="fetchArrivals"></pagination>
                            </div>

                            <p style="padding: 5px; font-weight: bold;">Showing <span v-text="this.pagination.to"></span> data of Total <span v-text="this.pagination.total"></span></p>
                        <!-- /.box-body -->
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</arrival-component>



@endsection
