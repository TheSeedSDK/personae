<?php

declare(strict_types=1);

namespace TheSeed\Characters\Concepts\Domain;

use ComplexHeart\Domain\Model\ValueObjects\EnumValue;

/**
 * Class Sex
 *
 * @author Unay Santisteban <usantisteban@othercode.es>
 * @package TheSeed\Characters\Concepts
 */
final class Gender extends EnumValue
{
    public const MALE = 'male';
    public const FEMALE = 'female';
}
