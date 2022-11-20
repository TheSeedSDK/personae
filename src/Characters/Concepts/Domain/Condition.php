<?php

declare(strict_types=1);

namespace TheSeed\Characters\Concepts\Domain;

use Illuminate\Support\Collection;
use TheSeed\Characters\Concepts\Domain\Conditions\Composed;

use TheSeed\Characters\Concepts\Domain\Conditions\Cyborg;

use TheSeed\Characters\Concepts\Domain\Conditions\Ghoul;

use TheSeed\Characters\Concepts\Domain\Conditions\Magi;

use TheSeed\Characters\Concepts\Domain\Conditions\None;
use TheSeed\Characters\Concepts\Domain\Conditions\Undead;

use TheSeed\Characters\Concepts\Domain\Conditions\Vampire;

use TheSeed\Characters\Concepts\Domain\Conditions\Werewolf;

use TheSeed\Characters\Concepts\Domain\Conditions\Wraith;

use function Lambdish\Phunctional\first;
use function Lambdish\Phunctional\last;
use function Lambdish\Phunctional\map;

/**
 * Class Condition
 *
 * @author Unay Santisteban <usantisteban@othercode.es>
 * @package TheSeed\Characters\Concepts\Domain
 */
abstract class Condition
{
    protected array $strengths = [];

    protected array $weaknesses = [];

    public static function make(array $conditions): self
    {
        $make = function (string $condition): Condition {
            $condition = strtr(Composed::class, ['Composed' => ucfirst($condition)]);
            return new $condition();
        };

        $conditions = map($make, $conditions);

        return count($conditions) > 1
            ? new Composed(...$conditions)
            : first($conditions);
    }

    public static function all(): array
    {
        return map(fn(string $class): string => last(explode('\\', $class)), [
            Cyborg::class,
            Ghoul::class,
            Magi::class,
            Undead::class,
            Vampire::class,
            Werewolf::class,
            Wraith::class
        ]);
    }

    public function strengths(): array
    {
        return $this->strengths;
    }

    public function weaknesses(): array
    {
        return $this->weaknesses;
    }
}
