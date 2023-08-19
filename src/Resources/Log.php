<?php

declare(strict_types=1);

namespace HosmelQ\LogSnag\Laravel\Resources;

use HosmelQ\LogSnag\Laravel\Responses\Log as LogResponse;
use Illuminate\Http\Client\PendingRequest;

class Log
{
    public function __construct(private PendingRequest $client)
    {
    }

    /**
     * @param array{channel: string, description?: string, event: string, icon?: string, notify?: bool, parse?: 'markdown'|'text', project?: string, tags?: array<string, bool|numeric|string>} $payload
     */
    public function publish(array $payload): LogResponse
    {
        if (! array_key_exists('project', $payload)) {
            $payload['project'] = config('logsnag.project');
        }

        /** @var array{channel: string, description?: string, event: string, icon?: string, notify?: bool, parse?: 'markdown'|'text', project: string, tags?: array<string, bool|numeric|string>} $response */
        $response = $this->client
            ->post('log', $payload)
            ->json();

        return LogResponse::from($response);
    }
}
