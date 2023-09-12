<?php

declare(strict_types=1);

use HosmelQ\LogSnag\Laravel\Responses\Log;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;

it('can create a log with basic information', function (): void {
    Http::fake([
        '*/log' => Http::response([
            'project' => 'test-project',
            'channel' => 'waitlist',
            'event' => 'User Joined Waitlist',
            'notify' => false,
            'parser' => 'text',
        ]),
    ]);

    /** @var \HosmelQ\LogSnag\Laravel\Client $client */
    $client = resolve('logsnag');

    $log = $client->log()->publish([
        'channel' => 'waitlist',
        'event' => 'User Joined Waitlist',
    ]);

    expect($log)
        ->toBeInstanceOf(Log::class)
        ->channel->toBe('waitlist')
        ->description->toBeNull()
        ->event->toBe('User Joined Waitlist')
        ->icon->toBeNull()
        ->notify->toBeFalse()
        ->parse->toBe('text')
        ->project->toBe('test-project')
        ->tags->toBe([]);

    Http::assertSent(function (Request $request): bool {
        return $request->data()['project'] == 'test-project';
    });
});

it('can create a log with all information', function (): void {
    Http::fake([
        '*/log' => Http::response([
            'channel' => 'waitlist',
            'description' => 'Email: hosmelq@gmail.com',
            'event' => 'User Joined Waitlist',
            'icon' => '🎉',
            'notify' => true,
            'parse' => 'text',
            'project' => 'test-project',
            'tags' => [
                'email' => 'hosmelq@gmail.com',
                'name' => 'hosmel quintana',
            ],
            'user_id' => '123',
        ]),
    ]);

    /** @var \HosmelQ\LogSnag\Laravel\Client $client */
    $client = resolve('logsnag');

    $log = $client->log()->publish([
        'channel' => 'waitlist',
        'description' => 'Email: hosmelq@gmail.com',
        'event' => 'User Joined Waitlist',
        'icon' => '🎉',
        'notify' => true,
        'parse' => 'text',
        'tags' => [
            'email' => 'hosmelq@gmail.com',
            'name' => 'Hosmel Quintana',
        ],
        'user_id' => '123',
    ]);

    expect($log)
        ->toBeInstanceOf(Log::class)
        ->channel->toBe('waitlist')
        ->description->toBe('Email: hosmelq@gmail.com')
        ->event->toBe('User Joined Waitlist')
        ->icon->toBe('🎉')
        ->notify->toBeTrue()
        ->parse->toBe('text')
        ->project->toBe('test-project')
        ->tags->toBe([
            'email' => 'hosmelq@gmail.com',
            'name' => 'hosmel quintana',
        ])
        ->userId->toBe('123');
});

it('can create a log with custom project', function (): void {
    Http::fake([
        '*/log' => Http::response([
            'project' => 'test-project-2',
            'channel' => 'waitlist',
            'event' => 'User Joined Waitlist',
        ]),
    ]);

    /** @var \HosmelQ\LogSnag\Laravel\Client $client */
    $client = resolve('logsnag');

    $client->log()->publish([
        'channel' => 'waitlist',
        'event' => 'User Joined Waitlist',
        'project' => 'test-project-2',
    ]);

    Http::assertSent(function (Request $request): bool {
        return $request->data()['project'] == 'test-project-2';
    });
});
