<?php

namespace App\Services;

use App\Models\Campaign;
use App\Models\CampaignEmail;

class CampaignSenderService
{
    public function send(CampaignEmail $email): bool
    {
        // Stub: integrate Gmail/Outlook provider and record delivery/open/reply webhooks.
        return true;
    }

    public function scheduleSequence(Campaign $campaign): void
    {
        // Stub: enqueue SendCampaignEmailJob instances for the campaign.
    }
}
