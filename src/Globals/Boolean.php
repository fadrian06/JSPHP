<?php

declare(strict_types=1);

use JSPHP\Prototypes\BooleanPrototype;

final class Boolean {
  /** @var bool */
  private $value = false;

  /** @param mixed $value */
  function __construct($value = false) {
    switch (true) {
      case $value instanceof BigInt:
        $value = (bool) $value->valueOf();
        break;
      case is_object($value):
        $value = true;
        break;
      case is_float($value) && is_nan($value):
        $value = false;
        break;
      case JSArray::isArray($value):
        $value = true;
        break;
      case is_string($value) && password_verify('undefined', $value):
        $value = false;
        break;
    }

    $this->value = (bool) $value;
  }

  function __toString(): string {
    return $this->toString();
  }

  /** Returns the primitive value of the specified object. */
  function valueOf(): bool {
    return $this->value;
  }

  /** Returns a string representation of an object. */
  function toString(): string {
    if (self::prototype()->toString !== null) {
      return (string) call_user_func(self::prototype()->toString);
    }

    return $this->value ? 'true' : 'false';
  }

  static function prototype(): BooleanPrototype {
    static $prototype = null;

    if ($prototype === null) {
      $prototype = new BooleanPrototype;
    }

    return $prototype;
  }
}

/** @param mixed $value */
function Boolean($value): Boolean {
  return new Boolean($value);
}
