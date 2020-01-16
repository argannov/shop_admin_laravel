<?php

namespace App\Search\Rules;

use ScoutElastic\SearchRule;

class OrdersSearchRule extends SearchRule
{
    /**
     * @inheritdoc
     */
    public function buildHighlightPayload()
    {
        return [
            'fields' => [
                'payed' => [
                    'type' => 'plain',
                    'pre_tags' => '<b>',
                    'post_tags' => '</b>'
                ]
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function buildQueryPayload()
    {
        return [
            'must' => [
                'query_string' => [
                    'query' => $this->builder->query
                ]
            ]
        ];
    }
}
