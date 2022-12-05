<?php

declare(strict_types=1);

namespace TheSeed\Characters\Concepts\Domain\Contracts;

/**
 * Interface ConceptSource
 *
 * @author Unay Santisteban <usantisteban@othercode.es>
 * @package TheSeed\Characters\Concepts\Domain\Contracts
 */
interface ConceptSource
{
    /**
     * Provide the unique uuid that identifies the character
     * across the system.
     *
     * @return string
     */
    public function id(): string;

    /**
     * Provide the race reference of the character.
     *
     * @return string
     */
    public function race(): string;

    /**
     * Provide the list of compatible conditions of the character.
     *
     * @return array<string>
     */
    public function condition(): array;

    /**
     * Provide the demeanor of the character. This is the
     * personality your character presents to the world.
     * More often than not, Nature and Demeanor are different.
     * @return string
     */
    public function demeanor(): string;

    /**
     * Provide the nature of the character, This is the
     * "true" personality of your character.
     *
     * @return string
     */
    public function nature(): string;

    /**
     * Provides the motivation of the character.
     *
     * @return string
     */
    public function motivation(): string;
}
