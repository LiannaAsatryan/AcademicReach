<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Enums\CampaignStatus;
use App\Models\Campaign;
use App\Models\LeadMagnet;
use Inertia\Inertia;

class CampaignController extends Controller
{
    public function index()
    {
        return Inertia::render('Campaigns/Index', [
            'campaigns' => Campaign::query()->with('leadMagnet')->latest()->get(),
        ]);
    }

    public function create()
    {
        return Inertia::render('Campaigns/Create', [
            'leadMagnets' => LeadMagnet::query()->latest()->get(['id', 'title']),
            'statuses' => array_map(fn ($c) => $c->value, CampaignStatus::cases()),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'lead_magnet_id' => ['nullable', 'integer', 'exists:lead_magnets,id'],
        ]);

        $user = $request->user();

        $campaign = Campaign::create([
            'user_id' => $user->id,
            'lead_magnet_id' => $data['lead_magnet_id'] ?? null,
            'name' => $data['name'],
            'status' => CampaignStatus::Draft,
            'scheduled_at' => null,
        ]);

        return redirect("/campaigns/{$campaign->id}");
    }

    public function show(Campaign $campaign)
    {
        $campaign->load(['leadMagnet', 'contacts', 'emails']);

        return Inertia::render('Campaigns/Show', [
            'campaign' => $campaign,
            'contacts' => $campaign->contacts,
            'emails' => $campaign->emails,
        ]);
    }

    public function update(Request $request, Campaign $campaign)
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255'],
            'status' => ['sometimes', 'in:draft,active,paused,completed'],
            'scheduled_at' => ['nullable', 'date'],
        ]);

        $campaign->fill($data);
        $campaign->save();

        return redirect("/campaigns/{$campaign->id}");
    }
}
