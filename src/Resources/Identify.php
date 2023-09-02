<?php

declare(strict_types=1);

namespace HosmelQ\LogSnag\Laravel\Resources;

use HosmelQ\LogSnag\Laravel\Responses\Identify as IdentifyResponse;
use Illuminate\Http\Client\PendingRequest;

class Identify
{
    public function __construct(private readonly PendingRequest $client)
    {
    }

    /**
     * @param array{project?: string, properties: array{string: bool|numeric|string}, user_id: string} $payload
     */
    public function publish(array $payload): IdentifyResponse
    {
        if (! array_key_exists('project', $payload)) {
            $payload['project'] = config('logsnag.project');
        }

        /** @var array{project: string, properties: array{string: bool|numeric|string}, user_id: string} $response */
        $response = $this->client
            ->post('identify', $payload)
            ->json();

        return IdentifyResponse::from($response);
    }
}
