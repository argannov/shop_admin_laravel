<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Search\SearchService;
use Illuminate\Http\Request;

class SearchDashboardController extends Controller
{

    /** @var Request */
    private $request;

    /** @var SearchService */
    private $service;

    public function __construct(Request $request, SearchService $service)
    {
        $this->request = $request;
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
        $offset = $this->request->get('offset');
        $take = $this->request->get('take');

        if (isset($offset) && isset($take)) {
            return $this->service->searchGoods($text, $offset, $take);
        }

        return $this->service->searchGoods($text);
    }

    /**
     * @param string $text
     * @return array
     */
    public function searchOrders($text) {
        $offset = $this->request->get('offset');
        $take = $this->request->get('take');

        if (isset($offset) && isset($take)) {
            return $this->service->searchOrders($text, $offset, $take);
        }

        return $this->service->searchOrders($text);
    }

    /**
     * @param string $text
     * @return array
     */
    public function searchPosts($text) {
        $offset = $this->request->get('offset');
        $take = $this->request->get('take');

        if (isset($offset) && isset($take)) {
            return $this->service->searchPosts($text, $offset, $take);
        }

        return $this->service->searchPosts($text);
    }

    /**
     * @param string $text
     * @return array
     */
    public function searchStores($text) {
        $offset = $this->request->get('offset');
        $take = $this->request->get('take');

        if (isset($offset) && isset($take)) {
            return $this->service->searchStores($text, $offset, $take);
        }

        return $this->service->searchStores($text);
    }
}
