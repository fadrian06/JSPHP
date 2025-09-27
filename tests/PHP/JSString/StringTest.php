<?php

declare(strict_types=1);

namespace Tests\PHP\JSString;

use console;
use JSString;
use PHPUnit\Framework\TestCase;
use TypeError;

final class StringTest extends TestCase {
  function test_Creating_strings(): void {
    // Strings can be created as primitives, from string literals, or as objects, using the String() constructor:
    $string1 = String("A string primitive");
    $string2 = String('Also a string primitive');
    // $string3 = String(`Yet another string primitive`);
    $string4 = new JSString("A String object");

    self::assertEquals("A string primitive", $string1);
    self::assertEquals("Also a string primitive", $string2);
    // self::assertEquals("Yet another string primitive", $string3);
    self::assertEquals("A String object", $string4);

    // String primitives and string objects share many behaviors, but have other important differences and caveats. See "String primitives and String objects" below.

    // String literals can be specified using single or double quotes, which are treated identically, or using the backtick character `. This last form specifies a template literal: with this form you can interpolate expressions. For more information on the syntax of string literals, see lexical grammar.
  }

  function test_Character_access(): void {
    // There are two ways to access an individual character in a string. The first is the charAt() method:
    self::assertEquals("a", String("cat")->charAt(1));

    // The other way is to treat the string as an array-like object, where individual characters correspond to a numerical index:
    self::assertEquals("a", String("cat")[1]);

    // When using bracket notation for character access, attempting to delete or assign a value to these properties will not succeed. The properties involved are neither writable nor configurable. (See Object.defineProperty() for more information.)
    $str = String("cat");
    $str[1] = "x"; // does nothing, silently fails
    self::assertEquals("a", $str[1]);
    unset($str[1]); // does nothing, silently fails
    self::assertEquals("a", $str[1]);
  }

  function test_Comparing_strings(): void {
    // Use the less-than and greater-than operators to compare strings:
    $a = String("a");
    $b = String("b");

    if ($a < $b) {
      // true
      self::expectOutputString("a is less than b");
      console::log("$a is less than $b");
    } else if ($a > $b) {
      self::expectOutputString("a is greater than b");
      console::log("$a is greater than $b");
    } else {
      self::expectOutputString("a and b are equal.");
      console::log("$a and $b are equal.");
    }

    // Note that all comparison operators, including === and ==, compare strings case-sensitively. A common way to compare strings case-insensitively is to convert both to the same case (upper or lower) before comparing them.
    $areEqualCaseInsensitive = function (JSString $str1, JSString $str2): bool {
      return $str1->toUpperCase() == $str2->toUpperCase();
    };

    // The choice of whether to transform by toUpperCase() or toLowerCase() is mostly arbitrary, and neither one is fully robust when extending beyond the Latin alphabet. For example, the German lowercase letter ß and ss are both transformed to SS by toUpperCase(), while the Turkish letter ı would be falsely reported as unequal to I by toLowerCase() unless specifically using toLocaleLowerCase("tr").
    $areEqualInUpperCase = function (JSString $str1, JSString $str2): bool {
      return $str1->toUpperCase() == $str2->toUpperCase();
    };

    $areEqualInLowerCase = function (JSString $str1, JSString $str2): bool {
      return $str1->toLowerCase() == $str2->toLowerCase();
    };

    self::assertTrue($areEqualInUpperCase(String("ß"), String("ss"))); // true; should be false
    self::assertFalse($areEqualInLowerCase(String("ı"), String("I"))); // false; should be true

    // A locale-aware and robust solution for testing case-insensitive equality is to use the Intl.Collator API or the string's localeCompare() method — they share the same interface — with the sensitivity option set to "accent" or "base".
    $areEqual = function (JSString $str1, string $str2, string $locale = "en-US"): bool {
      return $str1->localeCompare($str2, $locale, ["sensitivity" => "accent"]) === 0;
    };

    self::assertFalse($areEqual(String("ß"), "ss", "de"));
    self::assertTrue($areEqual(String("ı"), "I", "tr"));

    // The localeCompare() method enables string comparison in a similar fashion as strcmp() — it allows sorting strings in a locale-aware manner.
  }

