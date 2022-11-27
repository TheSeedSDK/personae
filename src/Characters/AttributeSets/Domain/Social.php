<?php

declare(strict_types=1);

namespace TheSeed\Characters\AttributeSets\Domain;

/**
 * Class Social
 *
 * @author Unay Santisteban <usantisteban@othercode.es>
 * @package TheSeed\Characters\AttributeSets\Domain
 */
final class Social
{
    public readonly Attribute $charisma;

    public readonly Attribute $manipulation;

    public readonly Attribute $appearance;

    /**
     * Class constructor
     *
     * @param  Attribute  $charisma
     * @param  Attribute  $manipulation
     * @param  Attribute  $appearance
     */
    public function __construct(Attribute $charisma, Attribute $manipulation, Attribute $appearance)
    {
        $this->charisma = $charisma;
        $this->manipulation = $manipulation;
        $this->appearance = $appearance;
    }
}
