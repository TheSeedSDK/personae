<?php

namespace TheSeed\Characters\Concepts\Domain\Races;

use TheSeed\Characters\Concepts\Domain\Domain;
use TheSeed\Characters\Concepts\Domain\Kingdom;
use TheSeed\Characters\Concepts\Domain\Morphology;
use TheSeed\Characters\Concepts\Domain\Race;

/**
 * Class Gnome
 *
 * @author Unay Santisteban <usantisteban@othercode.es>
 * @package TheSeed\Characters\Concepts\Domain\Races
 */
class Gnome extends Race
{
    protected Domain $domain = Domain::ORGANIC;

    protected Kingdom $kingdom = Kingdom::ANIMAL;

    protected Morphology $morphology = Morphology::HUMANOID;
}
