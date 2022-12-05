<?php

declare(strict_types=1);

namespace TheSeed\Characters\AttributeSets\Domain\Contracts;

use ComplexHeart\Domain\Criteria\Criteria;
use Illuminate\Support\Collection;
use TheSeed\Characters\AttributeSets\Domain\AttributeSet;
use TheSeed\Shared\Domain\Models\Id;

/**
 * Interface AttributeSetRepository
 *
 * @author Unay Santisteban <usantisteban@othercode.es>
 * @package TheSeed\Characters\AttributeSets\Domain\Contracts
 */
interface AttributeSetRepository
{
    public function find(Id $id): ?AttributeSet;

    public function save(AttributeSet $attributeSet): void;

    public function delete(AttributeSet|Id $attributeSet): void;

    public function match(Criteria $criteria): Collection;
}
