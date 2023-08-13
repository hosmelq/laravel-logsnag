<?php

declare(strict_types=1);

namespace HosmelQ\LogSnag\Laravel\Responses;

use HosmelQ\LogSnag\Laravel\Contracts\ResponseContract;

/**
 * @implements ResponseContract<array{icon: string|null, project: string, title: string, value: numeric|string}>
 */
class Insight implements ResponseContract
{
    public function __construct(
        public string $project,
        public string $title,
        public float|int|string $value,
        public ?string $icon,
    ) {
    }

    /**
     * @param  array{icon?: string, project: string, title: string, value: numeric|string}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            project: $attributes['project'],
            title: $attributes['title'],
            value: $attributes['value'],
            icon: $attributes['icon'] ?? null,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'icon' => $this->icon,
            'project' => $this->project,
            'title' => $this->title,
            'value' => $this->value,
        ];
    }
}
