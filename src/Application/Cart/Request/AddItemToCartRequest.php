<?php

declare(strict_types=1);

namespace App\Application\Cart\Request;

use App\Domain\Cart\Model\Item;

class AddItemToCartRequest implements UseCaseRequest
{
    public string $cartId;
    public Item $item;

    public function __construct(string $cartId, Item $item)
    {
        $this->cartId = $cartId;
        $this->item = $item;
    }

    public function getData(): array
    {
        return [
            'cartId' => $this->cartId,
            'item' => $this->item,
        ];
    }
}
