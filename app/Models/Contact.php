<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Contact extends Model
{
    protected $fillable = [
        'campaign_id',
        'name',
        'title',
        'institution',
        'email',
        'linkedin_url',
        'email_verified',
    ];

    protected $casts = [
        'email_verified' => 'boolean',
    ];

    public function campaign(): BelongsTo
    {
        return $this->belongsTo(Campaign::class);
    }

    public function campaignEmails(): HasMany
    {
        return $this->hasMany(CampaignEmail::class);
    }
}
