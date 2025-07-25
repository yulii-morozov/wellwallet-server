<?php

use App\Http\Controllers\CustomerRequestController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->group(function () {
    Route::get('/', [CustomerRequestController::class, 'getAllCustomerRequests'])->can('viewAny', App\Models\CustomerRequest::class);
    Route::post('/', [CustomerRequestController::class, 'createCustomerRequest'])->can('create', App\Models\CustomerRequest::class);
    Route::get('/{customerRequest}', [CustomerRequestController::class, 'getCustomerRequest'])->can('view', App\Models\CustomerRequest::class);
});