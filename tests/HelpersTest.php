<?php

declare(strict_types=1);

use HosmelQ\LogSnag\Laravel\Contracts\ClientContract;
use function HosmelQ\LogSnag\Laravel\logsnag;

describe('logsnag', function (): void {
    it('should returns an instance of ClientContract', function (): void {
        expect(logsnag())->toBeInstanceOf(ClientContract::class);
    });
});
