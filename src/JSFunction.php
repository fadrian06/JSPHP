<?php

declare(strict_types=1);

/** @property-write Closure $prototype */
final class JSFunction {
  /** @var Closure */
  private $prototype;

  /** @param 'prototype' $name Property name */
  function __set(string $name, Closure $value): void {
    if ($name === 'prototype') {
      $this->prototype = $value;
    }
  }

  /**
   * Calls a method of an object, substituting another object for the current object.
   * @template T of object
   * @param T $thisArg The object to be used as the current object.
   * @param mixed ...$argArray A list of arguments to be passed to the method.
   * @return mixed
   */
  function call(object $thisArg, ...$argArray) {
    // TODO: Implement Function.call(...)
    return $this->prototype->call($thisArg, ...$argArray);
  }
}
