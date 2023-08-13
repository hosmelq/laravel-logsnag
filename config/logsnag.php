<?php

declare(strict_types=1);

return [

    /*
    |--------------------------------------------------------------------------
    | LogSnag API Token
    |--------------------------------------------------------------------------
    |
    | Define your LogSnag API token for authentication. Retrieve it from
    | your LogSnag dashboard at https://app.logsnag.com/dashboard/settings/api.
    |
    */

    'api_token' => env('LOGSNAG_API_TOKEN'),

    /*
    |--------------------------------------------------------------------------
    | LogSnag Project Identifier
    |--------------------------------------------------------------------------
    |
    | Specify the unique identifier for your LogSnag project. It's used
    | to associate events with a specific project within your LogSnag account.
    | You can find this identifier in the project settings of your LogSnag dashboard.
    |
    */

    'project' => env('LOGSNAG_PROJECT'),

];
