<?php

namespace App\TechSupport;

use Illuminate\Database\Eloquent\Model;

/**
 * @property $id int
 * @property $title string
 * @property $created_at timestamp
 * @property $updated_at timestamp
 *
 * @property $issues Issue[]
 * @property $questions Question[]
 *
 * Class HelpStatus
 * @package App\TechSupport
 */
class HelpStatus extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function issues()
    {
        return $this->hasMany(Issue::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
