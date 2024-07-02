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
    switch (true) {
      case $value === null:
        $value = 0;
        break;
      case is_bool($value):
      case is_numeric($value):
        $value = (int) $value;
        break;
      case is_array($value):
        if ($value === []) {
          $value = 0;
        } elseif (count($value) === 1) {
          $value = $value[0];
        } else {
          $value = NAN;
        }

        break;
      case $value === '':
        $value = 0;
        break;
      default:
        $value = NAN;
    }

    $this->value = $value;
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
  function toString($radix = null): JSString {
    return String($this);
  }

  /**
   * Returns a Boolean value that indicates whether a value is the reserved value NaN (not a
   * number). Unlike the global isNaN(), Number.isNaN() doesn't forcefully convert the parameter
   * to a number. Only values of the type number, that are also NaN, result in true.
   * @template Unknown
   * @param Unknown $number A numeric value.
   */
  static function isNaN($number): bool {
    if (is_object($number)) {
      $number = $number->valueOf();
    }

    return is_nan($number);
  }
}

/**
 * An object that represents a number of any kind. All JavaScript numbers are
 * 64-bit floating-point numbers.
 * @param mixed $value
 */
function Number($value = null): Number {
  return new Number($value);
}
