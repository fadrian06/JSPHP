<?php

declare(strict_types=1);

namespace Tests\PHP\Math;

use Math;
use PHPUnit\Framework\TestCase;

final class floorTest extends TestCase {
  function test_Demo_Math_floor(): void {
    self::assertSame(5, Math::floor(5.95));
    self::assertSame(5, Math::floor(5.05));
    self::assertSame(5, Math::floor(5));
    self::assertSame(-6, Math::floor(-5.05));
  }

  function test_Using_Math_floor(): void {
    self::assertSame(-Infinity, Math::floor(-Infinity));
    self::assertSame(-46, Math::floor(-45.95));
    self::assertSame(-46, Math::floor(-45.05));
    self::assertSame(-0, Math::floor(-0));
    self::assertSame(0, Math::floor(0));
    self::assertSame(4, Math::floor(4));
    self::assertSame(45, Math::floor(45.05));
    self::assertSame(45, Math::floor(45.95));
    self::assertSame(Infinity, Math::floor(Infinity));
  }

  // function test_Decimal_adjustment(): void {
  //   /**
  //    * Adjusts a number to the specified digit.
  //    *
  //    * @param "round" | "floor" | "ceil" $type The type of adjustment.
  //    * @param int|float $value The number.
  //    * @param int|float $exp The exponent (the 10 logarithm of the adjustment base).
  //    * @return int|float The adjusted value.
  //    */
  //   $decimalAdjust = function (string $type, $value, $exp) {
  //     $type = String($type);

  //     if (!JSArray(['round', 'floor', 'ceil'])->includes($type)) {
  //       throw new TypeError("The type of decimal adjustment must be one of 'round', 'floor', or 'ceil'.");
  //     }

  //     $exp = Number($exp);
  //     $value = Number($value);

  //     if ($exp->valueOf() % 1 !== 0 || Number::isNaN($value)) {
  //       return NaN;
  //     } else if ($exp === 0) {
  //       return call_user_func([Math::class, $type], $value);
  //     }

  //     $splitResult = $value->toString()->split('e');
  //     $magnitude = $splitResult[0];
  //     $exponent = $splitResult[1] ?? 0;

  //     $adjustedValue = call_user_func(
  //       [Math::class, $type->valueOf()],
  //       sprintf("{$magnitude}e%s", $exponent - $exp->valueOf())
  //     );

  //     // Shift back
  //     $splitResult = Number($adjustedValue)->toString()->split('e');
  //     $newMagnitude = $splitResult[0];
  //     $newExponent = $splitResult[1] ?? 0;

  //     return Number(sprintf("{$newMagnitude}e%s", +$newExponent + $exp->valueOf()));
  //   };

  //   // Decimal round
  //   $round10 = function ($value, $exp) use ($decimalAdjust) {
  //     return $decimalAdjust('round', $value, $exp);
  //   };

  //   // Decimal floor
  //   $floor10 = function ($value, $exp) use ($decimalAdjust) {
  //     return $decimalAdjust('floor', $value, $exp);
  //   };

  //   // Decimal ceil
  //   $ceil10 = function ($value, $exp) use ($decimalAdjust) {
  //     return $decimalAdjust('ceil', $value, $exp);
  //   };

  //   // Round
  //   // self::assertSame(55.6, $round10(55.55, -1)->valueOf());
  //   // self::assertSame(55.5, $round10(55.549, -1)->valueOf());
  //   // self::assertSame(60, $round10(55, 1)->valueOf());
  //   // self::assertSame(50, $round10(54.9, 1)->valueOf());
  //   // self::assertSame(-55.5, $round10(-55.55, -1)->valueOf());
  //   // self::assertSame(-55.6, $round10(-55.551, -1)->valueOf());
  //   // self::assertSame(-50, $round10(-55, 1)->valueOf());
  //   // self::assertSame(-60, $round10(-55.1, 1)->valueOf());
  //   // Floor
  //   // self::assertSame(55.5, $floor10(55.59, -1)->valueOf());
  //   // self::assertSame(50, $floor10(59, 1)->valueOf());
  //   // self::assertSame(-55.6, $floor10(-55.51, -1)->valueOf());
  //   // self::assertSame(-60, $floor10(-51, 1)->valueOf());
  //   // Ceil
  //   // self::assertSame(55.6, $ceil10(55.51, -1)->valueOf());
  //   // self::assertSame(60, $ceil10(51, 1)->valueOf());
  //   // self::assertSame(-55.5, $ceil10(-55.59, -1)->valueOf());
  //   // self::assertSame(-50, $ceil10(-59, 1)->valueOf());
  // }
}
