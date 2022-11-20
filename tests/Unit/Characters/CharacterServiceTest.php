<?php

declare(strict_types=1);

namespace Tests\Unit\Characters;

use ComplexHeart\Domain\Criteria\Criteria;
use Illuminate\Support\Collection;
use TheSeed\Characters\Characters\Application\CharacterCreator;
use TheSeed\Characters\Characters\Domain\Character;
use TheSeed\Characters\Characters\Domain\Exceptions\CharacterAmountExceeded;
use TheSeed\Characters\Characters\Domain\Exceptions\CharacterSectionInvalidReference;
use TheSeed\Characters\Characters\Domain\Sections;
use TheSeed\Characters\Characters\Domain\Status;

use function Pest\Faker\faker;

test('CharacterCreator should create (and persist) a Character.', function () {
    $source = makeCharacterSource();

    $creator = new CharacterCreator(makeCharacterRepository([
        'match' => function (Criteria $criteria): Collection {
            expect($criteria->filters())->toHaveCount(1);
            return Collection::make();
        },
        'save' => function (Character $character) use ($source): void {
            expect($character->id->value())->toBe($source->id());
            expect($character->player->value())->toBe($source->player());
            expect($character->name->value())->toBe($source->name());
            expect($character->status())->toBe(Status::DRAFT);
            expect($character->concept()->value())->toBe($source->id());
            expect($character->attributeSet()->value())->toBe($source->id());
            expect($character->abilitySet()->value())->toBe($source->id());
            expect($character->advantageSet()->value())->toBe($source->id());
            expect($character->vitalState())->toBeNull();
        }
    ]));
    $creator->create($source);
});

test('CharacterCreator should throw exception if amount of characters exceeded.', function () {
    $source = makeCharacterSource();

    $creator = new CharacterCreator(makeCharacterRepository([
        'match' => function (Criteria $criteria) use ($source): Collection {
            expect($criteria->filters())->toHaveCount(1);
            return Collection::make([Character::fromSource($source)]);
        },
    ]));
    $creator->create($source);
})->throws(CharacterAmountExceeded::class);

test('CharacterCreator should throw exception if invalid section reference is used.', function () {
    $source = makeCharacterSource([
            'sections' => [Sections::VITAL_STATE => faker()->uuid()]
        ]
    );
    $creator = new CharacterCreator(makeCharacterRepository([
        'match' => function (Criteria $criteria) use ($source): Collection {
            expect($criteria->filters())->toHaveCount(1);
            return Collection::make([]);
        },
    ]));
    $creator->create($source);
})->throws(CharacterSectionInvalidReference::class);
