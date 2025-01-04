<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Media extends Model
{
    protected $fillable = [
        'url',
    ];

    public function mediaModel(): MorphTo
    {
        return $this->morphTo();
    }
}
