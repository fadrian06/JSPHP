<?php

declare(strict_types=1);

namespace Tests\PHP\Math;

use Math;
use PHPUnit\Framework\TestCase;

final class LOG10ETest extends TestCase {
  // function test_Demo_Math_log10e(): void {
  //   self::expectOutputString('0.4342944819032518');
  //   echo self::getLog10e();
  // }

  function test_Using_Math_LOG10E(): void {
    self::assertSame(0.4342944819032518, self::getLog10e());
  }

  private static function getLog10e(): float {
    return Math::LOG10E;
  }
}
