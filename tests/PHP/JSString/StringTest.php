<?php

declare(strict_types=1);

namespace Tests\PHP\JSString;

use JSString;
use PHPUnit\Framework\TestCase;

final class StringTest extends TestCase {
  function test_Creating_strings(): void {
    $string1 = String("A string primitive");
    $string2 = String('Also a string primitive');
    // $string3 = String(`Yet another string primitive`);
    $string4 = new JSString("A String object");

    self::assertInstanceOf(JSString::class, $string1);
    self::assertInstanceOf(JSString::class, $string2);
    // self::assertInstanceOf(JSString::class, $string3);
    self::assertInstanceOf(JSString::class, $string4);
  }

  function test_Character_access(): void {
    self::assertEquals('a', String("cat")->charAt(1));
    self::assertEquals('a', String("cat")[1]);
  }

  function test_Comparing_strings(): void {
    $a = String("a");
    $b = String("b");

    self::assertTrue($a < $b);

    $areEqualInUpperCase = function (string $str1, string $str2): bool {
      return String($str1)->toUpperCase() === String($str2)->toUpperCase();
    };

    $areEqualInLowerCase = function (string $str1, string $str2): bool {
      return String($str1)->toLowerCase() === String($str2)->toLowerCase();
    };

    // TODO
    // self::assertTrue($areEqualInUpperCase("ß", "ss"));
    self::assertFalse($areEqualInLowerCase("ı", "I"));

    $areEqual = function (string $str1, string $str2, string $locale = "en-US"): bool {
      return String($str1)->localeCompare($str2, $locale, ['sensitivity' => 'accent']) === 0;
    };

    self::assertFalse($areEqual("ß", "ss", "de"));
    // TODO
    // self::assertTrue($areEqual("ı", "I", "tr"));
  }

  function test_String_primitives_and_String_objects(): void {
    $strPrim = String("foo");
    $strPrim2 = String(1);
    $strPrim3 = String(true);
    $strObj = new JSString($strPrim);

    self::assertEquals('1', $strPrim2);
    self::assertEquals('true', $strPrim3);

    self::assertSame('string', gettype((string) $strPrim));
    self::assertSame('string', gettype((string) $strPrim2));
    self::assertSame('string', gettype((string) $strPrim3));
    self::assertSame('object', gettype($strObj));

    $s1 = String("2 + 2"); // creates a string primitive
    $s2 = new JSString("2 + 2"); // creates a String object

    self::assertSame(4, jsEval($s1));
    self::assertSame('2 + 2', jsEval($s2));

    self::assertSame(4, jsEval($s2->valueOf()));
  }

  function test_String_coercion(): void {
    self::assertEquals('string', String('string'));
    self::assertEquals('undefined', String(undefined));
    self::assertEquals('null', String(null));
    self::assertEquals('true', String(true));
    self::assertEquals('false', String(false));
    // TODO: Numbers are converted with the same algorithm as toString(10).
    // TODO: BigInts are converted with the same algorithm as toString(10).
    // TODO: Symbols throw a TypeError.
    /*
      TODO: Objects are first converted to a primitive by calling its
      [Symbol.toPrimitive]() (with "string" as hint), toString(), and valueOf()
      methods, in that order. The resulting primitive is then converted to a
      string.
     */

    /*
      TODO: Template literal: `${x}` does exactly the string coercion steps
      explained above for the embedded expression.
    */
    /*
      TODO: The String() function: String(x) uses the same algorithm to convert
      x, except that Symbols don't throw a TypeError, but return
      "Symbol(description)", where description is the description of the Symbol.
    */
    /*
      TODO: Using the + operator: "" + x coerces its operand to a primitive
      instead of a string, and, for some objects, has entirely different
      behaviors from normal string coercion. See its reference page for more
      details.
     */
  }

  /*function test_UTF_16_characters_Unicode_code_points_and_grapheme_clusters(): void {
    String("😄")->split(""); // ['\ud83d', '\ude04']; splits into two lone surrogates

    // "Backhand Index Pointing Right: Dark Skin Tone"
    // [..."👉🏿"]; // ['👉', '🏿']
    // splits into the basic "Backhand Index Pointing Right" emoji and
    // the "Dark skin tone" emoji

    // "Family: Man, Boy"
    // [..."👨‍👦"]; // [ '👨', '‍', '👦' ]
    // splits into the "Man" and "Boy" emoji, joined by a ZWJ

    // The United Nations flag
    // [..."🇺🇳"]; // [ '🇺', '🇳' ]
    // splits into two "region indicator" letters "U" and "N".
    // All flag emojis are formed by joining two region indicator letters
  }*/

  function test_HTML_wrapper_methods(): void {
    self::assertEquals('<b></b></b>', String('</b>')->bold());

    self::assertEquals(
      '<a name="&quot;Hello&quot;">foo</a>',
      String("foo")->anchor('"Hello"')
    );
  }

  function test_String_conversion(): void {
    $nullVar = null;
    // TODO
    // $nullVar->toString(); // TypeError: Cannot read properties of null
    self::assertEquals('null', String($nullVar));

    $undefinedVar = undefined;
    // TODO
    // $undefinedVar->toString(); // TypeError: Cannot read properties of undefined
    self::assertEquals('undefined', String($undefinedVar));

  }

  private function areEqualCaseInsensitive(JSString $str1, JSString $str2): bool {
    return $str1->toUpperCase() === $str2->toUpperCase();
  }
}
