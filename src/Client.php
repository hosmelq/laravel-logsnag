<?php

declare(strict_types=1);

namespace HosmelQ\LogSnag\Laravel;

use HosmelQ\LogSnag\Laravel\Contracts\ClientContract;
use HosmelQ\LogSnag\Laravel\Resources\Identify;
use HosmelQ\LogSnag\Laravel\Resources\Insight;
use HosmelQ\LogSnag\Laravel\Resources\Log;
use Illuminate\Http\Client\PendingRequest;

class Client implements ClientContract
{
    public function __construct(private readonly PendingRequest $client)
    {
    }

    public function identify(): Identify
    {
        return new Identify($this->client);
    }

    public function insight(): Insight
    {
        return new Insight($this->client);
    }

    public function log(): Log
    {
        return new Log($this->client);
    }
}
