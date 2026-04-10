<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Enums\LeadMagnetFormat;
use App\Models\LeadMagnet;
use Inertia\Inertia;

class LeadMagnetController extends Controller
{
    public function index()
    {
        return Inertia::render('LeadMagnets/Index', [
            'magnets' => LeadMagnet::query()->latest()->get(),
        ]);
    }

    public function create()
    {
        return Inertia::render('LeadMagnets/Create', [
            'formats' => array_map(fn ($c) => $c->value, LeadMagnetFormat::cases()),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'format' => ['required', 'in:guide,checklist,template,swipe_file'],
            'title' => ['required', 'string', 'max:255'],
            'content' => ['nullable', 'string'],
        ]);

        $user = $request->user();

        $magnet = LeadMagnet::create([
            'user_id' => $user->id,
            'format' => LeadMagnetFormat::from($data['format']),
            'title' => $data['title'],
            'content' => $data['content'] ?? '',
            'hosted_slug' => uniqid('magnet_', true),
            'status' => 'draft',
        ]);

        return redirect("/lead-magnets/{$magnet->id}");
    }

    public function show(LeadMagnet $leadMagnet)
    {
        return Inertia::render('LeadMagnets/Show', [
            'magnet' => $leadMagnet,
        ]);
    }

    public function destroy(LeadMagnet $leadMagnet)
    {
        $leadMagnet->delete();
        return redirect('/lead-magnets');
    }
}
