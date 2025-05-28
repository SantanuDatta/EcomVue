<?php

declare(strict_types=1);

use App\Queries\AbstractQueryBuilder;
use Illuminate\Database\Eloquent\Factories\Factory;

arch()->preset()->php();
arch()->preset()->laravel();
arch()->preset()->security();

arch('strict types')
    ->expect('App')
    ->toUseStrictTypes();

arch('avoid mutation')
    ->expect('App')
    ->classes()
    ->toBeReadonly()
    ->ignoring([
        'App\Actions',
        'App\Enums',
        'App\Models',
        'App\Providers',
        'App\Http\Requests',
        'App\Http\Resources',
    ]);

arch('avoid inheritance')
    ->expect('App')
    ->classes()
    ->toExtendNothing()
    ->ignoring([
        'App\Actions',
        'App\Enums',
        'App\Models',
        'App\Providers',
        'App\Http\Requests',
        'App\Http\Resources',
    ]);

arch('annotations')
    ->expect('App')
    ->toHavePropertiesDocumented()
    ->toHaveMethodsDocumented();

arch('avoid abstraction')
    ->expect('App')
    ->not->toBeAbstract()
    ->ignoring([
        'App\Contracts',
        AbstractQueryBuilder::class,
    ]);

arch('factories')
    ->expect('Database\Factories')
    ->toExtend(Factory::class)
    ->toHaveMethod('definition')
    ->toOnlyBeUsedIn([
        'App\Models',
    ]);

arch('actions')
    ->expect('App\Actions')
    ->toHaveMethod('handle');
