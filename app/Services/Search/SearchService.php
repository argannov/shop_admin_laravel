<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 16.01.2020
 * Time: 16:03
 */

namespace App\Services\Search;


use App\Goods;
use App\Orders;
use App\Posts;
use App\Stores;

class SearchService
{
    /** @var string */
    private $keywords;

    /**
     * @param $keywords string
     * @return array
     */
    public function search($keywords) {
        $this->keywords = $keywords;

        return [
            $this->searchGoods(),
            $this->searchOrders(),
            $this->searchPosts(),
            $this->searchStores()
        ];
    }


    /**
     * @return array
     */
    private function searchGoods() {
        $result = [
            'title' => 'Продукты'
        ];

        $goods = Goods::search($this->keywords)->get();

        /** @var Goods $good */
        foreach ($goods as $good) {
            $result['list'][] = [
                'title' => $good->title ?? null,
                'highlight' => $good->getHighlightAttribute()->title ?? null,
                'link' => route('show_good', ['slug' => $good->slug])
            ];
        }

        return $result;
    }

    /**
     * @return array
     */
    private function searchOrders() {
        $result = [
            'title' => 'Заказы'
        ];

        $orders = Orders::search($this->keywords)->get();

        /** @var Orders $order */
        foreach ($orders as $order) {
            $result['list'][] = [
                'title' => $order->payed ?? null,
                'highlight' => $order->getHighlightAttribute()->payed ?? null,
            ];
        }

        return $result;
    }

    /**
     * @return array
     */
    private function searchPosts() {
        $result = [
            'title' => 'Публикации'
        ];

        $posts = Posts::search($this->keywords)->get();

        /** @var Posts $post */
        foreach ($posts as $post) {
            $result['list'][] = [
                'title' => $post->title ?? null,
                'highlight' => $post->getHighlightAttribute()->title ?? null,
                'link' => route('show_post', ['slug' => $post->slug])
            ];
        }

        return $result;
    }

    /**
     * @return array
     */
    private function searchStores() {
        $result = [
            'title' => 'Магазины'
        ];

        $stores = Stores::search($this->keywords)->get();

        /** @var Stores $store */
        foreach ($stores as $store) {
            $result['list'][] = [
                'title' => $store->name ?? null,
                'highlight' => $store->getHighlightAttribute()->name ?? null,
                'link' => route('show_store', ['slug' => $store->slug])
            ];
        }

        return $result;
    }
}
