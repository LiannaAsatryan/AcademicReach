<?php

namespace App\Jobs;

use App\Models\CampaignEmail;
use App\Services\CampaignSenderService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class SendCampaignEmailJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public readonly int $campaignEmailId,
    ) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $email = CampaignEmail::query()->findOrFail($this->campaignEmailId);
        app(CampaignSenderService::class)->send($email);
    }
}
