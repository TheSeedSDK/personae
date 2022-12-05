<?php

declare(strict_types=1);

namespace TheSeed\Characters\AttributeSets\Domain;

/**
 * Class Physical
 *
 * @author Unay Santisteban <usantisteban@othercode.es>
 * @package TheSeed\Characters\AttributeSets\Domain
 */
final class Physical
{
    public readonly Attribute $strength;

    public readonly Attribute $agility;

    public readonly Attribute $endurance;

    /**
     * Class constructor.
     *
     * @param  Attribute  $strength
     * @param  Attribute  $agility
     * @param  Attribute  $endurance
     */
    public function __construct(Attribute $strength, Attribute $agility, Attribute $endurance)
    {
        $this->strength = $strength;
        $this->agility = $agility;
        $this->endurance = $endurance;
    }
}
