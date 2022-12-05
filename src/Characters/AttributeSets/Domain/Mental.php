<?php

declare(strict_types=1);

namespace TheSeed\Characters\AttributeSets\Domain;

/**
 * Class Mental
 *
 * @author Unay Santisteban <usantisteban@othercode.es>
 * @package TheSeed\Characters\AttributeSets\Domain
 */
final class Mental
{
    public readonly Attribute $perception;

    public readonly Attribute $intelligence;

    public readonly Attribute $wits;

    /**
     * Class constructor
     *
     * @param  Attribute  $perception
     * @param  Attribute  $intelligence
     * @param  Attribute  $wits
     */
    public function __construct(Attribute $perception, Attribute $intelligence, Attribute $wits)
    {
        $this->perception = $perception;
        $this->intelligence = $intelligence;
        $this->wits = $wits;
    }
}
