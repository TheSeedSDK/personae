<?php

declare(strict_types=1);

use TheSeed\Characters\Concepts\Domain\Condition;
use TheSeed\Characters\Concepts\Domain\Conditions\Composed;
use TheSeed\Characters\Concepts\Domain\Conditions\Undead;
use TheSeed\Characters\Concepts\Domain\Domain;
use TheSeed\Characters\Concepts\Domain\Kingdom;
use TheSeed\Characters\Concepts\Domain\Morphology;
use TheSeed\Characters\Concepts\Domain\Race;
use TheSeed\Characters\Concepts\Domain\Races\Human;

test('Condition should return list of available conditions.', function () {
    expect(Condition::all())->toHaveCount(7);
});

test('Condition should instantiate single condition from array.', function () {
    $composed = Condition::make(['undead']);
    expect($composed)->toBeInstanceOf(Undead::class);
    expect($composed->strengths())->toHaveCount(0);
    expect($composed->weaknesses())->toHaveCount(0);
});

test('Condition should instantiate composed conditions from array.', function () {
    $composed = Condition::make(['undead', 'vampire']);
    expect($composed)->toBeInstanceOf(Composed::class);
    expect($composed->strengths())->toHaveCount(0);
    expect($composed->weaknesses())->toHaveCount(0);
});

test('Race should return list of available races.', function () {
    expect(Race::all())->toHaveCount(8);
});

test('Race should instantiate race from string.', function () {
    $race = Race::make('Human');

    expect($race)->toBeInstanceOf(Human::class);
    expect($race->domain())->toBeInstanceOf(Domain::class)->toBe(Domain::ORGANIC);
    expect($race->kingdom())->toBeInstanceOf(Kingdom::class)->toBe(Kingdom::ANIMAL);
    expect($race->morphology())->toBeInstanceOf(Morphology::class)->toBe(Morphology::HUMANOID);
});
