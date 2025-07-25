<?php

use Illuminate\Support\Facades\Route;

Route::middleware('api')
    ->prefix('auth')
    ->group(base_path('routes/api/auth.php'));

Route::middleware('api')
    ->prefix('cities')
    ->group(base_path('routes/api/cities.php'));

Route::middleware('api')
    ->prefix('customers')
    ->group(base_path('routes/api/customers.php'));

Route::middleware('api')
    ->prefix('contacts')
    ->group(base_path('routes/api/contacts.php'));

Route::middleware('api')
    ->prefix('customerRequest')
    ->group(base_path('routes/api/customerRequest.php'));



