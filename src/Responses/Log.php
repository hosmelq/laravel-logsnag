<?php

declare(strict_types=1);

namespace HosmelQ\LogSnag\Laravel\Responses;

use HosmelQ\LogSnag\Laravel\Contracts\ResponseContract;

/**
 * @implements ResponseContract<array{channel: string, description: string|null, event: string, icon: string|null, notify: bool, parse: 'markdown'|'text'|null, project: string, tags?: array<string, bool|numeric|string>, user_id: string|null}>
 */
class Log implements ResponseContract
{
    /**
     * @param array<string, bool|numeric|string> $tags
     * @param 'markdown'|'text' $parse
     */
    public function __construct(
        public string $channel,
        public string $event,
        public string $project,
        public ?string $description,
        public ?string $icon,
        public ?string $userId,
        public bool $notify = false,
        public string $parse = 'text',
        public array $tags = [],
    ) {
    }

    /**
     * @param array{channel: string, description?: string, event: string, icon?: string, notify?: bool, parse?: 'markdown'|'text', project: string, tags?: array<string, bool|numeric|string>, user_id?: string} $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            channel: $attributes['channel'],
            event: $attributes['event'],
            project: $attributes['project'],
            description: $attributes['description'] ?? null,
            icon: $attributes['icon'] ?? null,
            userId: $attributes['user_id'] ?? null,
            notify: $attributes['notify'] ?? false,
            parse: $attributes['parse'] ?? 'text',
            tags: $attributes['tags'] ?? [],
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
            'user_id' => $this->userId,
        ];
    }
}
