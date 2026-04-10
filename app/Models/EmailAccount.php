<?php

namespace App\Models;

use App\Enums\EmailProvider;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EmailAccount extends Model
{
    protected $fillable = [
        'user_id',
        'provider',
        'email',
        'access_token',
        'refresh_token',
        'token_expires_at',
    ];

    protected $casts = [
        'provider' => EmailProvider::class,
        'token_expires_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
