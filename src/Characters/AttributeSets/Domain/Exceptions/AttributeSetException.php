<?php

declare(strict_types=1);

namespace TheSeed\Characters\AttributeSets\Domain\Exceptions;

use Exception;
use TheSeed\Shared\Domain\Models\Id;

/**
 * Class AttributeSetException
 *
 * @author Unay Santisteban <usantisteban@othercode.es>
 * @package TheSeed\Characters\AttributeSets\Domain\Exceptions
 */
class AttributeSetException extends Exception
{
    public static function notFound(Id $id): AttributeSetNotFound
    {
        return new AttributeSetNotFound("AttributeSet with Id $id not found.");
    }

    public static function alreadyExists(Id $id): AttributeSetAlreadyExists
    {
        return new AttributeSetAlreadyExists("AttributeSet $id already exists.");
    }
}
