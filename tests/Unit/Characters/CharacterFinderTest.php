<?php

declare(strict_types=1);

namespace Tests\Unit\Characters;

use ComplexHeart\Domain\Criteria\Criteria;
use Illuminate\Support\Collection;
use TheSeed\Characters\Characters\Application\CharacterFinder;
use TheSeed\Characters\Characters\Domain\Character;
use TheSeed\Characters\Characters\Domain\Exceptions\CharacterNotFound;
use TheSeed\Shared\Domain\Models\Id;

use function Pest\Faker\faker;

test('CharacterFinder should find character by Id.', function () {
    $source = makeCharacterSource();

    $finder = new CharacterFinder(makeCharacterRepository([
        'find' => function (Id $id) use ($source): ?Character {
            expect($id->value())->toBe($source->id());
            return Character::fromSource($source);
        }
    ]));
    $character = $finder->byId(new Id($source->id()));

    expect($character)->toBeInstanceOf(Character::class);
});

test('CharacterFinder should throw not found exception for non-existent character.', function () {
    $finder = new CharacterFinder(makeCharacterRepository([
        'find' => fn(Id $id): ?Character => null
    ]));
    $finder->byId(new Id(faker()->uuid()));
})->throws(CharacterNotFound::class);

test('CharacterFinder should match given criteria', function () {
    $finder = new CharacterFinder(makeCharacterRepository([
        'match' => function (Criteria $criteria): Collection {
            return Collection::make();
        }
    ]));
    $characters = $finder->byCriteria(Criteria::createDefault());

    expect($characters)->toHaveCount(0);
});
