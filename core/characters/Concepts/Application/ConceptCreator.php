<?php

declare(strict_types=1);

namespace TheSeed\Characters\Concepts\Application;

use TheSeed\Characters\Concepts\Domain\Concept;
use TheSeed\Characters\Concepts\Domain\Contracts\ConceptRepository;
use TheSeed\Characters\Concepts\Domain\Contracts\ConceptSource;

final class ConceptCreator
{
    private ConceptRepository $repository;

    public function __construct(ConceptRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create(ConceptSource $source): Concept
    {
        $aggregate = Concept::fromSource($source);

        $this->repository->save($aggregate);

        return $aggregate;
    }
}
