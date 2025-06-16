<?php
declare(strict_types=1);

namespace SortedList;

use ArrayIterator;
use Countable;
use IteratorAggregate;

class SortedLinkedList implements IteratorAggregate, Countable
{
    private ?Node $head = null;
    private int $size = 0;
    private ?string $type = null; // "int" or "string"

    public function insert(int|string $value): void
    {
        $this->ensureTypeConsistency($value);

        $newNode = new Node($value);

        if (!$this->head || $value < $this->head->value) {
            $newNode->next = $this->head;
            $this->head = $newNode;
        } else {
            $current = $this->head;
            while ($current->next && $current->next->value < $value) {
                $current = $current->next;
            }
            $newNode->next = $current->next;
            $current->next = $newNode;
        }

        $this->size++;
    }

    public function toArray(): array
    {
        $result = [];
        $current = $this->head;
        while ($current) {
            $result[] = $current->value;
            $current = $current->next;
        }
        return $result;
    }

    public function clear(): void
    {
        $this->head = null;
        $this->type = null;
        $this->size = 0;
    }

    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->toArray());
    }

    public function count(): int
    {
        return $this->size;
    }

    public function first(): int|string|null
    {
        return $this->head?->value;
    }

    public function isEmpty(): bool
    {
        return $this->size === 0;
    }

    private function ensureTypeConsistency(int|string $value): void
    {
        $incomingType = gettype($value);

        if (!in_array($incomingType, ['integer', 'string'], true)) {
            throw new TypeException("Only int or string values are supported.");
        }

        $incomingType = $incomingType === 'integer' ? 'int' : 'string';

        if ($this->type === null) {
            $this->type = $incomingType;
        } elseif ($this->type !== $incomingType) {
            throw new TypeException("This list only accepts {$this->type} values.");
        }
    }
}
