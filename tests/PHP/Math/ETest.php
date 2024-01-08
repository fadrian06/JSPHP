<?php

declare(strict_types=1);

namespace Tests\PHP\Math;

use Math;
use PHPUnit\Framework\TestCase;

final class ETest extends TestCase {
  function test_Demo_Math_E(): void {
    $compoundOneYear = function (float $interestRate, int $currentVal): float {
      return $currentVal * Math::E ** $interestRate;
    };

    self::assertSame(2.718281828459045, Math::E);
    self::assertSame(2.7182804690957534, (1 + 1 / 1000000) ** 1000000);
    self::assertSame(105.12710963760242, $compoundOneYear(0.05, 100));
  }

  function test_Using_Math_E(): void {
    $getNapier = function (): float {
      return Math::E;
    };

    self::assertSame(2.718281828459045, $getNapier());
  }
}
