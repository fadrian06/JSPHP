<?php

declare(strict_types=1);

namespace Tests\PHP\Math;

use Math;
use PHPUnit\Framework\TestCase;

final class ceilTest extends TestCase {
  function test_Demo_Math_ceil(): void {
    self::assertSame(1, Math::ceil(0.95));
    self::assertSame(4, Math::ceil(4));
    self::assertSame(8, Math::ceil(7.004));
    self::assertSame(-7, Math::ceil(-7.004));
  }

  function test_Using_Math_ceil(): void {
    self::assertSame(-Infinity, Math::ceil(-Infinity));
    self::assertSame(-7, Math::ceil(-7.004));
    self::assertSame(-4, Math::ceil(-4));
    self::assertSame(-0, Math::ceil(-0.95));
    self::assertSame(-0, Math::ceil(-0));
    self::assertSame(0, Math::ceil(0));
    self::assertSame(1, Math::ceil(0.95));
    self::assertSame(4, Math::ceil(4));
    self::assertSame(8, Math::ceil(7.004));
    self::assertSame(Infinity, Math::ceil(Infinity));
  }
}
