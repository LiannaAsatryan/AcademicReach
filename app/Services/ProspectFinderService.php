<?php

namespace App\Services;

class ProspectFinderService
{
    /**
     * @return array<int, array<string, mixed>>
     */
    public function search(array $filters): array
    {
        // Stub: integrate Apollo/Hunter/etc.
        return [];
    }

    public function verifyEmail(string $email): bool
    {
        // Stub: integrate Hunter verification (or SMTP ping).
        return false;
    }
}
