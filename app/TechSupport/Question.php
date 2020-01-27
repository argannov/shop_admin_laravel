<?php

namespace App\TechSupport;

use Illuminate\Database\Eloquent\Model;

/**
 * @property $id int
 * @property $subject string
 * @property $email string
 * @property $text string
 * @property $responding_user_id int
 * @property $issue_id int
 * @property $status_id int
 * @property $created_at timestamp
 * @property $updated_at timestamp
 *
 * @property $issue Issue
 * @property $status Statue
 *
 * @property $statusLabel string
 *
 * Class Question
 * @mixin \Eloquent
 * @package App\TechSupport
 */
class Question extends Model
{
    protected $fillable = ['id', 'subject', 'email', 'text', 'responding_user_id', 'issue_id', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function issue()
    {
        return $this->hasOne(Issue::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function status()
    {
        return $this->belongsTo(HelpStatus::class);
    }

    /**
     * @return string
     */
    public function getStatusLabelAttribute()
    {
        return $this->status->title;
    }
}
