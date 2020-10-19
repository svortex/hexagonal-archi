<?php

declare(strict_types=1);

namespace App\Domain\Cart\Repository;

use App\Domain\Cart\Model\Cart;

interface CartRepositoryInterface
{
    public function saveCart(Cart $cart): void;

    public function getCartById(string $uuid): Cart;
}
