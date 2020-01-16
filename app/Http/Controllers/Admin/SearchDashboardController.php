<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Search\SearchService;

class SearchDashboardController extends Controller
{
    /**
     * @param $keywords string
     * @return array
     */
    public function search($keywords, SearchService $service) {
        $results = $service->search($keywords);

        $total = 0;

        foreach ($results as $result) {
            isset($result['list']) && $total += count($result['list']);
        }

        return view('admin.search.index',
            [
                'keywords' => $keywords,
                'total' => $total,
                'results' => $results
            ]
        );
    }
}
