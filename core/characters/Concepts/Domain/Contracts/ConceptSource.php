<?php

declare(strict_types=1);

namespace TheSeed\Characters\Concepts\Domain\Contracts;

interface ConceptSource
{
    public function id(): string;

    public function name(): string;

    public function gender(): string;

    public function dateOfBirth(): string;

    public function demeanor(): string;

    public function nature(): string;

    public function motivation(): string;
}
