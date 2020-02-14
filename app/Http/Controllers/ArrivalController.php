<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Arrival;

class ArrivalController extends Controller
{
    public function getArrivals(Request $request)
    {
    	if (!empty($request->year)) {
    		$year = $request->year;
    	}else{
    		$year = 2018;
    	}

    	$arrivals_data = Arrival::where('year', $year)->get();
		
		$arrivals = [];
    	
    	foreach ($arrivals_data as $arrival_data) {
    		if(array_key_exists($arrival_data->country, $arrivals)){
    			$arrivals[$arrival_data->country]['total_arrival'] = $arrivals[$arrival_data->country]['total_arrival'] + $arrival_data->value;
    			$arrivals[$arrival_data->country]['latitude'] = $arrival_data->latitude;
    			$arrivals[$arrival_data->country]['longitude'] = $arrival_data->longitude;
    			$arrivals[$arrival_data->country]['country'] = $arrival_data->country;
    		}else{
    			$arrivals[$arrival_data->country]['total_arrival'] = $arrival_data->value;
    			$arrivals[$arrival_data->country]['latitude'] = $arrival_data->latitude;
    			$arrivals[$arrival_data->country]['longitude'] = $arrival_data->longitude;
    			$arrivals[$arrival_data->country]['country'] = $arrival_data->country;
    		}

    		if(array_key_exists($arrival_data->country_from, $arrivals)){
    			$arrivals[$arrival_data->country_from]['total_arrival'] = $arrivals[$arrival_data->country_from]['total_arrival'] - $arrival_data->value;
    			$arrivals[$arrival_data->country_from]['latitude'] = $arrival_data->country_from_latitude;
    			$arrivals[$arrival_data->country_from]['longitude'] = $arrival_data->country_from_longitude;
    			$arrivals[$arrival_data->country_from]['country'] = $arrival_data->country_from;
    		}else{
    			$arrivals[$arrival_data->country_from]['total_arrival'] = (-1 * $arrival_data->value);
    			$arrivals[$arrival_data->country_from]['latitude'] = $arrival_data->country_from_latitude;
    			$arrivals[$arrival_data->country_from]['longitude'] = $arrival_data->country_from_longitude;
    			$arrivals[$arrival_data->country_from]['country'] = $arrival_data->country_from;
    		}
    		
    	}

    	return json_encode(['status' => 'Success', 'arrivals' => $arrivals]);
    }

    public function getSingleArrival(Request $request)
    {
        if($request->total_arrival > 0){
            $arrivals = Arrival::where([
                ['country', '=', $request->country],
                ['year', '=', $request->year]
            ])->get();
        }else{
            $arrivals = Arrival::where([
                ['country_from', '=', $request->country],
                ['year', '=', $request->year]
            ])->get();
        }

        return json_encode(['status' => 'Success', 'arrivals' => $arrivals]);
    }
}
