<?php

use HosmelQ\LogSnag\Laravel\Contracts\ClientContract;

describe('logsnag', function (): void {
    it('should returns an instance of ClientContract', function (): void {
        expect(logsnag())->toBeInstanceOf(ClientContract::class);
    });
});
