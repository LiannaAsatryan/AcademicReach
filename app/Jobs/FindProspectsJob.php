<?php

namespace App\Jobs;

use App\Models\Campaign;
use App\Services\ProspectFinderService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class FindProspectsJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public readonly int $campaignId,
        /** @var array<string, mixed> */
        public readonly array $filters = [],
    ) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $campaign = Campaign::query()->findOrFail($this->campaignId);

        $results = app(ProspectFinderService::class)->search($this->filters);

        // Stub: map $results into Contact records for the campaign.
        unset($campaign);
        unset($results);
    }
}
