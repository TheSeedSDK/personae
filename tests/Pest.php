<?php

declare(strict_types=1);

use TheSeed\Characters\Characters\Domain\Contracts\CharacterRepository;
use TheSeed\Characters\Characters\Domain\Contracts\CharacterSource;

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
