<?php

declare(strict_types=1);

namespace TheSeed\Characters\AttributeSets\Domain;

use TheSeed\Characters\AttributeSets\Domain\Contracts\AttributeSetSource;
use TheSeed\Shared\Domain\Models\Id;
use TheSeed\Shared\Domain\TraitValue;

use function Lambdish\Phunctional\map;

/**
 * Class AttributeSet
 *
 * @property TraitValue strength
 * @property TraitValue agility
 * @property TraitValue endurance
 * @property TraitValue charisma
 * @property TraitValue manipulation
 * @property TraitValue appearance
 * @property TraitValue perception
 * @property TraitValue intelligence
 * @property TraitValue wits
 *
 * @author Unay Santisteban <usantisteban@othercode.es>
 * @package TheSeed\Characters\AttributeSets\Domain
 */
final class AttributeSet
{
    public readonly Id $id;

    public readonly Physical $physical;

    public readonly Social $social;

    public readonly Mental $mental;

    /**
     * Class constructor.
     *
     * @param  Id  $id
     * @param  Physical  $physical
     * @param  Social  $social
     * @param  Mental  $mental
     */
    public function __construct(Id $id, Physical $physical, Social $social, Mental $mental)
    {
        $this->id = $id;
        $this->physical = $physical;
        $this->social = $social;
        $this->mental = $mental;
    }

    /**
     * Create a new instance of the AttributeSet from source.
     *
     * @param  AttributeSetSource  $source
     * @return static
     */
    public static function fromSource(AttributeSetSource $source): self
    {
        $attributes = fn(int $value = 0): Attribute => new Attribute($value);
        return new self(
            new Id($source->id()),
            new Physical(...map($attributes, [
                $source->physicalStrength(),
                $source->physicalAgility(),
                $source->physicalEndurance(),
            ])),
            new Social(...map($attributes, [
                $source->socialCharisma(),
                $source->socialManipulation(),
                $source->socialAppearance(),
            ])),
            new Mental(...map($attributes, [
                $source->mentalPerception(),
                $source->mentalIntelligence(),
                $source->mentalWits(),
            ])),
        );
    }

    /**
     * Returns the trait value if exists.
     *
     * @param  string  $trait
     * @return TraitValue|null
     */
    public function __get(string $trait): ?TraitValue
    {
        foreach ([$this->physical, $this->social, $this->mental] as $set) {
            if (property_exists($set, $trait)) {
                return $set->{$trait};
            }
        }

        return null;
    }

}
