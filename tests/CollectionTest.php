<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class CollectionTest extends TestCase
{
    public function testPush(): void
    {
        $collection = new Asko\Collection\Collection([1, 2, 3, 4, 5]);

        $collection->push(6);

        $this->assertEquals([1, 2, 3, 4, 5, 6], $collection->toArray());
    }

    public function testFilter(): void
    {
        $collection = new Asko\Collection\Collection([1, 2, 3, 4, 5]);

        $filtered = $collection->filter(fn ($item) => $item % 2 === 0);

        $this->assertEquals([2, 4], $filtered->toArray());
    }

    public function testMap(): void
    {
        $collection = new Asko\Collection\Collection([1, 2, 3, 4, 5]);

        $mapped = $collection->map(fn ($item) => $item * 2);

        $this->assertEquals([2, 4, 6, 8, 10], $mapped->toArray());
    }

    public function testCount(): void
    {
        $collection = new Asko\Collection\Collection([1, 2, 3, 4, 5]);

        $this->assertEquals(5, $collection->count());
    }

    public function testEach(): void
    {
        $collection = new Asko\Collection\Collection([1, 2, 3, 4, 5]);

        $collection->each(fn ($item) => $this->assertEquals($item, $item));
    }

    public function testAvg(): void
    {
        $collection = new Asko\Collection\Collection([1, 2, 3, 4, 5]);

        $this->assertEquals(3, $collection->avg(fn ($item) => $item));
    }

    public function testSum(): void
    {
        $collection = new Asko\Collection\Collection([1, 2, 3, 4, 5]);

        $this->assertEquals(15, $collection->sum(fn ($item) => $item));
    }

    public function testToArray(): void
    {
        $collection = new Asko\Collection\Collection([1, 2, 3, 4, 5]);

        $this->assertEquals([1, 2, 3, 4, 5], $collection->toArray());
    }

    public function testEmptyCollection(): void
    {
        $collection = new Asko\Collection\Collection();

        $this->assertEquals([], $collection->toArray());
    }

    public function testFilterEmptyCollection(): void
    {
        $collection = new Asko\Collection\Collection();

        $filtered = $collection->filter(fn ($item) => $item % 2 === 0);

        $this->assertEquals([], $filtered->toArray());
    }

    public function testMapEmptyCollection(): void
    {
        $collection = new Asko\Collection\Collection();

        $mapped = $collection->map(fn ($item) => $item * 2);

        $this->assertEquals([], $mapped->toArray());
    }

    public function testPushEmptyCollection(): void
    {
        $collection = new Asko\Collection\Collection();

        $collection->push(6);

        $this->assertEquals([6], $collection->toArray());
    }

    public function testReduce(): void
    {
        $collection = new Asko\Collection\Collection([1, 2, 3, 4, 5]);

        $reduced = $collection->reduce(fn ($acc, $item) => $acc + $item, 0);

        $this->assertEquals(15, $reduced);
    }

    public function testFirst(): void
    {
        $collection = new Asko\Collection\Collection([1, 2, 3, 4, 5]);

        $this->assertEquals(1, $collection->first());
    }

    public function testLast(): void
    {
        $collection = new Asko\Collection\Collection([1, 2, 3, 4, 5]);

        $this->assertEquals(5, $collection->last());
    }

    public function testAny(): void
    {
        $collection = new Asko\Collection\Collection([1, 2, 3, 4, 5]);

        $this->assertTrue($collection->any(fn ($item) => $item === 3));
    }

    public function testAll(): void
    {
        $collection = new Asko\Collection\Collection([1, 2, 3, 4, 5]);

        $this->assertTrue($collection->all(fn ($item) => $item > 0));
    }
}
