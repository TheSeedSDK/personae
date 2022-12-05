<?php

declare(strict_types=1);

namespace TheSeed\Characters\Characters\Domain\Contracts;

/**
 * Interface CharacterSource
 *
 * @author Unay Santisteban <usantisteban@othercode.es>
 * @package TheSeed\Characters\Characters\Domain\Contracts
 */
interface CharacterSource
{
    /**
     * Provide the unique uuid that identifies the character
     * across the system.
     *
     * @return string
     */
    public function id(): string;

    /**
     * Provide the unique user uuid that owns the character.
     *
     * @return string
     */
    public function player(): string;

    /**
     * Provide the character name.
     *
     * @return string
     */
    public function name(): string;

    /**
     * Provide the list of sections reference. Each section is
     * one of the main concepts that compose a character, the
     * reference is the unique id of the associated section,
     * that must be the same id as the character.
     *
     * return [
     *  'concept' => '<unique-uuid>'
     *  'attributeSet' => '<unique-uuid>'
     *  'abilitySet' => '<unique-uuid>'
     *  'advantageSet' => '<unique-uuid>'
     *  'vitalState' => '<unique-uuid>'
     * ]
     *
     * @return array<string, string>
     */
    public function sections(): array;
}
