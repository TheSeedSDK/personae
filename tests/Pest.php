<?php

declare(strict_types=1);

use TheSeed\Characters\AttributeSets\Domain\Contracts\AttributeSetRepository;
use TheSeed\Characters\AttributeSets\Domain\Contracts\AttributeSetSource;
use TheSeed\Characters\Characters\Domain\Contracts\CharacterRepository;
use TheSeed\Characters\Characters\Domain\Contracts\CharacterSource;
use TheSeed\Characters\Concepts\Domain\Contracts\ConceptRepository;
use TheSeed\Characters\Concepts\Domain\Contracts\ConceptSource;

use TheSeed\Characters\Characters\Domain\Sections;

use function Lambdish\Phunctional\map;
use function Pest\Faker\faker;

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
|
| The closure you provide to your test functions is always bound to a specific PHPUnit test
| case class. By default, that class is "PHPUnit\Framework\TestCase". Of course, you may
| need to change it using the "uses()" function to bind a different classes or traits.
|
*/

uses(Tests\TestCase::class)->in('Feature');

/*
|--------------------------------------------------------------------------
| Expectations
|--------------------------------------------------------------------------
|
| When you're writing tests, you often need to check that values meet certain conditions. The
| "expect()" function gives you access to a set of "expectations" methods that you can use
| to assert different things. Of course, you may extend the Expectation API at any time.
|
*/

expect()->extend('toBeOne', function () {
    return $this->toBe(1);
});

/*
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| While Pest is very powerful out-of-the-box, you may have some testing code specific to your
| project that you don't want to repeat in every file. Here you can also expose helpers as
| global functions to help you to reduce the number of lines of code in your test files.
|
*/

/**
 * Create a new CharacterSource from an array.
 *
 * @param  array<string, mixed>  $data
 * @return CharacterSource
 */
function makeCharacterSource(array $data = []): CharacterSource
{
    return mock(CharacterSource::class)->expect(...map(function (mixed $value) {
        return fn() => $value;
    }, array_merge([
        'id' => $id = faker()->uuid(),
        'player' => faker()->uuid(),
        'name' => faker()->name(),
        'sections' => [
            Sections::CONCEPT => $id,
            Sections::ATTRIBUTE_SET => $id,
            Sections::ABILITY_SET => $id,
            Sections::ADVANTAGE_SET => $id,
        ]
    ], $data)));
}

/**
 * Create a fake Character repository using an array to hold
 * the required functions to be executed on each method.
 *
 * @param  array<string, Closure>  $operations
 * @return CharacterRepository
 */
function makeCharacterRepository(array $operations = []): CharacterRepository
{
    return mock(CharacterRepository::class)->expect(...$operations);
}

/**
 * Create a new ConceptSource from an array.
 *
 * @param  array<string, mixed>  $data
 * @return ConceptSource
 */
function makeConceptSource(array $data = []): ConceptSource
{
    return mock(ConceptSource::class)->expect(...map(function (mixed $value) {
        return fn() => $value;
    }, array_merge([
        'id' => faker()->uuid(),
        'race' => 'human',
        'condition' => ['none'],
        'demeanor' => 'Some demeanor.',
        'nature' => 'Some nature',
        'motivation' => 'Some motivation.',
    ], $data)));
}

/**
 * Create a fake Concept repository using an array to hold
 * the required functions to be executed on each method.
 *
 * @param  array<string, Closure>  $operations
 * @return ConceptRepository
 */
function makeConceptRepository(array $operations = []): ConceptRepository
{
    return mock(ConceptRepository::class)->expect(...$operations);
}

/**
 * Create a new AttributeSetSource from an array.
 *
 * @param  array<string, mixed>  $data
 * @return AttributeSetSource
 */
function makeAttributeSetSource(array $data = []): AttributeSetSource
{
    return mock(AttributeSetSource::class)->expect(...map(function (mixed $value) {
        return fn() => $value;
    }, array_merge([
        'id' => faker()->uuid(),
        'physicalStrength' => faker()->numberBetween(1, 5),
        'physicalAgility' => faker()->numberBetween(1, 5),
        'physicalEndurance' => faker()->numberBetween(1, 5),
        'socialCharisma' => faker()->numberBetween(1, 5),
        'socialManipulation' => faker()->numberBetween(1, 5),
        'socialAppearance' => faker()->numberBetween(1, 5),
        'mentalPerception' => faker()->numberBetween(1, 5),
        'mentalIntelligence' => faker()->numberBetween(1, 5),
        'mentalWits' => faker()->numberBetween(1, 5),
    ], $data)));
}

/**
 * Create a fake AttributeSet repository using an array to hold
 * the required functions to be executed on each method.
 *
 * @param  array  $operations
 * @return AttributeSetRepository
 */
function makeAttributeSetRepository(array $operations = []): AttributeSetRepository
{
    return mock(AttributeSetRepository::class)->expect(...$operations);
}
