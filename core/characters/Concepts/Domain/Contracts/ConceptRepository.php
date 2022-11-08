<?php

declare(strict_types=1);

namespace TheSeed\Characters\Concepts\Domain\Contracts;

use TheSeed\Characters\Concepts\Domain\Concept;
use TheSeed\Shared\Domain\Models\Id;

interface ConceptRepository
{
    public function find(Id $id): ?Concept;

    public function save(Concept $concept): void;
}
