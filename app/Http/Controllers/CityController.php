<?php

namespace App\Http\Controllers;

use App\Services\CityService;
use Illuminate\Http\JsonResponse;

class CityController extends Controller
{
    /**
     * @param CityService $cityService
     */
    public function __construct(
        protected CityService $cityService
    )
    {
    }

    /**
     * @return JsonResponse
     */
    public function getAllCities(): JsonResponse
    {
        $cities = $this->cityService->getAllCities();
        return new JsonResponse($cities, 200);
    }
}
