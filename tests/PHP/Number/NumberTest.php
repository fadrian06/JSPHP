<?php

declare(strict_types=1);

namespace Tests\PHP\Number;

use PHPUnit\Framework\TestCase;

final class NumberTest extends TestCase {
  function test_Description(): void {
    self::assertTrue(Number(255) == Number(255.0));
    self::assertTrue(Number(255) == Number(0xff));
    self::assertTrue(Number(255) == Number(0b11111111));
    self::assertTrue(Number(255) == Number(0.255e3));

    /* When used as a function, Number(value) converts a string or other
    value to the Number type. If the value can't be converted, it
    returns NaN. */
    self::assertSame(123, Number('123')->valueOf());
    self::assertTrue(Number('123')->valueOf() === 123);
    self::assertNan(Number('unicorn')->valueOf());
    // self::assertNan(Number(undefined)->valueOf());
  }
}
