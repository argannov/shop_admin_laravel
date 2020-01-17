<?php

namespace App\Search\Rules;

use ScoutElastic\SearchRule;

class PostsSearchRule extends SearchRule
{
    /**
     * @inheritdoc
     */
    public function buildHighlightPayload()
    {
        return [
            'fields' => [
                'title' => [
                    'type' => 'plain',
                    'pre_tags' => '<b>',
                    'post_tags' => '</b>'
                ]
            ]
        ];
    }
}
