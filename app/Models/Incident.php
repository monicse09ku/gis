<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Incident extends Model
{
    protected $fillable = ['region', 'year', 'month', 'number_of_death', 'minimum_estimated_number_of_missing', 'total_dead_and_missing', 'number_of_survivors', 'cause_of_death', 'location_description', 'latitude', 'longitude'];
}
