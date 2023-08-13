<?php

declare(strict_types=1);

namespace HosmelQ\LogSnag\Laravel\Tests;

use HosmelQ\LogSnag\Laravel\LogSnagServiceProvider;
use Illuminate\Support\Facades\Http;
use Orchestra\Testbench\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Http::preventStrayRequests();
    }

    protected function getEnvironmentSetUp($app): void
    {
        config()->set('logsnag', [
            'api_token' => 'api-token',
            'project' => 'test-project',
        ]);
    }

    protected function getPackageProviders($app): array
    {
        return [
            LogSnagServiceProvider::class,
        ];
    }
}
