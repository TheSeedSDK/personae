<?php

declare(strict_types=1);

namespace TheSeed\Characters\Concepts\Domain\Exceptions;

use Exception;
use TheSeed\Shared\Domain\Models\Id;

/**
 * Class ConceptException
 *
 * @author Unay Santisteban <usantisteban@othercode.es>
 * @package TheSeed\Characters\Concepts\Domain\Exceptions
 */
class ConceptException extends Exception
{
    public static function alreadyExists(Id $id): ConceptAlreadyExists
    {
        return new ConceptAlreadyExists("Concept {$id} already exists.");
    }

    public static function notFound(Id $id): ConceptNotFound
    {
        return new ConceptNotFound("Concept with Id $id not found.");
    }

    public static function incompatibleGenotypes(array $genotypes): IncompatibleGenotypes
    {
        return new IncompatibleGenotypes(strtr('Incompatible genotypes {list} in composed genotype.', [
            '{list}' => join(', ', $genotypes)
        ]));
    }
}
