<?php

declare(strict_types=1);

use TheSeed\Characters\Characters\Application\CharacterDeleter;
use TheSeed\Characters\Characters\Domain\Character;
use TheSeed\Shared\Domain\Models\Id;

use function Pest\Faker\faker;

test('CharacterDelete should delete the given character.', function () {
    $deleter = new CharacterDeleter(makeCharacterRepository([
        'delete' => function (Character|Id $character): void {
            // delete the character.
        }
    ]));
    $deleter->delete(new Id(faker()->uuid()));
});
