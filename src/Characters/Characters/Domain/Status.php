<?php

declare(strict_types=1);

namespace TheSeed\Characters\Characters\Domain;


/**
 * Enum Status
 *
 * @author Unay Santisteban <usantisteban@othercode.es>
 * @package TheSeed\Characters\Characters\Domain
 */
enum Status: string
{
    case DRAFT = 'draft';
    case READY = 'ready';
}
