<?php

declare(strict_types=1);

/** An intrinsic object that provides basic mathematics functionality and constants. */
final class Math {
  /** The mathematical constant e. This is Euler's number, the base of natural logarithms. */
  const E = 2.718281828459045;
  /** The natural logarithm of 10. */
  const LN10 = 2.302585092994046;
  /** The natural logarithm of 2. */
  const LN2 = 0.6931471805599453;
  /** The base-10 logarithm of e. */
  const LOG10E = 0.4342944819032518;
  /** The base-2 logarithm of e. */
  const LOG2E = 1.4426950408889634;
  /** Pi. This is the ratio of the circumference of a circle to its diameter. */
  const PI = 3.141592653589793;
  /** The square root of 0.5, or, equivalently, one divided by the square root of 2. */
  const SQRT1_2 = 0.7071067811865476;
  /** The square root of 2. */
  const SQRT2 = 1.4142135623730951;

  protected function __construct() {
  }

  /**
   * Returns the absolute value of a number (the value without regard to whether
   * it is positive or negative). For example, the absolute value of -5 is the same
   * as the absolute value of 5.
   * @param int|float $number A numeric expression for which the absolute value is needed.
   * @return int|float
   */
  static function abs($number) {
    assert(is_numeric($number));

    return abs($number);
  }

  /**
   * Returns the arc cosine (or inverse cosine) of a number.
   * @param int|float $number A numeric expression.
   */
  static function acos($number): float {
    assert(is_numeric($number));

    return acos($number);
  }

  // TODO: Implement Math JavaScript class
}
