<?php

namespace HosmelQ\LogSnag\Laravel;

use HosmelQ\LogSnag\Laravel\Contracts\ClientContract;

/**
 * Get the LogSnag client instance.
 */
function logsnag(): ClientContract
{
    return app(ClientContract::class);
}
