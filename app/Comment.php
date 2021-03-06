<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    protected $fillable = [
        'body',
    ];
    public function answer(): BelongsTo
     {
        return $this->belongsTo('App\Answer');
    }
    public function user(): BelongsTo
     {
        return $this->belongsTo('App\User');
    }
}
