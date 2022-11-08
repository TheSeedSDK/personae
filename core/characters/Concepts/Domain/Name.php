<?php

declare(strict_types=1);

namespace TheSeed\Characters\Concepts\Domain;

use InvalidArgumentException;

/**
 * Class Name
 *
 * @author Unay Santisteban <usantisteban@othercode.es>
 * @package TheSeed\Characters\Concepts
 */
final class Name
{
    /**
     * The name value.
     *
     * @var string
     */
    protected string $name;

    /**
     * Name max length.
     *
     * @var int
     */
    private int $maxLength = 64;

    /**
     * Name min length.
     *
     * @var int
     */
    private int $minLength = 3;

    /**
     * Name constructor.
     *
     * @param  string  $name
     */
    public function __construct(string $name)
    {
        $length = strlen($name);

        if ($length > $this->maxLength) {
            throw new InvalidArgumentException("The max length of the name must be 64 characters.");
        }

        if ($length < $this->minLength) {
            throw new InvalidArgumentException("The min length of the name must be 3 characters.");
        }

        $this->name = $name;
    }

    /**
     * Return the name value.
     *
     * @return string
     */
    public function value(): string
    {
        return $this->name;
    }

    /**
     * Return the name value as string.
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->value();
    }
}
