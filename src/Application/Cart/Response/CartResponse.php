<?php

declare(strict_types=1);

namespace App\Application\Cart\Response;

use App\Domain\Cart\Model\Cart;

class CartResponse implements \Serializable, UseCaseResponse
{
    public Cart $cart;

    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }

    public function serialize(): string
    {
        $serialized = json_encode([
            'uuid' => $this->cart->uuid,
            'items' => $this->cart->items,
            'createdAt' => $this->cart->createdAt,
            'updatedAt' => $this->cart->updatedAt,
        ]);

        return false != $serialized ? $serialized : '';
    }

    public function unserialize($serialized)
    {
       $this->cart = unserialize($serialized);
    }
}
