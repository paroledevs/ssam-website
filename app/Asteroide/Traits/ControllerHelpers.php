<?php

namespace App\Asteroide\Traits;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Request;

trait ControllerHelpers
{
    public $itemsPerPage = 50;

    public function paginate($items, $perPage = 20)
    {
        if (isset($this->itemsPerPage) && $this->itemsPerPage > 0) {
            $perPage = $this->itemsPerPage;
        }

        $currentPage = LengthAwarePaginator::resolveCurrentPage();

        $currentItems = $items->slice($perPage * ($currentPage - 1), $perPage);

        $paginator = new LengthAwarePaginator($currentItems, $items->count(), $perPage, $currentPage);

        $paginator->setPath(Request::url());
        $paginator->appends(Request::query());

        return $paginator;
    }
}
