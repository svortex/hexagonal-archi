<?php

declare(strict_types=1);

namespace App\Application\Cart\UseCase;

use App\Application\Cart\Request\UseCaseRequest;
use App\Application\Cart\Response\CartResponse;
use App\Application\Cart\Response\UseCaseResponse;
use App\Domain\Cart\Model\Cart;
use App\Domain\Cart\Repository\CartRepositoryInterface;
use Ramsey\Uuid\UuidFactory;

final class CreateCart implements UseCase
{
    public CartRepositoryInterface $repository;

    public function __construct(CartRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(UseCaseRequest $request): UseCaseResponse
    {
        $data = $request->getData();
        $cart = new Cart($data['uuid'] ?? (new UuidFactory)->uuid4()->toString() );
        $this->repository->saveCart($cart);

        return new CartResponse($cart);
    }
}
