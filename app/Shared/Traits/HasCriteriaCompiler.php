<?php

declare(strict_types=1);

namespace App\Shared\Traits;

use ComplexHeart\Domain\Criteria\Criteria;
use Illuminate\Http\Request;

/**
 * Trait HasCriteriaCompiler
 *
 * @author Unay Santisteban <usantisteban@othercode.es>
 * @package App\Shared\Traits
 */
trait HasCriteriaCompiler
{
    public function compileCriteria(Request $request): Criteria
    {
        $criteria = Criteria::createDefault();
        foreach ($request->query() as $param => $value) {
            $criteria = match ($param) {
                'order' => $criteria->withOrderBy($value)->withOrderType('asc'),
                'limit' => $criteria->withPageLimit((int) $value),
                'offset' => $criteria->withPageOffset((int) $value),
                default => $criteria->addFilterEqual($param, $value),
            };
        }
        return $criteria;
    }
}
