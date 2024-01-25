<?php

declare(strict_types=1);

namespace Tests\PHP\JSString;

use PHPUnit\Framework\TestCase;

final class padEndTest extends TestCase {
  function test_Demo_String_padEnd(): void {
    $str1 = String('Breaded Mushrooms');

    self::expectOutputString('Breaded Mushrooms........');
    echo $str1->padEnd(25, '.');

    $str2 = String('200');
    self::assertEquals('200  ', $str2->padEnd(5));
  }

  function test_Using_padEnd(): void {
    self::assertEquals('abc       ', String('abc')->padEnd(10));
    self::assertEquals('abcfoofoof', String('abc')->padEnd(10, 'foo'));
    self::assertEquals('abc123', String('abc')->padEnd(6, '123456'));
    self::assertEquals('abc', String('abc')->padEnd(1));
  }
}
