<?php

declare(strict_types=1);

namespace Tests\PHP\JSString;

use PHPUnit\Framework\TestCase;

final class substrTest extends TestCase {
  function test_Demo_String_substr(): void {
    $str = String('Mozilla');

    self::assertEquals('oz', $str->substr(1, 2));
    self::assertEquals('zilla', $str->substr(2));
  }

  function test_Description(): void {
    $str = String('Mozilla');

    // If start >= str.length, an empty string is returned.
    self::assertEquals('', $str->substr(7));

    // If start < 0, the index starts counting from the end of the string. More formally, in this case the substring starts at max(start + str.length, 0).
    self::assertEquals('a', $str->substr(-1));
    self::assertEquals($str, $str->substr(-7));
    self::assertEquals($str, $str->substr(-8));

    // If start is omitted or undefined, it's treated as 0.
    self::assertEquals($str, $str->substr());

    // TODO: If length is omitted or undefined, or if start + length >= str.length, substr() extracts characters to the end of the string.

    // If length < 0, an empty string is returned.
    self::assertEquals('', $str->substr(0, -1));

    // For both start and length, NaN is treated as 0.
    self::assertEquals('', $str->substr(0, NaN));
    self::assertEquals('', $str->substr(NaN));
    self::assertEquals('', $str->substr(NaN, NaN));
  }

  function test_Using_substr(): void {
    $aString = String('Mozilla');

    self::assertEquals('M', $aString->substr(0, 1));
    self::assertEquals('', $aString->substr(1, 0));
    self::assertEquals('a', $aString->substr(-1, 1));
    self::assertEquals('', $aString->substr(1, -1));
    self::assertEquals('lla', $aString->substr(-3));
    self::assertEquals('ozilla', $aString->substr(1));
    self::assertEquals('Mo', $aString->substr(-20, 2));
    self::assertEquals('', $aString->substr(20, 2));
  }
}
