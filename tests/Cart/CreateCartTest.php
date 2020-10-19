<?php

declare(strict_types=1);

namespace App\Tests\Cart;

use App\Application\Cart\Request\AddItemToCartRequest;
use App\Application\Cart\Response\CartResponse;
use App\Application\Cart\UseCase\CreateCart;
use App\Domain\Cart\Model\Cart;
use App\Domain\Cart\Model\Item;
use App\Domain\Cart\Model\ItemCollection;
use App\Domain\Cart\Repository\CartRepositoryInterface;
use Ramsey\Uuid\UuidFactory;
use function PHPUnit\Framework\assertInstanceOf;

it('should create a Cart object', function () {
    $item = new Item('sku1', 2);
    $uuid = (new UuidFactory)->uuid1()->toString();
    $cartRequest = new AddItemToCartRequest($uuid, $item);
    $cartRepository = \Mockery::mock(CartRepositoryInterface::class);
    $cartRepository->expects()->saveCart(Cart::class);
    $useCase = new CreateCart($cartRepository);
    $cartReponse = $useCase($cartRequest);
    assertInstanceOf(CartResponse::class, $cartReponse);
    assertInstanceOf(Cart::class, $cartReponse->cart);
    assertInstanceOf(ItemCollection::class, $cartReponse->cart->items);
});

