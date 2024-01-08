<?php

declare(strict_types=1);

namespace Tests\PHP\Math;

use Math;
use PHPUnit\Framework\TestCase;

final class LN2Test extends TestCase {
  /*function test_Demo_Math_LN2(): void {
    self::expectOutputString('0.6931471805599453');
    echo self::getNatLog2();
  }*/

  function test_Using_Math_LN2(): void {
    self::assertSame(0.6931471805599453, self::getNatLog2());
  }

  private static function getNatLog2(): float {
    return Math::LN2;
  }
}