  function test_String_primitives_and_String_object(): void {
    // Note that JavaScript distinguishes between String objects and primitive string values. (The same is true of Boolean and Numbers.)

    // String literals (denoted by double or single quotes) and strings returned from String calls in a non-constructor context (that is, called without using the new keyword) are primitive strings. In contexts where a method is to be invoked on a primitive string or a property lookup occurs, JavaScript will automatically wrap the string primitive and call the method or perform the property lookup on the wrapper object instead.
    $strPrim = String("foo"); // A literal is a string primitive
    $strPrim2 = String(1); // Coerced into the string primitive "1"
    $strPrim3 = String(true); // Coerced into the string primitive "true"
    $strObj = new JSString($strPrim); // String with new returns a string wrapper object.

    // console::log(typeof($strPrim)); // "string"
    // console::log(typeof($strPrim2)); // "string"
    // console::log(typeof($strPrim3)); // "string"
    // console::log(typeof($strObj)); // "object"
    self::assertSame("string", typeof($strPrim));
    self::assertSame("string", typeof($strPrim2));
    self::assertSame("string", typeof($strPrim3));
    self::assertSame("object", typeof($strObj));

    // Warning: You should rarely find yourself using String as a constructor.

    // String primitives and String objects also give different results when using eval(). Primitives passed to eval are treated as source code; String objects are treated as all other objects are, by returning the object. For example:
    $s1 = String("2 + 2"); // creates a string primitive
    $s2 = new JSString("2 + 2"); // creates a String object
    // console::log(jsEval($s1)); // returns the number 4
    self::assertSame(4, jsEval($s1));
    // console::log(jsEval($s2)); // returns the string "2 + 2"
    self::assertSame("2 + 2", jsEval($s2));

    // For these reasons, the code may break when it encounters String objects when it expects a primitive string instead, although generally, authors need not worry about the distinction.

    // A String object can always be converted to its primitive counterpart with the valueOf() method.
    // console::log(jsEval($s2->valueOf())); // returns the number 4
    self::assertSame(4, jsEval($s2->valueOf()));
  }

  function test_String_coercion(): void {
    // Many built-in operations that expect strings first coerce their arguments to strings (which is largely why String objects behave similarly to string primitives). The operation can be summarized as follows:

    // Strings are returned as-is.
    self::assertEquals("foo", String("foo"));

    // undefined turns into "undefined".
    self::assertEquals("undefined", String(undefined));

    // null turns into "null".
    self::assertEquals("null", String(null));

    // true turns into "true"; false turns into "false".
    self::assertEquals("true", String(true));
    self::assertEquals("false", String(false));

    // Numbers are converted with the same algorithm as toString(10).
    self::assertEquals("123", String(123));

    // BigInts are converted with the same algorithm as toString(10).
    // self::assertEquals("123", String(123n));

    // TODO: Symbols throw a TypeError.
    // self::expectException(TypeError::class);
    // String(Symbol("desc"));

    // TODO: Objects are first converted to a primitive by calling its [Symbol.toPrimitive]() (with "string" as hint), toString(), and valueOf() methods, in that order. The resulting primitive is then converted to a string.

    // There are several ways to achieve nearly the same effect in JavaScript.

    // TODO: Template literal: `${x}` does exactly the string coercion steps explained above for the embedded expression.
    // The String() function: String(x) uses the same algorithm to convert x, except that Symbols don't throw a TypeError, but return "Symbol(description)", where description is the description of the Symbol.

    // TODO: Using the + operator: "" + x coerces its operand to a primitive instead of a string, and, for some objects, has entirely different behaviors from normal string coercion. See its reference page for more details.

    // TODO: Depending on your use case, you may want to use `${x}` (to mimic built-in behavior) or String(x) (to handle symbol values without throwing an error), but you should not use "" + x.
  }
}
