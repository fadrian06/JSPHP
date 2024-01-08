<?php

declare(strict_types=1);

namespace Tests\PHP\Math;

use Math;
use PHPUnit\Framework\TestCase;

final class LOG2ETest extends TestCase {
  // function test_Demo_Math_log2e(): void {
  //   self::expectOutputString('1.4426950408889634');
  //   echo self::getLog2e();
  // }

  function test_Using_Math_LOG10E(): void {
    self::assertSame(1.4426950408889634, self::getLog2e());
  }

  private static function getLog2e(): float {
    return Math::LOG2E;
  }
}
