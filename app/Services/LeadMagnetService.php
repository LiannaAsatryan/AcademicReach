<?php

namespace App\Services;

use App\Enums\LeadMagnetFormat;
use App\Enums\LeadMagnetStatus;
use App\Models\LeadMagnet;
use App\Models\User;

class LeadMagnetService
{
    public function generate(User $user, string $format): LeadMagnet
    {
        $leadMagnetFormat = LeadMagnetFormat::from($format);

        return LeadMagnet::create([
            'user_id' => $user->id,
            'format' => $leadMagnetFormat,
            'title' => 'Untitled Lead Magnet',
            'content' => '',
            'hosted_slug' => uniqid('lm_', true),
            'status' => LeadMagnetStatus::Draft,
        ]);
    }

    public function exportToPdf(LeadMagnet $magnet): string
    {
        // Stub: implement PDF rendering + storage.
        return (string) $magnet->pdf_url;
    }
}
