<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'body',
    ];

    /**
     * Mutator to keep body and content synced.
     */
    public function setContentAttribute($value)
    {
        $this->attributes['content'] = $value;
        if (!isset($this->attributes['body']) || empty($this->attributes['body'])) {
            $this->attributes['body'] = $value;
        }
    }

    public function setBodyAttribute($value)
    {
        $this->attributes['body'] = $value;
        if (!isset($this->attributes['content']) || empty($this->attributes['content'])) {
            $this->attributes['content'] = $value;
        }
    }
}
