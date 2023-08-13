<?php

declare(strict_types=1);

namespace HosmelQ\LogSnag\Laravel\Exceptions;

use Exception;

class ApiTokenIsMissing extends Exception
{
    public static function create(): ApiTokenIsMissing
    {
        return new ApiTokenIsMissing('LogSnag API token is missing. Please set the LOGSNAG_API_TOKEN environment variable.');
    }
}
