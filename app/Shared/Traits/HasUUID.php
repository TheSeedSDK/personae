<?php

declare(strict_types=1);

namespace App\Shared\Traits;

use Illuminate\Support\Str;

/**
 * Trait HasUUID
 *
 * @author Unay Santisteban <usantisteban@othercode.es>
 * @package App\Infrastructure\Laravel\Traits
 */
trait HasUUID
{
    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($model) {
            if ($model->getKey() === null) {
                $model->setAttribute($model->getKeyName(), Str::uuid()->toString());
            }
        });
    }

    public function getIncrementing(): bool
    {
        return false;
    }

    public function getKeyType(): string
    {
        return 'string';
    }
}
