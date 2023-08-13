<?php

declare(strict_types=1);

namespace HosmelQ\LogSnag\Laravel\Facades;

use HosmelQ\LogSnag\Laravel\Contracts\ClientContract;
use Illuminate\Support\Facades\Facade;

/**
 * @method static \HosmelQ\LogSnag\Laravel\Resources\Insight insight()
 * @method static \HosmelQ\LogSnag\Laravel\Resources\Log log()
 */
class LogSnag extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return ClientContract::class;
    }
}
