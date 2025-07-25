<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CustomerRequest;
use App\Services\CustomerRequestService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CustomerRequestController extends Controller
{
    /**
     * @param CustomerRequestService $customerRequestService
     */
    public function __construct(
        protected CustomerRequestService $customerRequestService
    )
    {
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getAllCustomerRequests(Request $request): JsonResponse
    {
        $queryParam = $request->query();

        $pageSize = $request->input('perPage', 25);

        $customerRequests = $this->customerRequestService->getAllCustomerRequests($queryParam, $pageSize);

        return new JsonResponse($customerRequests, 200);
    }

    /**
     * @param CustomerRequest $customerRequest
     * @return JsonResponse
     */
    public function getCustomerRequest(CustomerRequest $customerRequest): JsonResponse
    {
        $customerRequest = $this->customerRequestService->findCustomerRequest($customerRequest);
        return new JsonResponse($customerRequest, 200);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function createCustomerRequest(Request $request): JsonResponse
    {
        $data = $request->getContent();
        $content = json_decode($data, true);

        $item = $this->customerRequestService->createCustomerRequest($content);

        return new JsonResponse($item, 201);
    }
}
