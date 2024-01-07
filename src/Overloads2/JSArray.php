<?php

/**
 * @template T of mixed
 * @property int $length Gets or sets the length of the array. This is a number one higher than the highest index in the array.
 * @implements ArrayAccess<int<0, 4294967296>, T>
 */
final class JSArray implements Stringable, ArrayAccess {
  /** @param TValue ...$items */
  function __construct(...$items) {
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
}

/**
 * @template T
 * @param T ...$items
 * @return JSArray<T>
 */
function JSArray(...$items): JSArray {
  return new JSArray($items);
}
