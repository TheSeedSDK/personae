<?php

declare(strict_types=1);

namespace TheSeed\Characters\Characters\Application;

use ComplexHeart\Domain\Criteria\Criteria;
use TheSeed\Characters\Characters\Domain\Character;
use TheSeed\Characters\Characters\Domain\Contracts\CharacterRepository;
use TheSeed\Characters\Characters\Domain\Contracts\CharacterSource;
use TheSeed\Characters\Characters\Domain\Exceptions\CharacterAmountExceeded;
use TheSeed\Characters\Characters\Domain\Exceptions\CharacterException;

/**
 * Class CharacterCreator
 *
 * @author Unay Santisteban <usantisteban@othercode.es>
 * @package TheSeed\Characters\Characters\Application
 */
final class CharacterCreator
{
    private int $maximum;

    private CharacterRepository $repository;

    /**
     * Class constructor.
     *
     * @param  CharacterRepository  $repository
     * @param  int  $maximum
     */
    public function __construct(CharacterRepository $repository, int $maximum = 1)
    {
        $this->maximum = $maximum;
        $this->repository = $repository;
    }

    /**
     * Create new characters.
     *
     * @param  CharacterSource  $source
     * @return Character
     * @throws CharacterAmountExceeded
     */
    public function create(CharacterSource $source): Character
    {
        $criteria = Criteria::createDefault()
            ->addFilterEqual('player', $source->player());

        $current = $this->repository->match($criteria);
        if ($current->count() >= $this->maximum) {
            throw CharacterException::amountExceeded($current->count());
        }

        $aggregate = Character::fromSource($source);
        $this->repository->save($aggregate);

        return $aggregate;
    }
}
