<?php

declare(strict_types=1);

namespace TheSeed\Characters\Concepts\Domain;

use ComplexHeart\Domain\Model\ValueObjects\DateTimeValue;
use Exception;
use TheSeed\Characters\Concepts\Domain\Contracts\ConceptSource;
use TheSeed\Shared\Domain\Models\Id;

/**
 * Class Concept
 *
 * @author Unay Santisteban <usantisteban@othercode.es>
 * @package TheSeed\Characters\Concepts
 */
final class Concept
{
    private Id $id;

    private Name $name;

    private Gender $gender;

    private DateTimeValue $dateOfBirth;

    private Demeanor $demeanor;

    private Nature $nature;

    private Motivation $motivation;

    public function __construct(
        Id $id,
        Name $name,
        Gender $gender,
        DateTimeValue $dateOfBirth,
        Demeanor $demeanor,
        Nature $nature,
        Motivation $motivation,
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->gender = $gender;
        $this->dateOfBirth = $dateOfBirth;
        $this->demeanor = $demeanor;
        $this->nature = $nature;
        $this->motivation = $motivation;
    }

    /**
     * @throws Exception
     */
    public static function fromSource(ConceptSource $source): self
    {
        return new self(
            new Id($source->id()),
            new Name($source->name()),
            new Gender($source->gender()),
            new DateTimeValue($source->dateOfBirth()),
            new Demeanor($source->demeanor()),
            new Nature($source->nature()),
            new Motivation($source->motivation()),
        );
    }

    public function id(): Id
    {
        return $this->id;
    }

    public function name(): Name
    {
        return $this->name;
    }

    public function gender(): Gender
    {
        return $this->gender;
    }

    public function dateOfBirth(): DateTimeValue
    {
        return $this->dateOfBirth;
    }

    public function demeanor(): Demeanor
    {
        return $this->demeanor;
    }

    public function nature(): Nature
    {
        return $this->nature;
    }

    public function motivation(): Motivation
    {
        return $this->motivation;
    }
}
