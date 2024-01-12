<?php

/**
 * An object that represents a number of any kind. All JavaScript numbers are
 * 64-bit floating-point numbers.
 */
final class Number {
  /**
   * The value of JSNumber::EPSILON is the difference between 1 and the smallest value greater than 1
   * that is representable as a Number value, which is approximately:
   * 2.2204460492503130808472633361816 x 10‍−‍16.
   */
  const EPSILON = 2.220446049250313e-16;

  /** The closest number to zero that can be represented in JavaScript. Equal to approximately 5.00E-324. */
  const MIN_VALUE = 5e-324;

  /** @var int|float */
  private $value = 0;

  /** @param mixed $value */
  function __construct($value = null) {
    if ($value === null) {
      $this->value = 0;
      return;
    }

    if (is_bool($value)) {
      return (int) $value;
    }

    if (is_numeric($value)) {
      $value = (float) $value;
      $this->value = $value;

      return;
    }

    $this->value = NAN;
  }

  function __toString(): string {
    return (string) $this->value;
  }

  /**
   * Returns the primitive value of the specified object.
   * @return int|float
   */
  function valueOf() {
    if ($this->value === (float) ((int) $this->value)) {
      return (int) $this->value;
    }

    return $this->value;
  }

  /**
   * Returns a string representation of an object.
   * @param null|int|float $radix Specifies a radix for converting numeric values to strings. This value is only used for numbers.
   */
  function toString($radix = null): string {
    return (string) $this;
  }
  // TODO: Implement JS number methods
}

/**
 * An object that represents a number of any kind. All JavaScript numbers are
 * 64-bit floating-point numbers.
 * @param mixed $value
 */
function Number($value = null): Number {
  return new Number($value);
}
