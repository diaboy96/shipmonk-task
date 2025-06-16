<?php
declare(strict_types=1);

namespace SortedList;

final class Node
{
    public function __construct(
        public readonly int|string $value,
        public ?Node $next = null
    ) {}
}
