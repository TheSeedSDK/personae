<?php

declare(strict_types=1);

namespace TheSeed\Characters\Concepts\Domain;

/**
 * Class Domain
 *
 * @author Unay Santisteban <usantisteban@othercode.es>
 * @package TheSeed\Characters\Concepts\Domain
 */
enum Domain: string
{
    case UNDEFINED = 'undefined';
    case SPIRIT = 'spirit';
    case ORGANIC = 'organic';
    case INORGANIC = 'inorganic';
}
