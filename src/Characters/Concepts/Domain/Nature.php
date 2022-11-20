<?php

declare(strict_types=1);

namespace TheSeed\Characters\Concepts\Domain;

/**
 * Class Nature
 *
 * @author Unay Santisteban <usantisteban@othercode.es>
 * @package TheSeed\Characters\Concepts\Domain
 */
final class Nature
{
    private string $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    public function value(): string
    {
        return $this->value;
    }
}
