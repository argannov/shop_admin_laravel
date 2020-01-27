<?php

namespace App\TechSupport;

use App\User;
use Illuminate\Database\Eloquent\Model;

/**
 * @property $id int
 * @property $help_category_id int
 * @property $help_status_id int
 * @property $user_id int
 * @property $subject string
 * @property $created_at timestamp
 * @property $updated_at timestamp
 *
 * @property $category HelpCategory
 * @property $status HelpStatus
 * @property $user User
 * @property $chats HelpChat[]
 *
 * Class Issue
 * @package App\TechSupport
 */
class Issue extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(HelpCategory::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function status()
    {
        return $this->belongsTo(HelpStatus::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function chats()
    {
        return $this->hasMany(HelpChat::class);
    }
}
