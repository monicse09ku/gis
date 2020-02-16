<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Incident;
use DB;

class IncidentController extends Controller
{
    public function getIncidents(Request $request)
    {
    	if (!empty($request->year)) {
    		$year = $request->year;
    	}else{
    		$year = 2018;
    	}
    	$incidents = Incident::where('year', $year)->get();
    	return json_encode(['status' => 'Success', 'incidents' => $incidents]);
    }

    public function refreshIncidents(Request $request)
    {
        if (!empty($request->month)) {
            $incidents = Incident::where([
                ['month', '=', $request->month],
                ['year', '=', $request->year]
            ])->get();
        }else{
            $incidents = Incident::where([
                ['year', '=', $request->year]
            ])->get();
        }
        
        return json_encode(['status' => 'Success', 'incidents' => $incidents]);
    }

    public function incidentsGraphData(Request $request)
    {
        $results = DB::select( DB::raw("SELECT year, cause_of_death, SUM(number_of_death) AS Total FROM incidents GROUP BY year, cause_of_death ORDER BY year ASC") );
        $processed_results = [];
        foreach ($results as $result) {
            $processed_results[$result->cause_of_death][$result->year] = $result->Total;
        }
        
        $incidents = [];
        
        foreach ($processed_results as $key => $value) {
            array_push($incidents, ['name' => $key, 'data' => $this->getGraphData($value)]);
        }

        $regional_raw_data = DB::select(DB::raw("SELECT region, SUM(number_of_death) AS Total FROM `incidents` GROUP BY region"));

        $regional_data = [];
        
        foreach ($regional_raw_data as $key => $value) {
            array_push($regional_data, ['name' => $value->region, 'y' => intval($value->Total)]);
        }

        return json_encode(['status' => 'Success', 'incidents' => $incidents, 'regional_data' => $regional_data]);
    }

    public function getGraphData($value)
    {
        return [
            !empty($value[2014]) ? intval($value[2014]) : 0,
            !empty($value[2015]) ? intval($value[2015]) : 0,
            !empty($value[2016]) ? intval($value[2016]) : 0,
            !empty($value[2017]) ? intval($value[2017]) : 0,
            !empty($value[2018]) ? intval($value[2018]) : 0,
        ];
    }
}
