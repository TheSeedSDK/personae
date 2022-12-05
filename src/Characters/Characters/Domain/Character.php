<?php

declare(strict_types=1);

namespace TheSeed\Characters\Characters\Domain;

use TheSeed\Characters\Characters\Domain\Contracts\CharacterSource;
use TheSeed\Characters\Characters\Domain\Exceptions\CharacterSectionInvalidReference;
use TheSeed\Shared\Domain\Models\Id;

use function Lambdish\Phunctional\map;

/**
 * Class Character
 *
 * @author Unay Santisteban <usantisteban@othercode.es>
 * @package TheSeed\Characters\Characters\Domain
 */
final class Character
{
    public readonly Id $id;

    public readonly Id $player;

    public readonly Name $name;

    private readonly Sections $sections;

    /**
     * Class constructor.
     *
     * @param  Id  $id
     * @param  Id  $player
     * @param  Name  $name
     * @param  Sections  $sections
     */
    public function __construct(Id $id, Id $player, Name $name, Sections $sections)
    {
        $this->id = $id;
        $this->player = $player;
        $this->name = $name;
        $this->sections = $sections;
    }

    /**
     * Create a new instance of the model from source.
     *
     * @param  CharacterSource  $source
     * @return static
     * @throws CharacterSectionInvalidReference
     */
    public static function fromSource(CharacterSource $source): self
    {
        return new self(
            $id = new Id($source->id()),
            new Id($source->player()),
            new Name($source->name()),
            new Sections($id, map(fn(string $section): Id => new Id($section), $source->sections()))
        );
    }

    public function status(): Status
    {
        return count($this->sections->missing()) > 0
            ? Status::DRAFT
            : Status::READY;
    }

    public function concept(): ?Id
    {
        return $this->sections->concept;
    }

    public function attributeSet(): ?Id
    {
        return $this->sections->attributeSet;
    }

    public function abilitySet(): ?Id
    {
        return $this->sections->abilitySet;
    }

    public function advantageSet(): ?Id
    {
        return $this->sections->advantageSet;
    }

    public function vitalState(): ?Id
    {
        return $this->sections->vitalState;
    }

}
