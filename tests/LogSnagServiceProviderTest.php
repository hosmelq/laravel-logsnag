<?php

use HosmelQ\LogSnag\Laravel\Exceptions\ApiTokenIsMissing;

it('requires a token', function (): void {
    config()->set('logsnag.api_token', null);

    resolve('logsnag');
})->throws(
    ApiTokenIsMissing::class,
    'LogSnag API token is missing. Please set the LOGSNAG_API_TOKEN environment variable.',
);

it('binds the client as singleton', function (): void {
    $client = resolve('logsnag');

    expect(resolve('logsnag'))->toBe($client);
});
