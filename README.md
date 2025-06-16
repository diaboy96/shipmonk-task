# SortedLinkedList Library

A simple and efficient PHP library for managing sorted linked lists with strict type enforcement.

## Features

- Automatically maintains sorted order of elements
- Enforces consistent type (`int` or `string`) on first insert
- Supports insertion, deletion, and size operations
- Fully type-safe and covered by tests

## Requirements

- PHP >= 8.3
- Composer

## Installation

Clone the repository and install dependencies using Composer:

```bash
git clone https://github.com/diaboy96/shipmonk-task.git
cd shipmonk-task
composer install
```

## Running tests

The library uses PHPUnit for testing. Run tests with:
```bash
composer test
```

## Project Structure
```
.
├── src
│   └── Node.php
│   └── SortedLinkedList.php
│   └── TypeException.php
├── tests
│   └── SortedLinkedListTest.php
├── composer.json
└── phpunit.xml
```

## Usage Example
For integers:

```php
use SortedList\SortedLinkedList;

$list = new SortedLinkedList();
$list->insert(5);
$list->insert(3);
$list->insert(8);

print_r($list->toArray()); // [3, 5, 8]
```

For strings:

```php
use SortedList\SortedLinkedList;

$list = new SortedLinkedList();
$list->insert("banana");
$list->insert("apple");
$list->insert("cherry");

print_r($list->toArray()); // ["apple", "banana", "cherry"]
```