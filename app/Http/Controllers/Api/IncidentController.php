<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Api\IncidentResource;
use App\Models\Incident;

class IncidentController extends ApiBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return IncidentResource::collection(Incident::orderBy('id', 'DESC')->paginate(request('limit') ?? 15));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'region' => 'required',
            'year' => 'required',
            'month' => 'required',
            'number_of_death' => 'required',
            'minimum_estimated_number_of_missing' => 'required',
            'total_dead_and_missing' => 'required',
            'number_of_survivors' => 'required',
            'cause_of_death' => 'required',
            'location_description' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->respondValidationError('Parameters failed validation');
        }

        try{
            Incident::create([
                'region' => $request->region,
                'year' => $request->year,
                'month' => $request->month,
                'number_of_death' => $request->number_of_death,
                'minimum_estimated_number_of_missing' => $request->minimum_estimated_number_of_missing,
                'total_dead_and_missing' => $request->total_dead_and_missing,
                'number_of_survivors' => $request->number_of_survivors,
                'cause_of_death' => $request->cause_of_death,
                'location_description' => $request->location_description,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
            ]);
            return $this->respondSuccess('SUCCESS');
        }catch(Exception $e){
            return $this->respondInternalError($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = \Validator::make($request->all(), [
            'region' => 'required',
            'year' => 'required',
            'month' => 'required',
            'number_of_death' => 'required',
            'minimum_estimated_number_of_missing' => 'required',
            'total_dead_and_missing' => 'required',
            'number_of_survivors' => 'required',
            'cause_of_death' => 'required',
            'location_description' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->respondValidationError('Parameters failed validation');
        }

        try{
            Incident::where('id', $id)->update([
                'region' => $request->region,
                'year' => $request->year,
                'month' => $request->month,
                'number_of_death' => $request->number_of_death,
                'minimum_estimated_number_of_missing' => $request->minimum_estimated_number_of_missing,
                'total_dead_and_missing' => $request->total_dead_and_missing,
                'number_of_survivors' => $request->number_of_survivors,
                'cause_of_death' => $request->cause_of_death,
                'location_description' => $request->location_description,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
            ]);
            return $this->respondSuccess('SUCCESS');
        }catch(Exception $e){
            return $this->respondInternalError($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            if (Incident::findOrFail($id)->delete()) {
                return $this->respondSuccess('DELETE_SUCCESS');
            }
        } catch (\Exception $e) {
            return $this->respondError($e->getMessage());
            return $this->respondError('DELETE_FAIL');
        }
    }
}
