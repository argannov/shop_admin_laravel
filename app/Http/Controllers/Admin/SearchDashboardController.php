<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Search\SearchService;

class SearchDashboardController extends Controller
{

    /** @var SearchService */
    private $service;

    public function __construct(SearchService $service)
    {
        $this->service = $service;
    }

    /**
     * @param $text string
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search($text)
    {
        return view('admin.search.index',
            [
                'text' => $text,
            ]
        );
    }

    /**
     * @param string $text
     * @return array
     */
    public function searchGoods($text) {
        return $this->service->searchGoods($text);
    }

    /**
     * @param string $text
     * @return array
     */
    public function searchOrders($text) {
        return $this->service->searchOrders($text);
    }

    /**
     * @param string $text
     * @return array
     */
    public function searchPosts($text) {
        return $this->service->searchPosts($text);
    }

    /**
     * @param string $text
     * @return array
     */
    public function searchStores($text) {
        return $this->service->searchStores($text);
    }
}
