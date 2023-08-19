<?php

declare(strict_types=1);

use Rector\CodeQuality\Rector\Class_\InlineConstructorDefaultToPropertyRector;
use Rector\Config\RectorConfig;
use Rector\Php74\Rector\Closure\ClosureToArrowFunctionRector;
use Rector\Set\ValueObject\LevelSetList;
use Rector\Set\ValueObject\SetList;
use Rector\TypeDeclaration\Rector\ClassMethod\StrictArrayParamDimFetchRector;

return static function (RectorConfig $config): void {
    $config->paths([
        __DIR__.'/src',
        __DIR__.'/tests',
    ]);

    $config->rules([
        InlineConstructorDefaultToPropertyRector::class,
    ]);

    $config->sets([
        LevelSetList::UP_TO_PHP_81,
        SetList::CODE_QUALITY,
        SetList::DEAD_CODE,
        SetList::EARLY_RETURN,
        SetList::TYPE_DECLARATION,
    ]);

    $config->skip([
        ClosureToArrowFunctionRector::class,
        // Disable this rule for now, as it's causing issues with the Laravel
        // service providers type-hinting $app as array.
        StrictArrayParamDimFetchRector::class => [
            __DIR__.'/src/LogSnagServiceProvider.php',
        ],
    ]);
};
