<?php

declare(strict_types=1);

use HosmelQ\LogSnag\Laravel\Responses\Insight;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;

it('can create an insight with basic information', function (): void {
    Http::fake([
        '*/insight' => Http::response([
            'project' => 'test-project',
            'title' => 'Registered Users on Waitlist',
            'value' => 1,
        ]),
    ]);

    /** @var \HosmelQ\LogSnag\Laravel\Client $client */
    $client = resolve('logsnag');

    $insight = $client->insight()->publish([
        'title' => 'Registered Users on Waitlist',
        'value' => 1,
    ]);

    expect($insight)
        ->toBeInstanceOf(Insight::class)
        ->icon->toBeNull()
        ->project->toBe('test-project')
        ->title->toBe('Registered Users on Waitlist')
        ->value->toBe(1);

    Http::assertSent(function (Request $request): bool {
        return $request->data()['project'] == 'test-project';
    });
});

it('can create an insight with all information', function (): void {
    Http::fake([
        '*/insight' => Http::response([
            'icon' => '🎉',
            'project' => 'test-project',
            'title' => 'Registered Users on Waitlist',
            'value' => 1,
        ]),
    ]);

    /** @var \HosmelQ\LogSnag\Laravel\Client $client */
    $client = resolve('logsnag');

    $insight = $client->insight()->publish([
        'icon' => '🎉',
        'title' => 'Registered Users on Waitlist',
        'value' => 1,
    ]);

    expect($insight)
        ->toBeInstanceOf(Insight::class)
        ->icon->toBe('🎉')
        ->project->toBe('test-project')
        ->title->toBe('Registered Users on Waitlist')
        ->value->toBe(1);
});
