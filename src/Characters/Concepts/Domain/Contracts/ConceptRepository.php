<?php

declare(strict_types=1);

namespace TheSeed\Characters\Concepts\Domain\Contracts;

use ComplexHeart\Domain\Criteria\Criteria;
use Illuminate\Support\Collection;
use TheSeed\Characters\Concepts\Domain\Concept;
use TheSeed\Shared\Domain\Models\Id;

/**
 * Interface ConceptRepository
 *
 * @author Unay Santisteban <usantisteban@othercode.es>
 * @package TheSeed\Characters\Concepts\Domain\Contracts
 */
interface ConceptRepository
{
    public function find(Id $id): ?Concept;

    public function save(Concept $concept): void;

    public function delete(Concept|Id $character): void;

    public function match(Criteria $criteria): Collection;
}
