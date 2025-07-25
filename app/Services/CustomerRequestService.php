<?php

namespace App\Services;

use App\Mail\CustomerRequest as CustomerRequestMail;
use App\Models\CustomerRequest;
use App\Helpers\PaginationHelper;
use Illuminate\Support\Facades\Mail;

class CustomerRequestService
{
    /**
     * @param array|null $queryParam
     * @param int|null $pageSize
     * @return array
     */
    public function getAllCustomerRequests(?array $queryParam, ?int $pageSize): array
    {
        $query = CustomerRequest::with('customer');

        $requestsPaginateAndFilter = PaginationHelper::paginateAndFilter($query, $queryParam, $pageSize);

        $requestsData = $requestsPaginateAndFilter->items();

        return PaginationHelper::responseOfPaginateAndFilter($requestsData, $requestsPaginateAndFilter);
    }

    /**
     * @param CustomerRequest $customerRequest
     * @return CustomerRequest|null
     */
    public function findCustomerRequest(CustomerRequest $customerRequest): ?CustomerRequest
    {
        return $customerRequest->load(['customer']);
    }

    /**
     * @param array $data
     * @return CustomerRequest
     */
    public function createCustomerRequest(array $data): CustomerRequest
    {
        $data['user_id'] = auth('api')->id();
        $customerRequest = new CustomerRequest();
        $customerRequest->fill($data);
        $customerRequest->save();

        $customer = $customerRequest->customer()->with('contacts')->first();
        $emailContact = $customer?->contacts->firstWhere('type', 'email');

        if ($emailContact && $emailContact->value) {
            Mail::to("example@gmail.com")->send(new CustomerRequestMail($customerRequest, $customer));
        }

        return $customerRequest;
    }
}
