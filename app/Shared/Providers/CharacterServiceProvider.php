<?php

namespace App\Shared\Providers;

use App\Characters\Persistence\CharacterEloquentRepository;
use App\Concepts\Persistence\ConceptEloquentRepository;
use Illuminate\Support\ServiceProvider;
use TheSeed\Characters\Characters\Domain\Contracts\CharacterRepository;
use TheSeed\Characters\Concepts\Domain\Contracts\ConceptRepository;

/**
 * Class CharacterServiceProvider
 *
 * @author Unay Santisteban <usantisteban@othercode.es>
 * @package App\Shared\Providers
 */
class CharacterServiceProvider extends ServiceProvider
{
    public array $bindings = [
        CharacterRepository::class => CharacterEloquentRepository::class,
        ConceptRepository::class => ConceptEloquentRepository::class,
    ];
}
