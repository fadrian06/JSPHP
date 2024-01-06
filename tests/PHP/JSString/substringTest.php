<?php

declare(strict_types=1);

namespace Tests\PHP\JSString;

use JSString;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../../vendor/autoload.php';

final class substringTest extends TestCase {
  function test_Demo_String_substring(): void {
    $str = String('Mozilla');

    self::assertEquals('oz', $str->substring(1, 3));
    self::assertEquals('zilla', $str->substring(2));
  }

  function test_Using_substring(): void {
    $anyString = String('Mozilla');

    self::assertEquals('M', $anyString->substring(0, 1));
    self::assertEquals('M', $anyString->substring(1, 0));
    self::assertEquals('Mozill', $anyString->substring(0, 6));
    self::assertEquals('lla', $anyString->substring(4));
    self::assertEquals('lla', $anyString->substring(4, 7));
    self::assertEquals('lla', $anyString->substring(7, 4));
    self::assertEquals('Mozilla', $anyString->substring(0, 7));
    self::assertEquals('Mozilla', $anyString->substring(0, 10));
  }

  function test_Using_substring_with_length_property(): void {
    $text = String('Mozilla');

    self::assertEquals('illa', $text->substring($text->length - 4));
    self::assertEquals('zilla', $text->substring($text->length - 5));
  }

  function test_The_difference_between_substring_and_substr(): void {
    $text = String('Mozilla');

    self::assertEquals('zil', $text->substring(2, 5));
    // self::assertEquals('zil', $text->substr(2, 3)); // TODO
  }

  function test_Differences_between_substring_and_slice(): void {
    $text = String('Mozilla');

    self::assertEquals('zil', $text->substring(5, 2));
    // self::assertEquals("", $text->slice(5, 2)); // TODO

    /* If either or both of the arguments are negative or NaN, the substring()
    method treats them as if they were 0. */
    self::assertEquals('Mo', $text->substring(-5, 2));
    self::assertEquals('', $text->substring(-5, -2));

    /* slice() also treats NaN arguments as 0, but when it is given negative
    values it counts backwards from the end of the string to find the indexes. */
    // self::assertEquals('', $text->slice(-5, 2)); // TODO
    // self::assertEquals('zil', $text->slice(-5, -2)); // TODO
  }

  function test_Replacing_a_substring_within_a_string(): void {
    // Replaces oldS with newS in the string fullS
    $replaceString = function (JSString $oldS, string $newS, JSString $fullS): JSString {
      for ($i = 0; $i < $fullS->length; ++$i) {
        if ($fullS->substring($i, $i + $oldS->length) == $oldS) {
          $fullS = String($fullS->substring(0, $i) . $newS . $fullS->substring($i + $oldS->length, $fullS->length));
        }
      }

      return $fullS;
    };

    // $replaceStringBetterMethod = function (string $oldS, string $newS, JSString $fullS): JSString {
    //   return $fullS->split($oldS)->join($newS); // TODO
    // };

    self::assertEquals('Brave New Web', $replaceString(String('World'), 'Web', String('Brave New World')));
    // self::assertEquals('Brave New Web', $replaceStringBetterMethod('World', 'Web', String('Brave New World')));
  }
}
