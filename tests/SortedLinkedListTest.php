<?php
declare(strict_types=1);

namespace SortedList\Tests;

use PHPUnit\Framework\TestCase;
use SortedList\SortedLinkedList;
use SortedList\TypeException;

final class SortedLinkedListTest extends TestCase
{
    public function testInsertIntegersSorted(): void
    {
        $list = new SortedLinkedList();
        $list->insert(10);
        $list->insert(3);
        $list->insert(7);

        $this->assertSame([3, 7, 10], $list->toArray());
    }

    public function testInsertStringsSortedLexicographically(): void
    {
        $list = new SortedLinkedList();
        $list->insert("banana");
        $list->insert("apple");
        $list->insert("carrot");

        $this->assertSame(["apple", "banana", "carrot"], $list->toArray());
    }

    public function testInsertMixedTypesThrowsException(): void
    {
        $this->expectException(TypeException::class);

        $list = new SortedLinkedList();
        $list->insert(42);
        $list->insert("forty-two"); // Should throw
    }

    public function testClearResetsType(): void
    {
        $list = new SortedLinkedList();
        $list->insert(1);
        $list->insert(2);

        $list->clear();
        $this->assertSame([], $list->toArray());

        // Should allow new type after clear
        $list->insert("abc");
        $list->insert("aaa");

        $this->assertSame(["aaa", "abc"], $list->toArray());
    }

    public function testEmptyListToArrayReturnsEmptyArray(): void
    {
        $list = new SortedLinkedList();
        $this->assertSame([], $list->toArray());
        $this->assertTrue($list->isEmpty());
    }

    public function testCountableInterface(): void
    {
        $list = new SortedLinkedList();
        $this->assertCount(0, $list);

        $list->insert(100);
        $list->insert(50);
        $this->assertCount(2, $list);
    }

    public function testCountMethod(): void
    {
        $list = new SortedLinkedList();
        $this->assertSame(0, $list->count());

        $list->insert(100);
        $list->insert(50);
        $this->assertSame(2, $list->count());
    }

    public function testFirstMethod(): void
    {
        $list = new SortedLinkedList();

        $list->insert(100);
        $list->insert(50);

        $this->assertSame(100, $list->first());
    }

    public function testIteratorAggregateInterface(): void
    {
        $list = new SortedLinkedList();
        $list->insert(5);
        $list->insert(1);
        $list->insert(3);

        $values = [];
        foreach ($list as $value) {
            $values[] = $value;
        }

        $this->assertSame([1, 3, 5], $values);
    }
}
