<?php

declare(strict_types=1);

namespace App\Application\Cart\UseCase;

use App\Application\Cart\Request\UseCaseRequest;
use App\Application\Cart\Response\CartResponse;
use App\Application\Cart\Response\UseCaseResponse;
use App\Domain\Cart\Model\Item;
use App\Domain\Cart\Repository\CartRepositoryInterface;

use Assert\Assert;
use function Assert\lazy;

class AddItemToCart implements UseCase
{
    public CartRepositoryInterface $repository;

    public function __construct(CartRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(UseCaseRequest $request): UseCaseResponse
    {
        $data = $request->getData();
        Assert::that($data['item'])->notNull();
        Assert::that($data['cartId'])->notNull();
        $cart = $this->repository->getCartById($data['cartId']);
        Assert::that($cart)->notNull();
        $item = $data['item'];
        $this->validate($item);
        $cart->addItem($item);

        $this->repository->saveCart($cart);

        return new CartResponse($cart);
    }

    private function validate(Item $item) : void
    {
        lazy()
            ->that($item->quantity)->notBlank()->greaterOrEqualThan(1)
            ->that($item->sku)->notBlank()->minLength(3)
            ->verifyNow();
    }
}
