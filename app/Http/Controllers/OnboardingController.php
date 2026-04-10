<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class OnboardingController extends Controller
{
    public function show(Request $request)
    {
        $user = $request->user();

        return Inertia::render('Onboarding', [
            'initial' => [
                'niche' => $user?->niche,
                'goal' => $user?->goal,
                'tone' => $user?->tone?->value ?? 'friendly',
                'target_audience' => $user?->target_audience,
                'offer' => $user?->offer,
            ],
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'niche' => ['nullable', 'string', 'max:255'],
            'goal' => ['nullable', 'string', 'max:255'],
            'tone' => ['nullable', 'in:formal,friendly,academic'],
            'target_audience' => ['nullable', 'string', 'max:255'],
            'offer' => ['nullable', 'string'],
        ]);

        $user = $request->user();
        $user->fill([
            'niche' => $data['niche'] ?? null,
            'goal' => $data['goal'] ?? null,
            'tone' => $data['tone'] ?? 'friendly',
            'target_audience' => $data['target_audience'] ?? null,
            'offer' => $data['offer'] ?? null,
            'onboarding_completed' => true,
        ]);
        $user->save();

        return redirect('/dashboard');
    }
}
