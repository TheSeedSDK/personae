<?php

declare(strict_types=1);

namespace Tests\Unit\Concepts;

use ComplexHeart\Domain\Criteria\Criteria;
use Illuminate\Support\Collection;

use TheSeed\Characters\Concepts\Application\ConceptFinder;
use TheSeed\Characters\Concepts\Domain\Concept;
use TheSeed\Characters\Concepts\Domain\Exceptions\ConceptNotFound;
use TheSeed\Shared\Domain\Models\Id;

use function Pest\Faker\faker;

test('ConceptFinder should find concept by Id.', function () {
    $source = makeConceptSource();

    $finder = new ConceptFinder(makeConceptRepository([
        'find' => function (Id $id) use ($source): ?Concept {
            expect($id->value())->toBe($source->id());
            return Concept::fromSource($source);
        }
    ]));
    $concept = $finder->byId(new Id($source->id()));

    expect($concept)->toBeInstanceOf(Concept::class);
});

test('ConceptFinder should throw not found exception for non-existent concept.', function () {
    $finder = new ConceptFinder(makeConceptRepository([
        'find' => fn(Id $id): ?Concept => null
    ]));
    $finder->byId(new Id(faker()->uuid()));
})->throws(ConceptNotFound::class);

test('ConceptFinder should match given criteria', function () {
    $finder = new ConceptFinder(makeConceptRepository([
        'match' => function (Criteria $criteria): Collection {
            return Collection::make();
        }
    ]));
    $concepts = $finder->byCriteria(Criteria::createDefault());

    expect($concepts)->toHaveCount(0);
});
