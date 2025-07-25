<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Traits\ApiResponse;

class ApiResponseServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(ApiResponse::class);
    }
}
