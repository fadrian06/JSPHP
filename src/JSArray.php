<?php

declare(strict_types=1);

/**
 * @template T of mixed
 * @property int $length Gets or sets the length of the array. This is a number one higher than the highest index in the array.
 * @implements ArrayAccess<int<0, 4294967296>, T>
 */
final class JSArray implements Stringable, ArrayAccess {
  /** @var int */
  private $length = 0;

  /** @var array<int, ?T> */
  private $items = [];

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
  function __set(string $name, $value) {
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

  // TODO: Implement JS array methods
  function __toString(): string {
    // TODO: Implement toString()
    return '';
  }

  /**
   * Performs the specified action for each element in an array.
   * @template O of object
   * @param Closure(?T $value, int $index, self<T> $array): void $callbackfn  A function that accepts up to three arguments. forEach calls the callbackfn function one time for each element in the array.
   * @param ?O $thisArg  An object to which the this keyword can refer in the callbackfn function. If thisArg is omitted, undefined is used as the this value.
   */
  function forEach(callable $callbackfn, ?object $thisArg = null): void {
    if ($thisArg !== null) {
      $callbackfn = Closure::fromCallable($callbackfn);
      $callbackfn = Closure::bind($callbackfn, $thisArg);
    }

    foreach ($this->items as $index => $value) {
      $callbackfn($value, $index, $this);
    }
  }

  /**
   * Returns an iterable of values in the array
   * @return array<int, ?T>
   */
  function values(): array {
    return $this->items;
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
