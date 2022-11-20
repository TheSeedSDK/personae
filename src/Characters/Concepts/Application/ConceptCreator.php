<?php

declare(strict_types=1);

namespace TheSeed\Characters\Concepts\Application;

use ComplexHeart\Domain\Criteria\Criteria;
use TheSeed\Characters\Concepts\Domain\Concept;
use TheSeed\Characters\Concepts\Domain\Contracts\ConceptRepository;
use TheSeed\Characters\Concepts\Domain\Contracts\ConceptSource;
use TheSeed\Characters\Concepts\Domain\Exceptions\ConceptAlreadyExists;
use TheSeed\Characters\Concepts\Domain\Exceptions\ConceptException;
use TheSeed\Shared\Domain\Models\Id;

/**
 * Class ConceptCreator
 *
 * @author Unay Santisteban <usantisteban@othercode.es>
 * @package TheSeed\Characters\Concepts\Application
 */
final class ConceptCreator
{
    private ConceptRepository $repository;

    /**
     * Class constructor.
     *
     * @param  ConceptRepository  $repository
     */
    public function __construct(ConceptRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Create new Concepts.
     *
     * @throws ConceptAlreadyExists
     */
    public function create(ConceptSource $source): Concept
    {
        $criteria = Criteria::createDefault()
            ->addFilterEqual('id', $source->id());

        $current = $this->repository->match($criteria);
        if ($current->count() >= 1) {
            throw ConceptException::alreadyExists(new Id($source->id()));
        }

        $aggregate = Concept::fromSource($source);
        $this->repository->save($aggregate);

        return $aggregate;
    }
}
