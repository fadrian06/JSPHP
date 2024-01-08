<?php

declare(strict_types=1);

namespace Tests\PHP\Math;

use Math;
use PHPUnit\Framework\TestCase;

final class SQRT1_2Test extends TestCase {
  /*function test_Demo_Math_SQRT1_2(): void {
    self::expectOutputString('0.7071067811865476');
    echo self::getRoot1Over2();
  }*/

  function test_Using_Math_SQRT1_2(): void {
    self::assertSame(0.7071067811865476, self::getRoot1Over2()); //
  }

  private static function getRoot1Over2(): float {
    return Math::SQRT1_2;
  }
}
