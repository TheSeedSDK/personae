<?php

declare(strict_types=1);

namespace TheSeed\Characters\Concepts\Domain;

use TheSeed\Characters\Concepts\Domain\Races\Dwarf;
use TheSeed\Characters\Concepts\Domain\Races\Elf;
use TheSeed\Characters\Concepts\Domain\Races\Gnome;
use TheSeed\Characters\Concepts\Domain\Races\HalfElf;
use TheSeed\Characters\Concepts\Domain\Races\Halfling;
use TheSeed\Characters\Concepts\Domain\Races\HalfOrc;
use TheSeed\Characters\Concepts\Domain\Races\Human;
use TheSeed\Characters\Concepts\Domain\Races\Orc;

use function Lambdish\Phunctional\map;

/**
 * Class Race
 *
 * @author Unay Santisteban <usantisteban@othercode.es>
 * @package TheSeed\Characters\Concepts\Domain
 */
abstract class Race
{
    protected Domain $domain;

    protected Kingdom $kingdom;

    protected Morphology $morphology;

    protected array $passive = [];

    protected array $modifiers = [];

    public static function make(string $race): self
    {
        $race = strtr(Human::class, ['Human' => ucfirst($race)]);
        return new $race();
    }

    public static function all(): array
    {
        return map(fn(string $class): string => last(explode('\\', $class)), [
            Dwarf::class,
            Elf::class,
            Gnome::class,
            HalfElf::class,
            Halfling::class,
            HalfOrc::class,
            Human::class,
            Orc::class
        ]);
    }

    public function domain(): Domain
    {
        return $this->domain;
    }

    public function kingdom(): Kingdom
    {
        return $this->kingdom;
    }

    public function morphology(): Morphology
    {
        return $this->morphology;
    }
}
