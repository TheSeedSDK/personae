<?php

declare(strict_types=1);

namespace TheSeed\Characters\Characters\Domain;

use TheSeed\Characters\Characters\Domain\Exceptions\CharacterException;
use TheSeed\Characters\Characters\Domain\Exceptions\CharacterSectionInvalidReference;
use TheSeed\Shared\Domain\Models\Id;

/**
 * Class Sections
 *
 * Contains the references of each character sections.
 *
 * @property ?Id concept
 * @property ?Id attributeSet
 * @property ?Id abilitySet
 * @property ?Id advantageSet
 * @property ?Id vitalState
 *
 * @author Unay Santisteban <usantisteban@othercode.es>
 * @package TheSeed\Characters\Characters\Domain
 */
final class Sections
{
    public const CONCEPT = 'concept';
    public const ATTRIBUTE_SET = 'attributeSet';
    public const ABILITY_SET = 'abilitySet';
    public const ADVANTAGE_SET = 'advantageSet';
    public const VITAL_STATE = 'vitalState';

    private array $sections = [
        self::CONCEPT => null,
        self::ATTRIBUTE_SET => null,
        self::ABILITY_SET => null,
        self::ADVANTAGE_SET => null,
        self::VITAL_STATE => null,
    ];

    /**
     * Sections constructor.
     *
     * @param  array<string, Id>  $sections
     * @throws CharacterSectionInvalidReference
     */
    public function __construct(Id $id, array $sections)
    {
        foreach ($this->sections as $section => $value) {
            if (!isset($sections[$section])) {
                continue;
            }

            if (!$id->equals($sections[$section])) {
                throw CharacterException::sectionInvalidReference($id, $section, $sections[$section]);
            }

            $this->sections[$section] = $sections[$section];
        }
    }

    /**
     * Returns the missing sections.
     *
     * @return array<string>
     */
    public function missing(): array
    {
        $missing = [];
        foreach ($this->sections as $section => $value) {
            if (is_null($this->sections[$section])) {
                $missing[] = $section;
            }
        }

        return $missing;
    }

    /**
     * Magic getter, returns the request section if exists.
     *
     * @param  string  $section
     * @return Id|null
     */
    public function __get(string $section): ?Id
    {
        return array_key_exists($section, $this->sections)
            ? $this->sections[$section]
            : null;
    }
}
