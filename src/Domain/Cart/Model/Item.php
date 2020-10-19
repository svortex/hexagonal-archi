<?php

declare(strict_types=1);

namespace App\Domain\Cart\Model;

final class Item
{
    public string $uuid;
    public string $sku;
    public int $quantity;

    public function __construct(string $sku, int $quantity)
    {
        $this->sku = $sku;
        $this->quantity = $quantity;
    }
}
