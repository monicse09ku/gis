<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Arrival;
use App\Models\Country;
use DB;

class ArrivalController extends Controller
{
    public function getArrivals(Request $request)
    {
    	if (!empty($request->year)) {
    		$year = $request->year;
    	}else{
    		$year = 2018;
    	}

    	$arrivals_data = Arrival::with('countryTo', 'countryFrom')->where('year', $year)->get();
        
		$arrivals = [];
    	
    	foreach ($arrivals_data as $arrival_data) {
            if(array_key_exists($arrival_data->countryTo->name, $arrivals)){
    			$arrivals[$arrival_data->countryTo->name]['total_arrival'] = $arrivals[$arrival_data->countryTo->name]['total_arrival'] + $arrival_data->value;
    			$arrivals[$arrival_data->countryTo->name]['latitude'] = $arrival_data->countryTo->lat;
    			$arrivals[$arrival_data->countryTo->name]['longitude'] = $arrival_data->countryTo->lon;
    			$arrivals[$arrival_data->countryTo->name]['country'] = $arrival_data->countryTo->name;
    		}else{
    			$arrivals[$arrival_data->countryTo->name]['total_arrival'] = $arrival_data->value;
    			$arrivals[$arrival_data->countryTo->name]['latitude'] = $arrival_data->countryTo->lat;
    			$arrivals[$arrival_data->countryTo->name]['longitude'] = $arrival_data->countryTo->lon;
    			$arrivals[$arrival_data->countryTo->name]['country'] = $arrival_data->countryTo->name;
    		}

    		if(array_key_exists($arrival_data->countryFrom->name, $arrivals)){
    			$arrivals[$arrival_data->countryFrom->name]['total_arrival'] = $arrivals[$arrival_data->countryFrom->name]['total_arrival'] - $arrival_data->value;
    			$arrivals[$arrival_data->countryFrom->name]['latitude'] = $arrival_data->countryFrom->lat;
    			$arrivals[$arrival_data->countryFrom->name]['longitude'] = $arrival_data->countryFrom->lon;
    			$arrivals[$arrival_data->countryFrom->name]['country'] = $arrival_data->countryFrom->name;
    		}else{
    			$arrivals[$arrival_data->countryFrom->name]['total_arrival'] = (-1 * $arrival_data->value);
    			$arrivals[$arrival_data->countryFrom->name]['latitude'] = $arrival_data->countryFrom->lat;
    			$arrivals[$arrival_data->countryFrom->name]['longitude'] = $arrival_data->countryFrom->lon;
    			$arrivals[$arrival_data->countryFrom->name]['country'] = $arrival_data->countryFrom->name;
    		}
    		
    	}

    	return json_encode(['status' => 'Success', 'arrivals' => $arrivals]);
    }

    public function getSingleArrival(Request $request)
    {
        if($request->total_arrival > 0){
            $arrivals = Arrival::with('countryTo', 'countryFrom')->whereHas('countryTo', function($q) use($request) {
                $q->where('name', '=', $request->country);
            })->where('year', $request->year)->get();
        }else{
            $arrivals = Arrival::with('countryTo', 'countryFrom')->whereHas('countryFrom', function($q) use($request) {
                $q->where('name', '=', $request->country);
            })->where('year', $request->year)->get();
        }

        return json_encode(['status' => 'Success', 'arrivals' => $arrivals]);
    }

    public function refreshArrival(Request $request)
    {
        if(!empty($request->country)){
            $arrivals = Arrival::with('countryTo', 'countryFrom')->whereHas('countryTo', function($q) use($request) {
                $q->where('name', '=', $request->country);
            })->where('year', $request->year)->get();
        }else{
            $arrivals = Arrival::with('countryTo', 'countryFrom')->where([
                ['year', '=', $request->year]
            ])->get();
        }

        return json_encode(['status' => 'Success', 'arrivals' => $arrivals]);
    }
}
