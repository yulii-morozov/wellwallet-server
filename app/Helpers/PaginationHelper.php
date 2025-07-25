<?php

declare(strict_types=1);

namespace App\Helpers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

class PaginationHelper
{
    /**
     * @param Builder $query
     * @param array $queryParams
     * @param int $pageSize
     * @return LengthAwarePaginator
     */
    public static function paginateAndFilter(Builder $query, array $queryParams = [], int $pageSize = 25): LengthAwarePaginator
    {
        $filteredQuery = self::applyFilters($query, $queryParams);
        $page = request()->input('page', 1);
        $perPage = request()->input('perPage', $pageSize);
        return $filteredQuery->paginate($perPage, ['*'], 'page', $page);
    }

    /**
     * @param Builder $query
     * @param array $queryParams
     * @return Builder
     */
    private static function applyFilters(Builder $query, array $queryParams = []): Builder
    {
        foreach ($queryParams as $field => $value) {
            if (
                $field !== 'page' &&
                $field !== 'perPage' &&
                $field !== 'sortField' &&
                $field !== 'sortOrder' &&
                $field !== 'authenticated_user'
            ) {
                $query->where($field, 'ILIKE', '%' . $value . '%');
            }
        }

        if (isset($queryParams['sortField']) && isset($queryParams['sortOrder'])) {
            $sortField = $queryParams['sortField'];
            $sortOrder = $queryParams['sortOrder'];
            $query->orderBy($sortField, $sortOrder);
        }

        return $query;
    }

    /**
     * @param $result
     * @param $data
     * @return array
     */
    public static function responseOfPaginateAndFilter($result, $data): array
    {
        return [
            'data' => $result,
            'pagination' => [
                'total' => $data->total(),
                'perPage' => $data->perPage(),
                'currentPage' => $data->currentPage(),
                'lastPage' => $data->lastPage(),
                'from' => $data->firstItem(),
                'to' => $data->lastItem(),
            ],
        ];
    }
}
