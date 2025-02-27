<?php

declare(strict_types=1);

namespace Tests\PHP\JSString;

use JSString;
use PHPUnit\Framework\TestCase;
use RangeError;

final class fromCodePointTest extends TestCase {
  function test_Demo_String_fromCodePoint(): void {
    self::assertSame(
      '☃★♲你',
      (string) JSString::fromCodePoint(9731, 9733, 9842, 0x2f804)
    );
  }

  function test_Using_fromCodePoint(): void {
    // Valid input:
    self::assertSame('*', (string) JSString::fromCodePoint(42));
    self::assertSame('AZ', (string) JSString::fromCodePoint(65, 90));
    self::assertSame('Є', (string) JSString::fromCodePoint(0x404));
    self::assertSame('你', (string) JSString::fromCodePoint(0x2f804));
    self::assertSame('你', (string) JSString::fromCodePoint(194564));
    self::assertSame('𝌆a𝌇', (string) JSString::fromCodePoint(0x1d306, 0x61, 0x1d307));

    // Invalid input:
    self::expectException(RangeError::class);
    JSString::fromCodePoint('_');
    JSString::fromCodePoint(Infinity);
    JSString::fromCodePoint(-1);
    JSString::fromCodePoint(3.14);
    JSString::fromCodePoint(3e-2);
    JSString::fromCodePoint(NaN);
  }

  function test_Compared_to_fromCharCode(): void {
    /*
    String.fromCharCode() cannot return supplementary characters (i.e. code
    points 0x010000 – 0x10FFFF) by specifying their code point. Instead, it
    requires the UTF-16 surrogate pair in order to return a supplementary
    character:
     */
    // self::assertSame('🌃', (string) JSString::fromCodePoint(0xd83c, 0xdf03));
    // self::assertSame('🌃', (string) JSString::fromCodePoint(55356, 57091));

    /*
    String.fromCodePoint(), on the other hand, can return 4-byte supplementary
    characters, as well as the more common 2-byte BMP characters, by specifying
    their code point (which is equivalent to the UTF-32 code unit):
     */
    self::assertSame('🌃', (string) JSString::fromCodePoint(0x1f303));
  }
}
