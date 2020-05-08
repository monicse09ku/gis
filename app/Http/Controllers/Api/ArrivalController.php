<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Api\ArrivalResource;
use App\Models\Arrival;


class ArrivalController extends ApiBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return ArrivalResource::collection(Arrival::with('countryTo', 'countryFrom')->orderBy('id', 'DESC')->paginate(request('limit') ?? 15));
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
            'country_id' => 'required',
            'country_from_id' => 'required',
            'year' => 'required',
            'total' => 'required',
            'region' => 'required',
            'value' => 'required',
            'percentage' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->respondValidationError('Parameters failed validation');
        }

        try{
            Arrival::create([
                'country_id' => $request->country_id,
                'country_from_id' => $request->country_from_id,
                'year' => $request->year,
                'total' => $request->total,
                'region' => $request->region,
                'value' => $request->value,
                'percentage' => $request->percentage,
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
            'country_id' => 'required',
            'country_from_id' => 'required',
            'year' => 'required',
            'total' => 'required',
            'region' => 'required',
            'value' => 'required',
            'percentage' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->respondValidationError('Parameters failed validation');
        }

        try{
            Arrival::where('id', $id)->update([
                'country_id' => $request->country_id,
                'country_from_id' => $request->country_from_id,
                'year' => $request->year,
                'total' => $request->total,
                'region' => $request->region,
                'value' => $request->value,
                'percentage' => $request->percentage,
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
            if (Arrival::findOrFail($id)->delete()) {
                return $this->respondSuccess('DELETE_SUCCESS');
            }
        } catch (\Exception $e) {
            return $this->respondError($e->getMessage());
            return $this->respondError('DELETE_FAIL');
        }
    }
}
