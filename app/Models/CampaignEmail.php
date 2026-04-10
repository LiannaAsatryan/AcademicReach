<?php

namespace App\Models;

use App\Enums\CampaignEmailStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CampaignEmail extends Model
{
    protected $fillable = [
        'campaign_id',
        'contact_id',
        'step',
        'subject',
        'body',
        'status',
        'sent_at',
        'opened_at',
        'replied_at',
    ];

    protected $casts = [
        'status' => CampaignEmailStatus::class,
        'sent_at' => 'datetime',
        'opened_at' => 'datetime',
        'replied_at' => 'datetime',
    ];

    public function campaign(): BelongsTo
    {
        return $this->belongsTo(Campaign::class);
    }

    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class);
    }
}
