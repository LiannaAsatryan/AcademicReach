<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campaign;
use App\Models\Contact;
use Inertia\Inertia;

class ContactController extends Controller
{
    public function index(Campaign $campaign)
    {
        return Inertia::render('Campaigns/Show', [
            'campaign' => $campaign->load('leadMagnet'),
            'contacts' => $campaign->contacts()->latest()->get(),
            'emails' => $campaign->emails()->latest()->get(),
        ]);
    }

    public function store(Request $request, Campaign $campaign)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'institution' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'linkedin_url' => ['nullable', 'url', 'max:255'],
        ]);

        $campaign->contacts()->create([
            ...$data,
            'email_verified' => false,
        ]);

        return redirect("/campaigns/{$campaign->id}");
    }

    public function destroy(Contact $contact)
    {
        $campaignId = $contact->campaign_id;
        $contact->delete();

        return redirect("/campaigns/{$campaignId}");
    }
}
