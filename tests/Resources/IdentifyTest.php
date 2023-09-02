<?php

declare(strict_types=1);

use HosmelQ\LogSnag\Laravel\Responses\Identify;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;

it('can create an identify', function (): void {
    Http::fake([
        '*/identify' => Http::response([
            'properties' => [
                'name' => 'John Doe',
            ],
            'project' => 'test-project',
            'user_id' => '123',
        ]),
    ]);

    /** @var \HosmelQ\LogSnag\Laravel\Client $client */
    $client = resolve('logsnag');

    $insight = $client->identify()->publish([
        'properties' => [
            'name' => 'John Doe',
        ],
        'user_id' => '123',
    ]);

    expect($insight)
        ->toBeInstanceOf(Identify::class)
        ->project->toBe('test-project')
        ->properties->toBe([
            'name' => 'John Doe',
        ])
        ->userId->toBe('123');
});

it('can create an identify with custom project', function (): void {
    Http::fake([
        '*/identify' => Http::response([
            'properties' => [
                'name' => 'John Doe',
            ],
            'project' => 'test-project',
            'user_id' => '123',
        ]),
    ]);

    /** @var \HosmelQ\LogSnag\Laravel\Client $client */
    $client = resolve('logsnag');

    $client->identify()->publish([
        'project' => 'test-project-2',
        'properties' => [
            'name' => 'John Doe',
        ],
        'user_id' => '123',
    ]);

    Http::assertSent(function (Request $request): bool {
        return $request->data()['project'] == 'test-project-2';
    });
});
