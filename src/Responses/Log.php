<?php

declare(strict_types=1);

namespace HosmelQ\LogSnag\Laravel\Responses;

use HosmelQ\LogSnag\Laravel\Contracts\ResponseContract;

/**
 * @implements ResponseContract<array{channel: string, description: string|null, event: string, icon: string|null, notify: bool, parse: 'markdown'|'text'|null, project: string, tags: array<string, bool|numeric|string>|null}>
 */
class Log implements ResponseContract
{
    /**
     * @param  array<string, bool|numeric|string>|null  $tags
     * @param  'markdown'|'text'|null  $parse
     */
    public function __construct(
        public string $channel,
        public string $event,
        public string $project,
        public ?array $tags = null,
        public bool $notify = false,
        public ?string $description = null,
        public ?string $icon = null,
        public ?string $parse = null
    ) {
    }

    /**
     * @param  array{channel: string, description: string|null, event: string, icon: string|null, notify: bool, parse: 'markdown'|'text'|null, project: string, tags: array<string, bool|numeric|string>|null}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            channel: $attributes['channel'],
            event: $attributes['event'],
            project: $attributes['project'],
            tags: $attributes['tags'] ?? null,
            notify: $attributes['notify'],
            description: $attributes['description'] ?? null,
            icon: $attributes['icon'] ?? null,
            parse: $attributes['parse'] ?? 'text',
        );
    }

    public function toArray(): array
    {
        return [
            'channel' => $this->channel,
            'description' => $this->description,
            'event' => $this->event,
            'icon' => $this->icon,
            'notify' => $this->notify,
            'parse' => $this->parse,
            'project' => $this->project,
            'tags' => $this->tags,
        ];
    }
}
