<?php

namespace App;

use App\Search\Configurators\PostsIndexConfigurator;
use App\Search\Rules\PostsSearchRule;
use Illuminate\Database\Eloquent\Model;
use ScoutElastic\Searchable;

/**
 * @property $id int
 * @property $author_id int
 * @property $category_id int
 * @property $title string
 * @property $anons string
 * @property $body string
 * @property $image string
 * @property $slug string
 * @property $meta_description string
 * @property $meta_keywords string
 * @property $status string
 * @property $created_at timestamp
 * @property $updated_at timestamp
 *
 * Class Posts
 * @package App
 */
class Posts extends Model
{
    use Searchable;

    protected $indexConfigurator = PostsIndexConfigurator::class;

    protected $table = 'posts';
    protected $fillable = ['id', 'author_id', 'category_id', 'title', 'anons', 'body', 'image', 'slug', 'meta_description', 'meta_keywords', 'status', 'created_at', 'updated_at'];

    protected $searchRules = [
        PostsSearchRule::class
    ];

    protected $mapping = [
        'properties' => [
            'title' => [
                'type' => 'text',
                'analyzer' => 'rebuilt_russian',
                'fields' => [
                    'raw' => [
                        'type' => 'keyword',
                    ]
                ]
            ],
        ]
    ];
}
