<?php

namespace App\Enums;

enum CampaignEmailStatus: string
{
    case Draft = 'draft';
    case Scheduled = 'scheduled';
    case Sent = 'sent';
    case Opened = 'opened';
    case Replied = 'replied';
    case Bounced = 'bounced';
}

