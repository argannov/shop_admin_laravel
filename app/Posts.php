<?php

namespace App;

use App\Search\Configurators\PostsIndexConfigurator;
use Illuminate\Database\Eloquent\Model;
use ScoutElastic\Searchable;

class Posts extends Model
{
    use Searchable;

    protected $indexConfigurator = PostsIndexConfigurator::class;

    protected $table = 'posts';
    protected $fillable = ['id','author_id','category_id','title','anons','body','image','slug','meta_description','meta_keywords','status','created_at','updated_at'];

    protected $searchRules = [
        //
    ];

    protected $mapping = [
        'properties' => [
            'title' => [
                'type' => 'text',
                'fields' => [
                    'raw' => [
                        'type' => 'keyword',
                    ]
                ]
            ],
        ]
    ];
}
