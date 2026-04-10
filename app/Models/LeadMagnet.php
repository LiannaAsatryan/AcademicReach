<?php

namespace App\Models;

use App\Enums\LeadMagnetFormat;
use App\Enums\LeadMagnetStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LeadMagnet extends Model
{
    protected $fillable = [
        'user_id',
        'format',
        'title',
        'content',
        'pdf_url',
        'hosted_slug',
        'status',
    ];

    protected $casts = [
        'format' => LeadMagnetFormat::class,
        'status' => LeadMagnetStatus::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function campaigns(): HasMany
    {
        return $this->hasMany(Campaign::class);
    }
}
