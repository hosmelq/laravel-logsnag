<?php

declare(strict_types=1);

namespace HosmelQ\LogSnag\Laravel\Responses;

use HosmelQ\LogSnag\Laravel\Contracts\ResponseContract;

/**
 * @implements ResponseContract<array{project: string, properties: array{string: bool|numeric|string}, user_id: string}>
 */
class Identify implements ResponseContract
{
    /**
     * @param array{string: bool|numeric|string} $properties
     */
    public function __construct(
        public string $project,
        public array $properties,
        public string $userId,
    ) {
    }

    /**
     * @param array{project: string, properties: array{string: bool|numeric|string}, user_id: string} $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            project: $attributes['project'],
            properties: $attributes['properties'],
            userId: $attributes['user_id'],
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'project' => $this->project,
            'properties' => $this->properties,
            'user_id' => $this->userId,
        ];
    }
}
