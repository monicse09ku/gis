<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Arrival extends Model
{
    public function countryTo()
	{
		return $this->hasOne(Country::class, 'id', 'country_id');
	}

	public function countryFrom()
	{
		return $this->hasOne(Country::class, 'id', 'country_from_id');
	}
}
