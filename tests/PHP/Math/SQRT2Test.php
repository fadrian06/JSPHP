<?php

declare(strict_types=1);

namespace Tests\PHP\Math;

use Math;
use PHPUnit\Framework\TestCase;

final class SQRT2Test extends TestCase {
  /*function test_Demo_Math_SQRT2(): void {
    self::expectOutputString('1.4142135623730951');
    echo self::getRoot2();
  }*/

  function test_Using_Math_SQRT2(): void {
    self::assertSame(1.4142135623730951, self::getRoot2()); //
  }

  private static function getRoot2(): float {
    return Math::SQRT2;
  }
}
