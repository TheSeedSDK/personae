<?php

declare(strict_types=1);

namespace Tests\Unit\AttributeSets;

use ComplexHeart\Domain\Criteria\Criteria;
use Illuminate\Support\Collection;
use TheSeed\Characters\AttributeSets\Application\AttributeSetCreator;
use TheSeed\Characters\AttributeSets\Application\AttributeSetFinder;
use TheSeed\Characters\AttributeSets\Domain\AttributeSet;
use TheSeed\Characters\AttributeSets\Domain\Exceptions\AttributeSetAlreadyExists;
use TheSeed\Characters\AttributeSets\Domain\Exceptions\AttributeSetNotFound;
use TheSeed\Shared\Domain\Models\Id;

use function Pest\Faker\faker;

test('AttributeSetCreator should create (and persist) a AttributeSet.', function () {
    $source = makeAttributeSetSource();

    $creator = new AttributeSetCreator(makeAttributeSetRepository([
        'match' => function (Criteria $criteria): Collection {
            expect($criteria->filters())->toHaveCount(1);
            return Collection::make();
        },
        'save' => function (AttributeSet $attributeSet) use ($source): void {
            expect($attributeSet->id->value())->toBe($source->id());
            expect($attributeSet->strength->value)->toBe($source->physicalStrength());
            expect($attributeSet->agility->value)->toBe($source->physicalAgility());
            expect($attributeSet->endurance->value)->toBe($source->physicalEndurance());
            expect($attributeSet->charisma->value)->toBe($source->socialCharisma());
            expect($attributeSet->manipulation->value)->toBe($source->socialManipulation());
            expect($attributeSet->appearance->value)->toBe($source->socialAppearance());
            expect($attributeSet->perception->value)->toBe($source->mentalPerception());
            expect($attributeSet->intelligence->value)->toBe($source->mentalIntelligence());
            expect($attributeSet->wits->value)->toBe($source->mentalWits());
        }
    ]));
    $creator->create($source);
});

test('AttributeSetCreator should throw exception if AttributeSet for character already exists.', function () {
    $source = makeAttributeSetSource();

    $creator = new AttributeSetCreator(makeAttributeSetRepository([
        'match' => function (Criteria $criteria) use ($source): Collection {
            expect($criteria->filters())->toHaveCount(1);
            return Collection::make([AttributeSet::fromSource($source)]);
        },
    ]));
    $creator->create($source);
})->throws(AttributeSetAlreadyExists::class);

test('AttributeSetFinder should find AttributeSet by Id.', function () {
    $source = makeAttributeSetSource();

    $finder = new AttributeSetFinder(makeAttributeSetRepository([
        'find' => function (Id $id) use ($source): ?AttributeSet {
            expect($id->value())->toBe($source->id());
            return AttributeSet::fromSource($source);
        }
    ]));
    $attributeSet = $finder->byId(new Id($source->id()));

    expect($attributeSet)->toBeInstanceOf(AttributeSet::class);
});

test('AttributeSetFinder should throw not found exception for non-existent attribute set.', function () {
    $finder = new AttributeSetFinder(makeAttributeSetRepository([
        'find' => fn(Id $id): ?AttributeSet => null
    ]));
    $finder->byId(new Id(faker()->uuid()));
})->throws(AttributeSetNotFound::class);

test('AttributeSetFinder should return collection of AttributeSet matching collection.', function () {
    $finder = new AttributeSetFinder(makeAttributeSetRepository([
        'match' => fn(Criteria $criteria): Collection => new Collection([])
    ]));
    $collection = $finder->byCriteria(Criteria::createDefault());
    expect($collection)->toHaveCount(0);
});
