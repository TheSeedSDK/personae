<?php

declare(strict_types=1);

namespace TheSeed\Characters\AttributeSets\Application;

use ComplexHeart\Domain\Criteria\Criteria;
use TheSeed\Characters\AttributeSets\Domain\AttributeSet;
use TheSeed\Characters\AttributeSets\Domain\Contracts\AttributeSetRepository;
use TheSeed\Characters\AttributeSets\Domain\Contracts\AttributeSetSource;
use TheSeed\Characters\AttributeSets\Domain\Exceptions\AttributeSetAlreadyExists;
use TheSeed\Characters\AttributeSets\Domain\Exceptions\AttributeSetException;
use TheSeed\Shared\Domain\Models\Id;

/**
 * Class AttributeSetCreator
 *
 * @author Unay Santisteban <usantisteban@othercode.es>
 * @package TheSeed\Characters\AttributeSets\Application
 */
final class AttributeSetCreator
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
     * Create new AttributeSet
     *
     * @param  AttributeSetSource  $source
     * @return AttributeSet
     * @throws AttributeSetAlreadyExists
     */
    public function create(AttributeSetSource $source): AttributeSet
    {
        $criteria = Criteria::createDefault()
            ->addFilterEqual('id', $source->id());

        $current = $this->repository->match($criteria);
        if ($current->count() >= 1) {
            throw AttributeSetException::alreadyExists(new Id($source->id()));
        }

        $aggregate = AttributeSet::fromSource($source);
        $this->repository->save($aggregate);

        return $aggregate;
    }
}
