<?php

declare(strict_types=1);

namespace App\Domain\Cart\Model;

final class Cart
{
    public string $uuid;
    public ItemCollection $items;
    public \DateTimeInterface $createdAt;
    public \DateTimeInterface $updatedAt;

    public function __construct(string $uuid)
    {
        $this->uuid = $uuid;
        $this->createdAt = new \DateTimeImmutable();
        $this->updatedAt = new \DateTimeImmutable();
        $this->items = new ItemCollection();
    }

    public function addItem(Item $item): self
    {
        $this->items->add($item);

        return $this;
    }
}
