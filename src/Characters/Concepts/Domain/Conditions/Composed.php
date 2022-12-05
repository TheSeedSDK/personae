<?php

declare(strict_types=1);

namespace TheSeed\Characters\Concepts\Domain\Conditions;

use TheSeed\Characters\Concepts\Domain\Condition;

use function Lambdish\Phunctional\reduce;

/**
 * Class Composed
 *
 * @author Unay Santisteban <usantisteban@othercode.es>
 * @package TheSeed\Characters\Concepts\Domain\Conditions
 */
final class Composed extends Condition
{
    /**
     * List of conditions.
     *
     * @var Condition[]
     */
    private array $conditions;

    /**
     * Composed constructor.
     *
     * @param  Condition  ...$conditions
     */
    public function __construct(Condition ...$conditions)
    {
        $this->conditions = $conditions;
    }

    public function strengths(): array
    {
        return reduce(
            fn(array $strengths, Condition $condition): array => array_merge(
                $strengths,
                $condition->strengths()
            ),
            $this->conditions,
            []
        );
    }

    public function weaknesses(): array
    {
        return reduce(
            fn(array $weaknesses, Condition $condition): array => array_merge(
                $weaknesses,
                $condition->weaknesses()
            ),
            $this->conditions,
            []
        );
    }
}
