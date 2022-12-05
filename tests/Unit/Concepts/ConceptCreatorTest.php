<?php

declare(strict_types=1);

namespace Tests\Unit\Concepts;

use ComplexHeart\Domain\Criteria\Criteria;
use Illuminate\Support\Collection;
use TheSeed\Characters\Concepts\Application\ConceptCreator;
use TheSeed\Characters\Concepts\Domain\Concept;
use TheSeed\Characters\Concepts\Domain\Condition;
use TheSeed\Characters\Concepts\Domain\Exceptions\ConceptAlreadyExists;
use TheSeed\Characters\Concepts\Domain\Race;

test('ConceptCreator should create (and persists) a Concept.', function () {
    $source = makeConceptSource();

    $creator = new ConceptCreator(makeConceptRepository([
        'match' => function (Criteria $criteria): Collection {
            expect($criteria->filters())->toHaveCount(1);
            return Collection::make();
        },
        'save' => function (Concept $concept) use ($source): void {
            expect($concept->id->value())->toBe($source->id());
            expect($concept->race)->toBeInstanceOf(Race::class);
            expect($concept->condition)->toBeInstanceOf(Condition::class);
            expect($concept->motivation->value())->toBe($source->motivation());
            expect($concept->nature->value())->toBe($source->nature());
            expect($concept->demeanor->value())->toBe($source->demeanor());
        }
    ]));
    $creator->create($source);
});

test('ConceptCreator should throw exception if concept for character already exists.', function () {
    $source = makeConceptSource();

    $creator = new ConceptCreator(makeConceptRepository([
        'match' => function (Criteria $criteria) use ($source): Collection {
            expect($criteria->filters())->toHaveCount(1);
            return Collection::make([Concept::fromSource($source)]);
        },
    ]));
    $creator->create($source);
})->throws(ConceptAlreadyExists::class);
