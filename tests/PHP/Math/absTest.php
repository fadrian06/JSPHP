<?php

declare(strict_types=1);

namespace Tests\PHP\Math;

use Math;
use PHPUnit\Framework\TestCase;

final class absTest extends TestCase {
  function test_Demo_Math_abs(): void {
    $difference = function ($a, $b) {
      return Math::abs($a - $b);
    };

    self::assertSame(2, $difference(3, 5));
    self::assertSame(2, $difference(5, 3));
    self::assertSame(6.6555599999999995, $difference(1.23456, 7.89012));
  }

  function test_Using_Math_abs(): void {
    self::assertSame(Infinity, Math::abs(-Infinity));
    self::assertSame(1, Math::abs(-1));
    self::assertSame(0, Math::abs(-0));
    self::assertSame(0, Math::abs(0));
    self::assertSame(1, Math::abs(1));
    self::assertSame(Infinity, Math::abs(Infinity));
  }

  function test_Coercion_of_parameter(): void {
    self::assertSame(1, Math::abs('-1'));
    self::assertSame(2, Math::abs(-2));
    self::assertSame(0, Math::abs(null));
    self::assertSame(0, Math::abs(''));
    self::assertSame(0, Math::abs([]));
    self::assertSame(2, Math::abs([2]));
    self::assertTrue(is_nan(Math::abs([1, 2])));
    // self::assertTrue(is_nan(Math::abs({})));
    self::assertTrue(is_nan(Math::abs('string')));
    self::assertTrue(is_nan(Math::abs()));
  }
}
