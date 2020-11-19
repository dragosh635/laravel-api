<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poll extends Model {
    use HasFactory;

    /* Allow a poll to be created with title */
    protected $fillable = [ 'title' ];

    /* When returning the model do not show this field */
    protected $hidden = [ 'questions' ];

    /**
     * Relation between polls and questions
     * A poll has many questions
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function questions() {
        return $this->hasMany( Question::class );
    }
}
