<?php

declare(strict_types=1);

use function Pest\Laravel\artisan;

it('publishes the config file', function (): void {
    artisan('logsnag:install')
        ->expectsConfirmation('Would you like to star the repo on GitHub?')
        ->assertSuccessful();

    expect(config_path('logsnag.php'))->toBeFile();
});
