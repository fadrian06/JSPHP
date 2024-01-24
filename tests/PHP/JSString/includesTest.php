<?php

declare(strict_types=1);

namespace Tests\PHP\JSString;

use PHPUnit\Framework\TestCase;

final class includesTest extends TestCase {
  function test_Demo_String_includes(): void {
    $sentence = String('The quick brown fox jumps over the lazy dog.');
    $word = 'fox';

    self::expectOutputString('The word "fox" is in the sentence');
    printf('The word "%s" %s in the sentence', $word, $sentence->includes($word) ? 'is' : 'is not');
  }

  function test_Case_sensitivity(): void {
    self::assertFalse(String('Blue Whale')->includes('blue'));

    /* You can work around this constraint by transforming both the original
    string and the search string to all lowercase: */
    self::assertTrue(String('Blue Whale')->toLowerCase()->includes('blue'));
  }

  function test_Using_includes(): void {
    $str = String('To be, or not to be, that is the question.');

    self::assertTrue($str->includes('To be'));
    self::assertTrue($str->includes('question'));
    self::assertFalse($str->includes('nonexistent'));
    self::assertFalse($str->includes('To be', 1));
    self::assertFalse($str->includes('TO BE'));
    self::assertTrue($str->includes(''));
  }
}
