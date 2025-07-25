<?php

namespace App\Services;

use App\Helpers\PaginationHelper;
use App\Models\Customer;

class CustomerService
{
    /**
     * @param array|null $queryParams
     * @param int|null $pageSize
     * @return array
     */
    public function allCustomers(?array $queryParams, ?int $pageSize): array
    {
        $sortField = $queryParams['sortField'] ?? 'city';
        $sortOrder = $queryParams['sortOrder'] ?? 'asc';

        $query = Customer::query()
            ->with('city')
            ->join('cities', 'customers.city_id', '=', 'cities.id')
            ->select('customers.*', 'cities.city')
            ->addSelect([
                'contacts_count' => function ($subquery) {
                    $subquery->selectRaw('count(*)')
                        ->from('contacts')
                        ->whereColumn('contacts.contactable_id', 'customers.id')
                        ->where('contacts.contactable_type', '=', Customer::class);
                }
            ]);

        if ($sortField === 'city') {
            $query->orderBy('cities.city', $sortOrder);
        } elseif ($sortField === 'contacts') {
            $query->orderBy('contacts_count', $sortOrder);
        }

        $paginator = PaginationHelper::paginateAndFilter($query, [], $pageSize);
        return PaginationHelper::responseOfPaginateAndFilter($paginator->items(), $paginator);
    }
}
