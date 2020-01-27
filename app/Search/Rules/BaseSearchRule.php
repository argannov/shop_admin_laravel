<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 17.01.2020
 * Time: 12:58
 */

namespace App\Search\Rules;


use ScoutElastic\SearchRule;

class BaseSearchRule extends SearchRule
{
    /**
     * @inheritdoc
     */
    public function buildHighlightPayload()
    {
        return [
            'fields' => [
                '*' => [
                    'type' => 'plain',
                    'pre_tags' => '<b>',
                    'post_tags' => '</b>'
                ]
            ]
        ];
    }
}
