<?php

declare(strict_types=1);

namespace TheSeed\Characters\AttributeSets\Domain\Contracts;

/**
 * Interface AttributeSetSource
 *
 * @author Unay Santisteban <usantisteban@othercode.es>
 * @package TheSeed\Characters\AttributeSets\Domain\Contracts
 */
interface AttributeSetSource
{
    /**
     * Provide the unique uuid that identifies the character
     * across the system.
     *
     * @return string
     */
    public function id(): string;

    /**
     * Provides the value for physical strength attribute.
     *
     * @return int
     */
    public function physicalStrength(): int;

    /**
     * Provides the value for physical agility attribute.
     *
     * @return int
     */
    public function physicalAgility(): int;

    /**
     * Provides the value for physical endurance attribute.
     *
     * @return int
     */
    public function physicalEndurance(): int;

    /**
     * Provides the value for social charisma attribute.
     *
     * @return int
     */
    public function socialCharisma(): int;

    /**
     * Provides the value for social manipulation attribute.
     *
     * @return int
     */
    public function socialManipulation(): int;

    /**
     * Provides the value for social appearance attribute.
     *
     * @return int
     */
    public function socialAppearance(): int;

    /**
     * Provides the value for mental perception attribute.
     *
     * @return int
     */
    public function mentalPerception(): int;

    /**
     * Provides the value for mental intelligence attribute.
     *
     * @return int
     */
    public function mentalIntelligence(): int;

    /**
     * Provides the value for mental wits attribute.
     *
     * @return int
     */
    public function mentalWits(): int;
}
