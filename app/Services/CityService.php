<?php

namespace App\Services;

use App\Models\City;
use Illuminate\Database\Eloquent\Collection;

class CityService
{
    /**
     * @return Collection
     */
    public function getAllCities(): Collection
    {
        return City::get();
    }
}
