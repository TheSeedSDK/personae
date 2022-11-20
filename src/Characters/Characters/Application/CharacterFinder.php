<?php

declare(strict_types=1);

namespace TheSeed\Characters\Characters\Application;

use ComplexHeart\Domain\Criteria\Criteria;
use Illuminate\Support\Collection;
use TheSeed\Characters\Characters\Domain\Character;
use TheSeed\Characters\Characters\Domain\Contracts\CharacterRepository;
use TheSeed\Characters\Characters\Domain\Exceptions\CharacterException;
use TheSeed\Characters\Characters\Domain\Exceptions\CharacterNotFound;
use TheSeed\Shared\Domain\Models\Id;

/**
 * Class CharacterFinder
 *
 * @author Unay Santisteban <usantisteban@othercode.es>
 * @package TheSeed\Characters\Characters\Application
 */
final class CharacterFinder
{
    private CharacterRepository $repository;

    /**
     * Class constructor.
     *
     * @param  CharacterRepository  $repository
     */
    public function __construct(CharacterRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Find a Character by unique Id.
     *
     * @param  Id  $id
     * @return Character
     * @throws CharacterNotFound
     */
    public function byId(Id $id): Character
    {
        $character = $this->repository->find($id);

        if (is_null($character)) {
            throw CharacterException::notFound($id);
        }

        return $character;
    }

    /**
     * Match Characters by Criteria.
     *
     * @param  Criteria  $criteria
     * @return Collection
     */
    public function byCriteria(Criteria $criteria): Collection
    {
        return $this->repository->match($criteria);
    }
}
