<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\SendCampaignEmailJob;
use App\Models\Campaign;
use App\Models\CampaignEmail;
use Inertia\Inertia;

class EmailController extends Controller
{
    public function index(Campaign $campaign)
    {
        return Inertia::render('Campaigns/Show', [
            'campaign' => $campaign->load('leadMagnet'),
            'contacts' => $campaign->contacts()->latest()->get(),
            'emails' => $campaign->emails()->with('contact')->latest()->get(),
        ]);
    }

    public function update(Request $request, CampaignEmail $campaignEmail)
    {
        $data = $request->validate([
            'subject' => ['sometimes', 'string', 'max:255'],
            'body' => ['sometimes', 'string'],
            'status' => ['sometimes', 'in:draft,scheduled,sent,opened,replied,bounced'],
        ]);

        $campaignEmail->fill($data)->save();

        return redirect("/campaigns/{$campaignEmail->campaign_id}");
    }

    public function send(Request $request, Campaign $campaign)
    {
        $data = $request->validate([
            'email_id' => ['required', 'integer', 'exists:campaign_emails,id'],
        ]);

        $email = CampaignEmail::query()
            ->where('campaign_id', $campaign->id)
            ->findOrFail($data['email_id']);

        SendCampaignEmailJob::dispatch($email->id);

        return redirect("/campaigns/{$campaign->id}");
    }
}
