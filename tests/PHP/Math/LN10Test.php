<?php

declare(strict_types=1);

namespace Tests\PHP\Math;

use Math;
use PHPUnit\Framework\TestCase;

final class LN10Test extends TestCase {
  function test_Demo_Math_LN10(): void {
    $getNatLog10 = function (): float {
      return Math::LN10;
    };

    self::assertSame(2.302585092994046, $getNatLog10());

    // TODO: Float to string coercion lose precision
    // self::expectOutputString('2.302585092994046');
    // echo $getNatLog10();
  }
}
