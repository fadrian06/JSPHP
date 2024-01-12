<?php

declare(strict_types=1);

namespace Tests\PHP\JSNumber;

use JSNumber;
use Math;
use PHPUnit\Framework\TestCase;

final class EPSILONTest extends TestCase {
  function test_Testing_equality(): void {
    /*console.log(0.1 + 0.2); // 0.30000000000000004
    console.log(0.1 + 0.2 === 0.3); // false*/

    /* For this reason, it is often advised that ===. Instead, we can deem
    two numbers as equal if they are close enough to each other.
    The JSNumber::EPSILON constant is usually a reasonable threshold for errors
    if the arithmetic is around the magnitude of 1, because EPSILON, in
    essence, specifies how accurate the number "1" is. */
    $x = 0.2;
    $y = 0.3;
    $z = 0.1;

    self::assertTrue(self::equal($x + $z, $y));

    /* However, JSNumber::EPSILON is inappropriate for any arithmetic
    operating on a larger magnitude. If your data is on the 103 order
    of magnitude, the decimal part will have a much smaller accuracy than
    JSNumber::EPSILON: */
    $x = 1000.1;
    $y = 1000.2;
    $z = 2000.3;

    // console.log($x + $y); // 2000.3000000000002; error of 10^-13 instead of 10^-16
    self::assertFalse(self::equal($x + $y, $z));

    /* In this case, a larger tolerance is required. As the numbers
    compared have a magnitude of approximately 2000, a multiplier such
    as 2000 * JSNumber::EPSILON creates enough tolerance for this instance. */
    $equal = function (float $x, float $y, $tolerance = JSNumber::EPSILON): bool {
      return Math::abs($x - $y) < $tolerance;
    };

    $x = 1000.1;
    $y = 1000.2;
    $z = 2000.3;

    self::assertTrue($equal($x + $y, $z, 2000 * JSNumber::EPSILON));
  }

  private static function equal(float $x, float $y): bool {
    return Math::abs($x - $y) < JSNumber::EPSILON;
  }
}
