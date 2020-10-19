<?php

declare(strict_types=1);

namespace App\Application\Cart\UseCase;

use App\Application\Cart\Request\UseCaseRequest;
use App\Application\Cart\Response\UseCaseResponse;

interface UseCase
{
    public function __invoke(UseCaseRequest $request): UseCaseResponse;
}
