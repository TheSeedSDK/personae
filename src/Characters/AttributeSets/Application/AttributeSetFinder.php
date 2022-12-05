<?php

declare(strict_types=1);

namespace TheSeed\Characters\AttributeSets\Application;

use ComplexHeart\Domain\Criteria\Criteria;
use Illuminate\Support\Collection;
use TheSeed\Characters\AttributeSets\Domain\AttributeSet;
use TheSeed\Characters\AttributeSets\Domain\Contracts\AttributeSetRepository;
use TheSeed\Characters\AttributeSets\Domain\Exceptions\AttributeSetException;
use TheSeed\Characters\AttributeSets\Domain\Exceptions\AttributeSetNotFound;
use TheSeed\Shared\Domain\Models\Id;

/**
 * Class AttributeSetFinder
 *
 * @author Unay Santisteban <usantisteban@othercode.es>
 * @package TheSeed\Characters\AttributeSets\Application
 */
final class AttributeSetFinder
{
    private AttributeSetRepository $repository;

    /**
     * Class constructor.
     *
     * @param  AttributeSetRepository  $repository
     */
    public function __construct(AttributeSetRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Finds a AttributeSet by unique id.
     *
     * @param  Id  $id
     * @return AttributeSet
     * @throws AttributeSetNotFound
     */
    public function byId(Id $id): AttributeSet
    {
        $attributeSet = $this->repository->find($id);

        if (is_null($attributeSet)) {
            throw AttributeSetException::notFound($id);
        }

        return $attributeSet;
    }

    /**
     * Match AttributeSets by Criteria.
     *
     * @param  Criteria  $criteria
     * @return Collection
     */
    public function byCriteria(Criteria $criteria): Collection
    {
        return $this->repository->match($criteria);
    }
}
