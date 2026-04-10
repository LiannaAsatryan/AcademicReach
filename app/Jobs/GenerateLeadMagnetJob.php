<?php

namespace App\Jobs;

use App\Models\LeadMagnet;
use App\Models\User;
use App\Services\LeadMagnetService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class GenerateLeadMagnetJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public readonly int $userId,
        public readonly string $format,
    ) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $user = User::query()->findOrFail($this->userId);
        app(LeadMagnetService::class)->generate($user, $this->format);
    }
}
