<?php

declare(strict_types=1);

namespace TheSeed\Characters\Characters\Domain\Contracts;

use ComplexHeart\Domain\Criteria\Criteria;
use Illuminate\Support\Collection;
use TheSeed\Characters\Characters\Domain\Character;
use TheSeed\Shared\Domain\Models\Id;

/**
 * Interface CharacterRepository
 *
 * @author Unay Santisteban <usantisteban@othercode.es>
 * @package TheSeed\Characters\Characters\Domain\Contracts
 */
interface CharacterRepository
{
    public function find(Id $id): ?Character;

    public function save(Character $character): void;

    public function delete(Character|Id $character): void;

    public function match(Criteria $criteria): Collection;
}
