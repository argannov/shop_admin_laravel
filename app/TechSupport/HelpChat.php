<?php

namespace App\TechSupport;

use App\User;
use Illuminate\Database\Eloquent\Model;

/**
 * @property $id int
 * @property $issue_id int
 * @property $asked_user_id int
 * @property $responding_user_id int
 * @property $active bool
 * @property $created_at timestamp
 * @property $updated_at timestamp
 *
 * @property $issue Issue
 * @property $askedUser User
 * @property $respondingUser User
 * @property $messages HelpMessage[]
 *
 * Class HelpChat
 * @package App\TechSupport
 */
class HelpChat extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function issue()
    {
        return $this->belongsTo(Issue::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function askedUser()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function respondingUser()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messages()
    {
        return $this->hasMany(HelpMessage::class);
    }
}
