<?php

namespace App\Jobs;

use App\Models\Campaign;
use App\Models\CampaignEmail;
use App\Services\EmailComposerService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ComposeEmailsJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public readonly int $campaignId,
    ) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $campaign = Campaign::query()->with(['user', 'leadMagnet', 'contacts'])->findOrFail($this->campaignId);
        $magnet = $campaign->leadMagnet;
        $user = $campaign->user;

        if (! $magnet) {
            return;
        }

        $composer = app(EmailComposerService::class);

        foreach ($campaign->contacts as $contact) {
            $draft = $composer->compose($contact, $user, $magnet);

            CampaignEmail::updateOrCreate(
                ['campaign_id' => $campaign->id, 'contact_id' => $contact->id, 'step' => 1],
                ['subject' => $draft['subject'], 'body' => $draft['body'], 'status' => 'draft'],
            );
        }
    }
}
