<?php

declare(strict_types=1);

namespace Tests\PHP\JSString;

use JSString;
use PHPUnit\Framework\TestCase;

final class fromCharCodeTest extends TestCase {
  function test_Demo_String_fromCharCode(): void {
    self::assertSame('½+¾=', (string) JSString::fromCharCode(189, 43, 190, 61));
  }

  function test_Using_fromCharCode(): void {
    // BMP characters, in UTF-16, use a single code unit:

    self::assertSame('ABC', (string) JSString::fromCharCode(65, 66, 67));
    self::assertSame('—', (string) JSString::fromCharCode(0x2014));

    // also returns "—"; the digit 1 is truncated and ignored
    // self::assertSame('—', (string) JSString::fromCharCode(0x12014));

    // also returns "—"; 8212 is the decimal form of 0x2014
    self::assertSame('—', (string) JSString::fromCharCode(8212));

    // Supplementary characters, in UTF-16, require two code units (i.e. a surrogate pair):

    // Code Point U+1F303 "Night with
    // self::assertSame('🌃', (string) JSString::fromCharCode(0xd83c, 0xdf03));

    // Stars" === "\uD83C\uDF03"
    // self::assertSame('🌃', (string) JSString::fromCharCode(55356, 57091));

    // "\uD834\uDF06a\uD834\uDF07"
    /*self::assertSame('𝌆a𝌇', (string) JSString::fromCharCode(
      0xd834,
      0xdf06,
      0x61,
      0xd834,
      0xdf07
    ));*/
  }
}
