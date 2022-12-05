<?php

declare(strict_types=1);

namespace TheSeed\Characters\Characters\Domain\Exceptions;

use Exception;
use TheSeed\Shared\Domain\Models\Id;

/**
 * Class CharacterException
 *
 * @author Unay Santisteban <usantisteban@othercode.es>
 * @package TheSeed\Characters\Characters\Domain\Exceptions
 */
class CharacterException extends Exception
{
    public static function notFound(Id $id): CharacterNotFound
    {
        return new CharacterNotFound("Character with Id $id not found.");
    }

    public static function amountExceeded(int $amount): CharacterAmountExceeded
    {
        return new CharacterAmountExceeded("The number of allowed characters $amount has been exceeded.");
    }

    public static function sectionInvalidReference(
        Id $character,
        string $section,
        Id $reference
    ): CharacterSectionInvalidReference {
        return new CharacterSectionInvalidReference(
            "Invalid section reference $section $reference for character $character."
        );
    }
}
