<?php

declare(strict_types=1);

namespace TheSeed\Characters\Concepts\Domain\Conditions;

use TheSeed\Characters\Concepts\Domain\Condition;

/**
 * Class None
 *
 * @author Unay Santisteban <usantisteban@othercode.es>
 * @package TheSeed\Characters\Concepts\Domain\Conditions
 */
final class None extends Condition
{
    protected array $strengths = [];

    protected array $weaknesses = [];
}
