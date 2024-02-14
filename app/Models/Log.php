<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Log extends Model
{
    public $timestamps = false;

    protected $fillable = ['message_id'];

    /**
     * Объявить связи
     */
    public function message(): BelongsTo
    {
        return $this->belongsTo(LogMessage::class);
    }
}
