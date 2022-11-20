<?php

declare(strict_types=1);

namespace TheSeed\Characters\Concepts\Domain;

use Exception;
use TheSeed\Characters\Concepts\Domain\Contracts\ConceptSource;
use TheSeed\Shared\Domain\Models\Id;

/**
 * Class Concept
 *
 * @author Unay Santisteban <usantisteban@othercode.es>
 * @package TheSeed\Characters\Concepts\Domain
 */
final class Concept
{
    public readonly Id $id;

    public readonly Race $race;

    public readonly Condition $condition;

    public readonly Demeanor $demeanor;

    public readonly Nature $nature;

    public readonly Motivation $motivation;

    /**
     * Class constructor.
     *
     * @param  Id  $id
     * @param  Race  $race
     * @param  Condition  $condition
     * @param  Demeanor  $demeanor
     * @param  Nature  $nature
     * @param  Motivation  $motivation
     */
    public function __construct(
        Id $id,
        Race $race,
        Condition $condition,
        Demeanor $demeanor,
        Nature $nature,
        Motivation $motivation,
    ) {
        $this->id = $id;
        $this->race = $race;
        $this->condition = $condition;
        $this->demeanor = $demeanor;
        $this->nature = $nature;
        $this->motivation = $motivation;
    }

    /**
     * Create a new instance of the model from source.
     *
     * @param  ConceptSource  $source
     * @return static
     * @throws Exception
     */
    public static function fromSource(ConceptSource $source): self
    {
        return new self(
            new Id($source->id()),
            Race::make($source->race()),
            Condition::make($source->condition()),
            new Demeanor($source->demeanor()),
            new Nature($source->nature()),
            new Motivation($source->motivation()),
        );
    }
}
