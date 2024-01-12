<?php

declare(strict_types=1);

final class BigInt {
  /** @var int */
  private $value;

  /** @param string|int|BigInt|bool $value */
  function __construct($value) {
    if ($value instanceof BigInt) {
      $value = $value->valueOf();
    }

    $this->value = (int) $value;
  }

  /** Returns the primitive value of the specified object. */
  function valueOf(): int {
    return $this->value;
  }
}

/** @param string|int|BigInt|bool $value */
function BigInt($value): BigInt {
  return new BigInt($value);
}
