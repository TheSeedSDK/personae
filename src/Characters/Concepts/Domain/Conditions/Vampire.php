<?php

declare(strict_types=1);

namespace TheSeed\Characters\Concepts\Domain\Conditions;

use TheSeed\Characters\Concepts\Domain\Condition;

/**
 * Class Vampire
 *
 * @author Unay Santisteban <usantisteban@othercode.es>
 * @package TheSeed\Characters\Concepts\Domain\Conditions
 */
final class Vampire extends Condition
{
    protected array $strengths = [];

    protected array $weaknesses = [];
}
