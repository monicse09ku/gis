<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Incident;

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
}
