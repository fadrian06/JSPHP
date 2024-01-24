<?php

declare(strict_types=1);

use JSPHP\Prototypes\ArrayPrototype;

/**
 * @template T of mixed
 * @property int $length Gets or sets the length of the array. This is a number one higher than the highest index in the array.
 * @implements ArrayAccess<int<0, 4294967296>, T>
 * @implements Iterator<int<0, 4294967296>, T>
 */
final class JSArray implements Stringable, ArrayAccess, Iterator {
  /** @var int */
  private $position = 0;

  /** @var int */
  private $length = 0;

  /** @var array<int, ?T> */
  private $items = [];

  /** @var ?ArrayPrototype */
  private static $prototype = null;

  /**
   * @param ?int $arrayLength
   * @throws OutOfRangeException For invalid array length
   */
  function __construct($arrayLength = null) {
    if (is_array($arrayLength)) {
      $this->items = $arrayLength;
      $this->length = count($this->items);
    }

    if (is_int($arrayLength)) {
      if ($arrayLength >= 2 ** 32 || $arrayLength < 0) {
        throw new OutOfRangeException('Invalid array length');
      }

      $this->length = $arrayLength;

      for ($i = 0; $i < $this->length; ++$i) {
        $this->items[] = null;
      }
    }
  }

  /** @param 'length' $name Property name */
  function __get(string $name): ?int {
    if ($name === 'length') {
      return $this->length;
    }

    return null;
  }

  /**
   * @param 'length' $name Property name
   * @param int<0, 4294967296> $value Property value
   * @throws OutOfRangeException For invalid array length
   */
  function __set(string $name, $value): void {
    if ($name === 'length') {
      if (!is_int($value) || $value < 0 || $value >= 2 ** 32) {
        throw new OutOfRangeException('Invalid array length');
      }

      if ($value > $this->length) {
        for ($i = $this->length; $i < $value; ++$i) {
          $this->items[] = null;
        }
      } elseif ($value < $this->length) {
        for ($i = $value; $i < $this->length; ++$i) {
          unset($this->items[$i]);
        }
      }

      $this->length = $value;
    }
  }

  function __toString(): string {
    return join(',', $this->items);
  }

  static function prototype(): ArrayPrototype {
    if (self::$prototype === null) {
      self::$prototype = new ArrayPrototype;
    }

    return self::$prototype;
  }

  /** @param mixed $arg */
  static function isArray($arg): bool {
    return is_array($arg) || $arg instanceof self;
  }

  /**
   * Performs the specified action for each element in an array.
   * @template O of object
   * @param Closure(?T $value, int $index, self<T> $array): void $callbackfn  A function that accepts up to three arguments. forEach calls the callbackfn function one time for each element in the array.
   * @param ?O $thisArg  An object to which the this keyword can refer in the callbackfn function. If thisArg is omitted, undefined is used as the this value.
   */
  function forEach(callable $callbackfn, $thisArg = null): void {
    if ($thisArg !== null) {
      $callbackfn = Closure::fromCallable($callbackfn);
      $callbackfn = Closure::bind($callbackfn, $thisArg);
    }

    foreach ($this->items as $index => $value) {
      if ($value === null) {
        continue;
      }

      $callbackfn($value, $index, $this);
    }
  }

  /**
   * Appends new elements to the end of an array, and returns the new length of the array.
   * @param T ...$items New elements to add to the array.
   */
  function push(...$items): int {
    $this->length = array_push($this->items, ...$items);

    return $this->length;
  }

  /**
   * Returns an iterable of values in the array
   * @return array<int, ?T>
   */
  function values(): array {
    return $this->items;
  }

  /** Returns a string representation of an array. */
  function toString(): string {
    return (string) $this;
  }

  /** @param int<0, 4294967296> $offset */
  function offsetExists($offset): bool {
    return isset($this->items[$offset]);
  }

  /** @param int<0, 4294967296> $offset */
  #[ReturnTypeWillChange]
  function offsetGet($offset) {
    return $this->items[$offset] ?? null;
  }

  /**
   * @param ?int<0, 4294967296> $offset
   * @param T $value
   */
  function offsetSet($offset, $value): void {
    $this->items[(int) $offset] = $value;
    $this->length++;
  }

  /** @param int<0, 4294967296> $offset */
  function offsetUnset($offset): void {
    unset($this->items[$offset]);
    $this->length--;
  }

  /** @return ?T */
  #[ReturnTypeWillChange]
  function current() {
    return $this->items[$this->position];
  }

  function next(): void {
    $this->position++;
  }

  #[ReturnTypeWillChange]
  function key(): int {
    /** @var int<0, 4294967296> */
    $position = $this->position;

    return $position;
  }

  function valid(): bool {
    return isset($this->items[$this->position]);
  }

  function rewind(): void {
    $this->position = 0;
  }
}

/**
 * @param ?int $arrayLength
 * @return JSArray<null>
 * @throws OutOfRangeException For invalid array length
 */
function JSArray($arrayLength = null): JSArray {
  /** @var JSArray<null> */
  $jsArray = new JSArray($arrayLength);

  return $jsArray;
}
