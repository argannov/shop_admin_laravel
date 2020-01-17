<?php

namespace App\Services\Search;

use App\Goods;
use App\Orders;
use App\Posts;
use App\Stores;
use Illuminate\Database\Eloquent\Model;
use ScoutElastic\Searchable;

class SearchService
{
    /** @var string */
    private $text;

    /**
     * @param $text string
     * @return array
     */
    public function search($text)
    {
        $this->text = $text;

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
    private function searchGoods()
    {
        $result = [
            'title' => 'Продукты'
        ];

        $goods = Goods::search($this->text)->get();

        /** @var Goods $good */
        foreach ($goods as $good) {
            $result['list'][] = [
                'title' => $good->getHighlightAttribute()->title[0] ?? $good->title ?? null,
                'highlight' => $this->getHighlight($good, ['title']),
                'link' => route('show_good', ['slug' => $good->slug])
            ];
        }

        return $result;
    }

    /**
     * @return array
     */
    private function searchOrders()
    {
        $result = [
            'title' => 'Заказы'
        ];

        $orders = Orders::search($this->text)->get();

        /** @var Orders $order */
        foreach ($orders as $order) {
            $result['list'][] = [
                'title' => $order->getHighlightAttribute()->payed[0] ?? $order->payed ?? null,
                'highlight' => $this->getHighlight($order, ['order']),
            ];
        }

        return $result;
    }

    /**
     * @return array
     */
    private function searchPosts()
    {
        $result = [
            'title' => 'Публикации'
        ];

        $posts = Posts::search($this->text)->get();

        /** @var Posts $post */
        foreach ($posts as $post) {
            $result['list'][] = [
                'title' => $post->getHighlightAttribute()->title[0] ?? $post->title ?? null,
                'highlight' => $this->getHighlight($post, ['title']),
                'link' => route('show_post', ['slug' => $post->slug])
            ];
        }

        return $result;
    }

    /**
     * @return array
     */
    private function searchStores()
    {
        $result = [
            'title' => 'Магазины'
        ];

        $stores = Stores::search($this->text)->get();

        /** @var Stores $store */
        foreach ($stores as $store) {
            $result['list'][] = [
                'title' => $store->getHighlightAttribute()->name[0] ?? $store->name ?? null,
                'highlight' => $this->getHighlight($store, ['title']),
                'link' => route('show_store', ['slug' => $store->slug])
            ];
        }

        return $result;
    }


    /**
     * @param $searchable Searchable|Model
     * @param $exept array
     * @return string
     */
    private function getHighlight($searchable, $exept)
    {
        $result = '';

        $highlight = $searchable->getHighlightAttribute();

        if (empty($highlight)) {
            return $result;
        }

        foreach (array_keys($searchable->getAttributes()) as $attr) {
            if (in_array($attr, $exept)) {
                continue;
            }

            $value = $highlight->$attr;

            if (empty($value)) {
                continue;
            }

            $result .= (is_array($value) ? $value[0] : $value) . '; ';
        }

        return trim($result);
    }
}
