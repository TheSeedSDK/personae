<?php

declare(strict_types=1);

namespace TheSeed\Characters\Concepts\Domain;

/**
 * Class Morphology
 *
 * @author Unay Santisteban <usantisteban@othercode.es>
 * @package TheSeed\Characters\Concepts\Domain
 */
enum Morphology: string
{
    case UNDEFINED = 'undefined';
    case ABERRATION = 'aberration';
    case HUMANOID = 'humanoid';
    case BEAST = 'beast';
}
