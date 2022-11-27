<?php

declare(strict_types=1);

namespace TheSeed\Shared\Domain;

use TheSeed\Shared\Domain\Exceptions\TraitValueException;

/**
 * Class DefaultTrait
 *
 * @author Unay Santisteban <usantisteban@othercode.es>
 * @package TheSeed\Shared\Domain
 */
class TraitValue
{
    /**
     * The Trait value.
     *
     * @var int
     */
    public readonly int $value;

    /**
     * The max value of the attribute.
     *
     * @var int
     */
    protected int $max = 10;

    /**
     * The min value of the attribute.
     *
     * @var int
     */
    protected int $min = 0;

    /**
     * Class constructor.
     *
     * @param  int  $value
     * @throws TraitValueException
     */
    public function __construct(int $value = 0)
    {
        if ($value > $this->max) {
            throw new TraitValueException("The max value of a trait is {$this->max}.");
        }

        if ($value < $this->min) {
            throw new TraitValueException("The min value of a trait is {$this->min}.");
        }

        $this->value = $value;
    }

    /**
     * Makes a new TraitValue
     *
     * @param  int  $value
     * @return static
     * @throws TraitValueException
     */
    public static function make(int $value = 0): self
    {
        return new self($value);
    }

    /**
     * Evaluate if the given Attribute is equal as the instance.
     *
     * @param  TraitValue  $attribute
     * @return bool
     */
    public function equals(TraitValue $attribute): bool
    {
        return $this->value === $attribute->value;
    }

    /**
     * Return the Attribute as string.
     *
     * @return string
     */
    public function __toString(): string
    {
        return (string) $this->value;
    }
}
