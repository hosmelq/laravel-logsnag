<?php

declare(strict_types=1);

namespace HosmelQ\LogSnag\Laravel\Resources;

use HosmelQ\LogSnag\Laravel\Responses\Insight as InsightResponse;
use Illuminate\Http\Client\PendingRequest;

class Insight
{
    public function __construct(private PendingRequest $client)
    {
    }

    /**
     * @param  array{icon: string|null, project: string, title: string, value: numeric|string}  $payload
     */
    public function publish(array $payload): InsightResponse
    {
        if (! in_array('project', $payload)) {
            $payload['project'] = config('logsnag.project');
        }

        /** @var array{icon: string|null, project: string, title: string, value: numeric|string} $response */
        $response = $this->client
            ->post('insight', $payload)
            ->json();

        return InsightResponse::from($response);
    }
}
