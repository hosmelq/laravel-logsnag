> This is an unofficial package for [LogSnag](https://logsnag.com).

# Laravel LogSnag

Easily integrate [LogSnag](https://logsnag.com)'s event tracking into your Laravel app. Monitor user activity, 
get realtime analytics, and receive instant insights.

## Requirements

This package requires PHP 8.1 or higher and Laravel 10.0 or higher. 

## Installation

You can install the package via composer:

```sh
composer require hosmelq/laravel-logsnag
```

## Configuration

You can publish the config file with:

```sh
php artisan vendor:publish --tag="logsnag-config"
```

Alternatively, you may utilize the install command.

```sh
php artisan logsnag:install
```

Next, you should configure your LogSnag API token and project name in your application’s `.env` file:

```dosini
LOGSNAG_API_TOKEN=your-api-token
LOGSNAG_PROJECT=your-project-name
```

We determine the project to send events to using `LOGSNAG_PROJECT`. Alternatively, you can specify
the project name when creating an event or insight.

## Usage

### Publish Event

You can use the `LogSnag` facade to publish events,  and insights.

```php
use HosmelQ\LogSnag\Laravel\Facades\LogSnag;

LogSnag::log()->publish([
    'channel' => 'waitlist',
    'event' => 'User Joined Waitlist',
    'icon' => '🎉',
]);
```

This method returns a [Log](src/Responses/Log.php) instance that provides access to the response 
from the LogSnag API. For more information and a list of available parameters, refer to the LogSnag
[documentation](https://docs.logsnag.com/endpoints/log) for Log.

## Publish Insight

```php
use HosmelQ\LogSnag\Laravel\Facades\LogSnag;

LogSnag::insight()->publish([
    'icon' => '🎉',
    'title' => 'Registered Users on Waitlist',
    'value' => 8,
]);
```

This method returns an [Insight](src/Responses/Log.php) instance that provides access to the response
from the LogSnag API. For more information and a list of available parameters, refer to the LogSnag
[documentation](https://docs.logsnag.com/endpoints/insight) for Insight.

## User Properties

```php
use HosmelQ\LogSnag\Laravel\Facades\LogSnag;

LogSnag::identify()->publish([
    'properties' => [
        'email' => 'john@doe.com',
        'name' => 'John Doe',
        'plan' => 'premium',
    ],
    'user_id' => '123',
]);
```

This method returns an [Identify](src/Responses/Identify.php) instance that provides access to the response
from the LogSnag API. For more information and a list of available parameters, refer to the LogSnag
[documentation](https://docs.logsnag.com/endpoints/identify) for Identify.

Apart from the facade, you can utilize the `logsnag` helper function.

```php
logsnag()->log()->publish([
    'channel' => 'waitlist',
    'event' => 'User Joined Waitlist',
    'icon' => '🎉',
]);
```

## Credits

- [Hosmel Quintana](https://github.com/hosmelq)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
