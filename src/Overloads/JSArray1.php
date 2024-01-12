<?php

/**
 * @template T of mixed
 * @property int $length Gets or sets the length of the array. This is a number one higher than the highest index in the array.
 * @implements ArrayAccess<int<0, 4294967296>, T>
 * @implements Iterator<int<0, 4294967296>, T>
 */
final class JSArray implements Stringable, ArrayAccess, Iterator {
  function __construct(int $arrayLength) {
  }

  function __toString(): string {
    return '';
  }

  function offsetExists($offset): bool {
    return false;
  }

  function offsetGet($offset): mixed {
    return null;
  }

  /**
   * @param int<0, 4294967296> $offset
   * @param T $value
   */
  function offsetSet($offset, $value): void {
  }

  function offsetUnset($offset): void {
  }

  function current() {
  }

  function next(): void {
  }

  function key() {
  }

  function valid(): bool {
    return false;
  }

  function rewind(): void {
  }
}

/**
 * @return JSArray<null>
 * @throws OutOfRangeException For invalid array length
 */
function JSArray(int $arrayLength): JSArray {
  return new JSArray($arrayLength);
}
