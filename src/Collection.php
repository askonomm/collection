<?php

declare(strict_types=1);

namespace Asko\Collection;

use function Crell\fp\pipe;

/**
 * A generic class that encapsulates a collection of items
 * and provides helper methods to work with said collection.
 *
 * @author Asko Nõmm
 * @template T
 */
class Collection implements \Countable
{
    /**
     * @param array<T> $items
     */
    private array $items;

    /**
     * @param array<T> $items
     */
    public function __construct(array $items = [])
    {
        $this->items = $items;
    }

    /**
     * @param T $item
     * @return void
     */
    public function push(mixed $item): void
    {
        $this->items[] = $item;
    }

    /**
     * @param callable(T): bool $callback
     * @return static
     */
    public function filter(callable $callback): static
    {
        return pipe(
            $this->items,
            fn ($items) => array_filter($items, $callback),
            array_values(...),
            fn ($items) => new static($items)
        );
    }

    /**
     * @param callable(T): T $callback
     * @return static
     */
    public function map(callable $callback): static
    {
        return pipe(
            $this->items,
            fn ($items) => array_map($callback, $items),
            fn ($items) => new static($items)
        );
    }

    /**
     * @param callable(T): bool $callback
     * @return bool
     */
    public function any(callable $callback): bool
    {
        foreach ($this->items as $item) {
            if ($callback($item)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param callable(T): bool $callback
     * @return bool
     */
    public function all(callable $callback): bool
    {
        foreach ($this->items as $item) {
            if (!$callback($item)) {
                return false;
            }
        }

        return true;
    }

    /**
     *
     * @param callable(T): void $callback
     * @return void
     */
    public function each(callable $callback): void
    {
        foreach ($this->items as $item) {
            $callback($item);
        }
    }

    /**
     * @param callable $callback
     * @param mixed $initial
     * @return mixed
     */
    public function reduce(callable $callback, mixed $initial): mixed
    {
        $accumulator = $initial;

        foreach ($this->items as $item) {
            $accumulator = $callback($accumulator, $item);
        }

        return $accumulator;
    }

    /**
     * Return the first item in the collection by predicate.
     *
     * @return T|null
     */
    public function first(): mixed
    {
        if (count($this->items) === 0) {
            return null;
        }

        return $this->items[0];
    }

    /**
     * Return the last item in the collection by predicate.
     *
     * @return T|null
     */
    public function last(): mixed
    {
        if (count($this->items) === 0) {
            return null;
        }

        return $this->items[count($this->items) - 1];
    }

    /**
     * Return the average of the items by predicate.
     *
     * @param callable(T): float $callback
     * @return int|float
     */
    public function avg(callable $callback): int|float
    {
        $total = 0;
        $count = 0;

        foreach ($this->items as $item) {
            $total += $callback($item);
            $count++;
        }

        return $total / $count;
    }

    public function sum(callable $callback): int|float
    {
        $total = 0;

        foreach ($this->items as $item) {
            $total += $callback($item);
        }

        return $total;
    }

    /**
     * Return the number of items in the collection.
     *
     * @return int
     */
    public function count(): int
    {
        return count($this->items);
    }

    /**
     * Return the items as an array.
     *
     * @return array<T>
     */
    public function toArray(): array
    {
        return $this->items;
    }
}
