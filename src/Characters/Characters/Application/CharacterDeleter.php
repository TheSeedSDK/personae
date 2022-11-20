<?php

declare(strict_types=1);

namespace TheSeed\Characters\Characters\Application;

use TheSeed\Characters\Characters\Domain\Character;
use TheSeed\Characters\Characters\Domain\Contracts\CharacterRepository;
use TheSeed\Shared\Domain\Models\Id;

/**
 * Class CharacterDeleter
 *
 * @author Unay Santisteban <usantisteban@othercode.es>
 * @package TheSeed\Characters\Characters\Application
 */
final class CharacterDeleter
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
     * Deletes the given character by Id
     *
     * @param  Character|Id  $character
     * @return void
     */
    public function delete(Character|Id $character): void
    {
        $this->repository->delete($character);
    }
}
