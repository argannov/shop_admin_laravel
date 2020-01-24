<?php

namespace App\TechSupport;

use App\User;
use Illuminate\Database\Eloquent\Model;

/**
 * @property $id int
 * @property $author_id int
 * @property $chat_id int
 * @property $text string
 * @property $help_message_id int
 * @property $created_at timestamp
 * @property $updated_at timestamp
 *
 * @property $author User
 * @property $chat HelpChat
 *
 * Class HelpMessage
 * @package App\TechSupport
 */
class HelpMessage extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function chat()
    {
        return $this->belongsTo(HelpChat::class);
    }
}
