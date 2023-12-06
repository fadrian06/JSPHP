<?php

declare(strict_types=1);

/** An intrinsic object that provides basic mathematics functionality and constants. */
abstract class Math {
  /** The mathematical constant e. This is Euler's number, the base of natural logarithms. */
  final const E = 2.718281828459045;
  /** The natural logarithm of 10. */
  final const LN10 = 2.302585092994046;
  /** The natural logarithm of 2. */
  final const LN2 = 0.6931471805599453;
  /** The base-10 logarithm of e. */
  final const LOG10E = 0.4342944819032518;
  /** The base-2 logarithm of e. */
  final const LOG2E = 1.4426950408889634;
  /** Pi. This is the ratio of the circumference of a circle to its diameter. */
  final const PI = 3.141592653589793;
  /** The square root of 0.5, or, equivalently, one divided by the square root of 2. */
  final const SQRT1_2 = 0.7071067811865476;
  /** The square root of 2. */
  final const SQRT2 = 1.4142135623730951;

  final protected function __construct() {
  }

  /**
   * Returns the absolute value of a number (the value without regard to whether
   * it is positive or negative). For example, the absolute value of -5 is the same
   * as the absolute value of 5.
   * @param int|float $number A numeric expression for which the absolute value is needed.
   */
  final static function abs(int|float $number): int|float {
    return abs($number);
  }

  /**
   * Returns the arc cosine (or inverse cosine) of a number.
   * @param int|float $number A numeric expression.
   */
  final static function acos(int|float $number): int|float {
    return acos($number);
  }

  // TODO: Implement Math JavaScript class
}
