<?php

declare(strict_types=1);

namespace App\Domain\Cart\Model;

final class ItemCollection implements \Iterator, \Countable
{
    private array $items;
    private int $position = 0;

    public function __construct()
    {
        $this->items = [];
    }

    public function add(Item $item): self
    {
        $this->items[] = $item;

        return $this;
    }

    public function totalQty() : int
    {
        return (int) array_sum(array_map(fn(Item $item): int => $item->quantity, $this->items));
    }

    public function current(): ?Item
    {
        if (!$this->valid()) {
            return null;
        }

        return $this->items[$this->position];
    }

    public function next() : void
    {
        ++$this->position;
    }

    public function key(): int
    {
        return $this->position;
    }

    public function valid(): bool
    {
        return isset($this->items[$this->position]);
    }

    public function rewind() :void
    {
        $this->position = 0;
    }

    public function count() : ?int
    {
        return \count($this->items);
    }

}
