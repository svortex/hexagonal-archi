<?php

declare(strict_types=1);

use App\Application\Cart\Request\AddItemToCartRequest;
use App\Application\Cart\UseCase\AddItemToCart;
use App\Domain\Cart\Model\Cart;
use App\Domain\Cart\Model\Item;
use App\Domain\Cart\Repository\CartRepositoryInterface;
use Assert\LazyAssertionException;
use Ramsey\Uuid\Uuid;
use function PHPUnit\Framework\assertEquals;

it("should add item to cart", function() {
    $cart = new Cart(Uuid::uuid1()->toString());
    $cartRepository = \Mockery::mock(CartRepositoryInterface::class);
    $cartRepository->shouldReceive('getCartById')->andReturn($cart);
    $cartRepository->shouldReceive('saveCart');
    $item  = new Item('SKU1', 2);
    $request = new AddItemToCartRequest($cart->uuid, $item);
    $useCase =  new AddItemToCart($cartRepository);
    $response = ($useCase)($request);
    assertEquals(1, $response->cart->items->count());
    assertEquals(2, $response->cart->items->totalQty());
});

it("should throws an exception", function($data) {
    $cart = new Cart(Uuid::uuid1()->toString());
    $cartRepository = \Mockery::mock(CartRepositoryInterface::class);
    $cartRepository->shouldReceive('getCartById')->andReturn($cart);
    $cartRepository->shouldReceive('saveCart');
    $item  = new Item($data[0], $data[1]);
    $request = new AddItemToCartRequest($cart->uuid, $item);
    $useCase =  new AddItemToCart($cartRepository);
    ($useCase)($request);
})->with(function() {
    yield [['sku1', -1]];
    yield [['sku2', 0]];
    yield [['1', 1]];
})->throws(LazyAssertionException::class);