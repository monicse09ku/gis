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
            $arrivals_data = Arrival::with('countryTo', 'countryFrom')->where([
                ['year', '=', $request->year]
            ])->get();


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
        }

        return json_encode(['status' => 'Success', 'arrivals' => $arrivals]);
    }

    public function arrivalsGraphData(Request $request)
    {
        $raw_countries = DB::select( DB::raw("SELECT DISTINCT(countries.name) as country FROM `arrivals` INNER JOIN countries ON arrivals.country_id = countries.id order by year") );
        $countries = [];
        foreach ($raw_countries as $raw_country) {
            array_push($countries, $raw_country->country);
        }

        $raw_arrivals = DB::select( DB::raw("SELECT year, SUM(value) as total, country_id, countries.name as country FROM `arrivals` INNER JOIN countries ON arrivals.country_id = countries.id GROUP BY year, country_id, countries.name order by year") );

        $processed_arrivals = [];
        foreach ($raw_arrivals as $raw_arrival) {
            $processed_arrivals[$raw_arrival->year][$raw_arrival->country][] = $raw_arrival->total;
        }

        $arrivals = [];
        
        foreach ($processed_arrivals as $key => $value) {
            array_push($arrivals, ['name' => $key, 'data' => $this->getGraphData($value, $countries)]);
        }


        


        $raw_origin_countries = DB::select( DB::raw("SELECT DISTINCT(countries.name) as country FROM `arrivals` INNER JOIN countries ON arrivals.country_from_id = countries.id order by year") );
        $origin_countries = [];
        foreach ($raw_origin_countries as $raw_origin_country) {
            array_push($origin_countries, $raw_origin_country->country);
        }

        $raw_origins = DB::select( DB::raw("SELECT year, SUM(value) as total, country_from_id, countries.name as country FROM `arrivals` INNER JOIN countries ON arrivals.country_from_id = countries.id GROUP BY year, country_from_id, countries.name order by year") );

        $processed_origins = [];
        foreach ($raw_origins as $raw_origin) {
            $processed_origins[$raw_origin->year][$raw_origin->country][] = $raw_origin->total;
        }

        $origins = [];
        
        foreach ($processed_origins as $key => $value) {
            array_push($origins, ['name' => $key, 'data' => $this->getGraphData($value, $countries)]);
        }





        $regions = [];
        $raw_regions = DB::select( DB::raw("SELECT DISTINCT(region) FROM `arrivals` order by year") );
        
        foreach ($raw_regions as $raw_region) {
            array_push($regions, $raw_region->region);
        }
        
        $raw_region_arrivals = DB::select( DB::raw("SELECT year, SUM(value) as total, region FROM `arrivals` GROUP BY year, region order by year") );

        $processed_region_arrivals = [];
        foreach ($raw_region_arrivals as $raw_region_arrival) {
            $processed_region_arrivals[$raw_region_arrival->year][$raw_region_arrival->region][] = $raw_region_arrival->total;
        }

        $region_arrivals = [];
        
        foreach ($processed_region_arrivals as $key => $value) {
            array_push($region_arrivals, ['name' => $key, 'data' => $this->getRegionArrivalGraphData($value, $regions)]);
        }
        
        return json_encode([
            'status' => 'Success', 
            'countries' => $countries, 
            'arrivals' => $arrivals,
            'regions' => $regions, 
            'region_arrivals' => $region_arrivals,
            'origin_countries' => $origin_countries, 
            'origins' => $origins,
        ]);
    }

    public function getGraphData($value, $countries)
    {
        $return = [];
        foreach ($countries as $country) {
            array_push($return, !empty($value[$country][0]) ? intval($value[$country][0]) : 0);
        }

        return $return;
    }

    public function getRegionArrivalGraphData($value, $regions)
    {
        $return = [];
        foreach ($regions as $region) {
            array_push($return, !empty($value[$region][0]) ? intval($value[$region][0]) : 0);
        }

        return $return;
    }
}
