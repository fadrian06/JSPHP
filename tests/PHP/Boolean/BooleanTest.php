<?php

declare(strict_types=1);

namespace Tests\PHP\Boolean;

use Boolean;
use JSString;
use PHPUnit\Framework\TestCase;

final class BooleanTest extends TestCase {
  function test_Boolean_primitives_and_Boolean_objects(): void {
    $x = new Boolean(false);
    self::assertTrue((bool) $x);

    /* This behavior does not apply to Boolean primitives. For example,
    the condition in the following if statement evaluates to false: */
    $x = false;
    self::assertNotTrue($x);

    /* Do not use the Boolean() constructor with new to convert a
    non-boolean value to a boolean value — use Boolean as a function or
    a double NOT instead: */
    // $good = Boolean($expression); // use this
    // $good2 = !!$expression; // or this
    // $bad = new Boolean($expression); // don't use this!

    /* If you specify any object, including a Boolean object whose value
    is false, as the initial value of a Boolean object, the new Boolean
    object has a value of true. */
    $myFalse = new Boolean(false); // initial value of false
    self::assertFalse($myFalse->valueOf());

    $g = Boolean($myFalse); // initial value of true
    self::assertTrue($g->valueOf());

    $myString = new JSString('Hello'); // string object
    $s = Boolean($myString); // initial value of true
    self::assertTrue($s->valueOf());
  }

  function test_Boolean_coercion(): void {
    self::assertTrue(Boolean(true)->valueOf());
    self::assertFalse(Boolean(false)->valueOf());
    self::assertFalse(Boolean(undefined)->valueOf());
    self::assertFalse(Boolean(null)->valueOf());
    self::assertFalse(Boolean(0)->valueOf());
    self::assertFalse(Boolean(-0)->valueOf());
    self::assertFalse(Boolean(NAN)->valueOf());
    self::assertTrue(Boolean(1)->valueOf());
    self::assertTrue(Boolean(-1.1)->valueOf());
    self::assertFalse(Boolean(BigInt(0))->valueOf());
    self::assertTrue(Boolean(BigInt(1))->valueOf());
    self::assertFalse(Boolean('')->valueOf());
    self::assertTrue(Boolean('non empty string')->valueOf());
    // self::assertTrue(Boolean(Symbol())->valueOf());

    /* Note that truthiness is not the same as being loosely equal to
    true or false. */
    // if ([]) {
    //   console.log("[] is truthy");
    // }
    // if ([] == false) {
    //   console.log("[] == false");
    // }
    // // [] is truthy
    // // [] == false
  }
}
