<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Incident;

class IncidentController extends Controller
{
    public function getIncidents()
    {
    	$incidents = Incident::all();
    	return json_encode(['status' => 'Success', 'incidents' => $incidents]);
    }
}
