<?php

declare(strict_types=1);

namespace TheSeed\Characters\Concepts\Application;

use ComplexHeart\Domain\Criteria\Criteria;
use Illuminate\Support\Collection;
use TheSeed\Characters\Concepts\Domain\Concept;
use TheSeed\Characters\Concepts\Domain\Contracts\ConceptRepository;
use TheSeed\Characters\Concepts\Domain\Exceptions\ConceptException;
use TheSeed\Characters\Concepts\Domain\Exceptions\ConceptNotFound;
use TheSeed\Shared\Domain\Models\Id;

/**
 * Class ConceptFinder
 *
 * @author Unay Santisteban <usantisteban@othercode.es>
 * @package TheSeed\Characters\Concepts\Application
 */
final class ConceptFinder
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
     * Find a Concept by unique Id.
     *
     * @param  Id  $id
     * @return Concept
     * @throws ConceptNotFound
     */
    public function byId(Id $id): Concept
    {
        $concept = $this->repository->find($id);

        if (is_null($concept)) {
            throw ConceptException::notFound($id);
        }

        return $concept;
    }

    /**
     * Match Concepts by Criteria.
     *
     * @param  Criteria  $criteria
     * @return Collection
     */
    public function byCriteria(Criteria $criteria): Collection
    {
        return $this->repository->match($criteria);
    }
}
