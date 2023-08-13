<?php

declare(strict_types=1);

namespace HosmelQ\LogSnag\Laravel;

use Illuminate\Http\Client\PendingRequest;

class LogSnag
{
    private string $apiToken;

    private string $baseUri = 'https://api.logsnag.com/v1';

    private PendingRequest $httpClient;

    public static function factory(): LogSnag
    {
        return new LogSnag();
    }

    public function make(): Client
    {
        $this->httpClient
            ->acceptJson()
            ->asJson()
            ->baseUrl($this->baseUri)
            ->withToken($this->apiToken);

        return new Client($this->httpClient);
    }

    public function withApiToken(string $token): static
    {
        $this->apiToken = trim($token);

        return $this;
    }

    public function withHttpClient(PendingRequest $client): static
    {
        $this->httpClient = $client;

        return $this;
    }
}
