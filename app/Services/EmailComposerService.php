<?php

namespace App\Services;

use App\Models\CampaignEmail;
use App\Models\Contact;
use App\Models\LeadMagnet;
use App\Models\User;

class EmailComposerService
{
    /**
     * @return array{subject:string, body:string}
     */
    public function compose(Contact $contact, User $user, LeadMagnet $magnet): array
    {
        // Stub: AI composition (Anthropic) should be invoked from a queued job.
        return [
            'subject' => "Quick question for {$contact->institution}",
            'body' => "Hi {$contact->name},\n\nI’m reaching out about a {$magnet->format->value} I made for {$user->target_audience}.\n\nBest,\n{$user->name}",
        ];
    }

    /**
     * @return array{subject:string, body:string}
     */
    public function composeFollowUp(CampaignEmail $previous, int $step): array
    {
        // Stub: AI follow-up composition should be invoked from a queued job.
        return [
            'subject' => $previous->subject,
            'body' => "Just following up (step {$step}).\n\n" . $previous->body,
        ];
    }
}
