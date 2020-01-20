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

    const DEFAULT_OFFSET = 0;
    const DEFAULT_TAKE = 10;

    /**
     * @param string $text
     * @param int $offset
     * @param int $take
     * @return array
     */
    public function searchGoods($text, $offset = self::DEFAULT_OFFSET, $take = self::DEFAULT_TAKE)
    {
        $result = [];

        $goods = Goods::search($text)
            ->from($offset)
            ->take($take)
            ->get();

        /** @var Goods $good */
        foreach ($goods as $good) {
            $result[] = [
                'title' => $good->getHighlightAttribute()->title[0] ?? $good->title ?? null,
                'highlight' => $this->getHighlight($good, ['title']),
                'link' => route('show_good', ['slug' => $good->slug])
            ];
        }

        return $result;
    }

    /**
     * @param string $text
     * @param int $offset
     * @param int $take
     * @return array
     */
    public function searchOrders($text, $offset = self::DEFAULT_OFFSET, $take = self::DEFAULT_TAKE)
    {
        $result = [];

        $orders = Orders::search($text)
            ->from($offset)
            ->take($take)
            ->get();

        /** @var Orders $order */
        foreach ($orders as $order) {
            $result[] = [
                'title' => $order->getHighlightAttribute()->payed[0] ?? $order->payed ?? null,
                'highlight' => $this->getHighlight($order, ['order']),
            ];
        }

        return $result;
    }

    /**
     * @param string $text
     * @param int $offset
     * @param int $take
     * @return array
     */
    public function searchPosts($text, $offset = self::DEFAULT_OFFSET, $take = self::DEFAULT_TAKE)
    {
        $result = [];

        $posts = Posts::search($text)
            ->from($offset)
            ->take($take)
            ->get();

        /** @var Posts $post */
        foreach ($posts as $post) {
            $result[] = [
                'title' => $post->getHighlightAttribute()->title[0] ?? $post->title ?? null,
                'highlight' => $this->getHighlight($post, ['title']),
                'link' => route('show_post', ['slug' => $post->slug])
            ];
        }

        return $result;
    }

    /**
     * @param string $text
     * @param int $offset
     * @param int $take
     * @return array
     */
    public function searchStores($text, $offset = self::DEFAULT_OFFSET, $take = self::DEFAULT_TAKE)
    {
        $result = [];

        $stores = Stores::search($text)
            ->from($offset)
            ->take($take)
            ->get();

        /** @var Stores $store */
        foreach ($stores as $store) {
            $result[] = [
                'title' => $store->getHighlightAttribute()->name[0] ?? $store->name ?? null,
                'highlight' => $this->getHighlight($store, ['name']),
                'link' => route('show_store', ['slug' => $store->slug])
            ];
        }

        return $result;
    }


    /**
     * @param Searchable|Model $searchable
     * @param array $except
     * @return string
     */
    private function getHighlight($searchable, $except)
    {
        $result = '';

        $highlight = $searchable->getHighlightAttribute();

        if (empty($highlight)) {
            return $result;
        }

        foreach (array_keys($searchable->getAttributes()) as $attr) {
            if (in_array($attr, $except)) {
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
