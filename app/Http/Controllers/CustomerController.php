<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetAllCustomersRequest;
use App\Services\CustomerService;
use Illuminate\Http\JsonResponse;

class CustomerController extends Controller
{
    /**
     * @param CustomerService $customerService
     */
    public function __construct(
        protected CustomerService $customerService)
    {
    }

    /**
     * @param GetAllCustomersRequest $request
     * @return JsonResponse
     */
    public function getAllCustomers(GetAllCustomersRequest $request): JsonResponse
    {
        $queryParam = $request->query();
        $pageSize = $request->input('pageSize', 25);

        $users = $this->customerService->allCustomers($queryParam, $pageSize);

        return new JsonResponse($users, 200);
    }
}
