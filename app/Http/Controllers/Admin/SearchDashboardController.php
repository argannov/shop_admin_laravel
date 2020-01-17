<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Search\SearchService;

class SearchDashboardController extends Controller
{
    /**
     * @param $text string
     * @param SearchService $service
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search($text, SearchService $service)
    {
        $results = $service->search($text);

        $total = 0;

        foreach ($results as $result) {
            isset($result['list']) && $total += count($result['list']);
        }

        return view('admin.search.index',
            [
                'text' => $text,
                'total' => $total,
                'results' => $results
            ]
        );
    }
}
