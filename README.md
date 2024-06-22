# Collection

[![codecov](https://codecov.io/gh/askonomm/collection/graph/badge.svg?token=BIQDOAGJBT)](https://codecov.io/gh/askonomm/collection)

A generic class that encapsulates a collection of items and provides helper methods to work with said collection.

## Installation

```bash
composer require asko/collection
```

## Usage

Creating a new collection is as simple as creating a new Collection class instance and passing the constructor
an array of items.

```php
use Asko\Collection\Collection;

$collection = new Collection([1, 2, 3, 4, 5]);
```

### Available methods

#### `push`

Add an item to the collection.

```php
$collection->push(6);
```

#### `filter`

Filter the collection using a callback.

```php
$collection->filter(function ($item) {
    return $item > 3;
});
```

#### `map`

Map over the collection using a callback.

```php
$collection->map(function ($item) {
    return $item * 2;
});
```

#### `any`

Check if any item in the collection passes a truth test.

```php
$collection->any(function ($item) {
    return $item > 3;
});
```

#### `all`

Check if all items in the collection pass a truth test.

```php
$collection->all(function ($item) {
    return $item > 3;
});
```

#### `each`

Iterate over the collection.

```php
$collection->each(function ($item) {
    echo $item;
});
```

#### `reduce`

Reduce the collection to a single value.

```php
$collection->reduce(function ($acc, $item) {
    return $acc + $item;
}, 0);
```

#### `first`

Get the first item in the collection.

```php
$collection->first();
```

#### `last`

Get the last item in the collection.

```php
$collection->last();
```

#### `avg`

Get the average of the items in the collection by predicate

```php
$collection->avg(function ($item) {
    return $item * 2;
});
```

#### `sum`

Get the sum of the items in the collection by predicate

```php
$collection->sum(function ($item) {
    return $item * 2;
});
```

#### `count`

Get the number of items in the collection.

```php
$collection->count();
```

#### `toArray`

Get the collection as an array.

```php
$collection->toArray();
```
