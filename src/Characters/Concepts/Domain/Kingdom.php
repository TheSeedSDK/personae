<?php

declare(strict_types=1);

namespace TheSeed\Characters\Concepts\Domain;

/**
 * Class Kingdom
 *
 * @author Unay Santisteban <usantisteban@othercode.es>
 * @package TheSeed\Characters\Concepts\Domain
 */
enum Kingdom: string
{
    case FUNGI = 'fungi';
    case PLANT = 'plant';
    case ANIMAL = 'animal';
    case ANGEL = 'angel';
    case DEMON = 'demon';
    case CHANGELING = 'changeling';
    case SYNTHETIC = 'synthetic';
}
