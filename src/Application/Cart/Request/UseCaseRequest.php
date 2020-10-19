<?php

declare(strict_types=1);

namespace App\Application\Cart\Request;

interface UseCaseRequest
{
    public function getData(): array;
}
