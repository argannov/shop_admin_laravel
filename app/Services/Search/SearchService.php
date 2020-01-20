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
        list($goods, $total) = $this->searchEntity(Goods::class, $text, $offset, $take);

        $result = [
            'pagination' => [
                'total' => $total,
                'offset' => $offset,
                'take' => $take
            ],
            'items' => []
        ];

        /** @var Goods $good */
        foreach ($goods as $good) {
            $result['items'][] = [
                'title' => $good->getHighlightAttribute()->title[0] ?? $good->title ?? null,
                'highlight' => $this->getHighlight($good, ['title']),
                'link' => route('show_good', ['slug' => $good->slug]),
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
        list($orders, $total) = $this->searchEntity(Orders::class, $text, $offset, $take);

        $result = [
            'pagination' => [
                'total' => $total,
                'offset' => $offset,
                'take' => $take
            ],
            'items' => []
        ];

        /** @var Orders $order */
        foreach ($orders as $order) {
            $result['items'][] = [
                'title' => $order->getHighlightAttribute()->payed[0] ?? $order->payed ?? null,
                'highlight' => $this->getHighlight($order, ['order'])
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
        list($posts, $total) = $this->searchEntity(Posts::class, $text, $offset, $take);

        $result = [
            'pagination' => [
                'total' => $total,
                'offset' => $offset,
                'take' => $take
            ],
            'items' => []
        ];

        /** @var Posts $post */
        foreach ($posts as $post) {
            $result['items'][] = [
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
        list($stores, $total) = $this->searchEntity(Stores::class, $text, $offset, $take);

        $result = [
            'pagination' => [
                'total' => $total,
                'offset' => $offset,
                'take' => $take
            ],
            'items' => []
        ];

        /** @var Stores $store */
        foreach ($stores as $store) {
            $result['items'][] = [
                'title' => $store->getHighlightAttribute()->name[0] ?? $store->name ?? null,
                'highlight' => $this->getHighlight($store, ['name']),
                'link' => route('show_store', ['slug' => $store->slug])
            ];
        }

        return $result;
    }

    /**
     * @param string|Searchable $className
     * @param string $text
     * @param int $offset
     * @param int $take
     * @return array
     */
    private function searchEntity($className, $text, $offset = self::DEFAULT_OFFSET, $take = self::DEFAULT_TAKE) {
        $elements = $className::search($text)
            ->from($offset)
            ->take($take)
            ->get();

        /** @var int $total */
        $total = $className::search($text)->count();

        return [$elements, $total];
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
