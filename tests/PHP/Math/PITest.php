<?php

declare(strict_types=1);

namespace Tests\PHP\Math;

use Math;
use PHPUnit\Framework\TestCase;

final class PITest extends TestCase {
  function test_Demo_Math_PI(): void {
    $calculateCircumference = function (float $radius): float {
      return 2 * Math::PI * $radius;
    };

    self::assertSame(3.141592653589793, Math::PI);
    self::assertSame(62.83185307179586, $calculateCircumference(10));

    // self::expectOutputString('62.83185307179586');
    // echo $calculateCircumference(10);
  }

  function test_Using_Math_PI(): void {
    $calculateCircumference = function (float $radius): float {
      return Math::PI * ($radius + $radius);
    };

    self::assertSame(6.283185307179586, $calculateCircumference(1));
  }
}
