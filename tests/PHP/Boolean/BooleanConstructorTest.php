<?php

declare(strict_types=1);

namespace Tests\PHP\Boolean;

use Boolean;
use JSObject;
use PHPUnit\Framework\TestCase;

final class BooleanConstructorTest extends TestCase {
  function test_Boolean_constructor(): void {
    $flag = new Boolean();

    self::expectOutputString('false');
    echo $flag;
  }

  function test_Creating_Boolean_objects_with_an_initial_value_of_false(): void {
    $bZero = new Boolean(0);
    $bNull = new Boolean(null);
    $bEmptyString = new Boolean('');
    $bfalse = new Boolean(false);

    self::assertFalse($bZero->valueOf());
    self::assertFalse($bNull->valueOf());
    self::assertFalse($bEmptyString->valueOf());
    self::assertIsObject($bfalse);
    self::assertTrue((bool) Boolean($bfalse));

    /* If you need to take the primitive value out from the wrapper object,
    instead of using the Boolean() function, use the object's valueOf()
    method instead. */
    $bfalse = new Boolean(false);

    self::assertFalse($bfalse->valueOf());
  }

  function test_Creating_Boolean_objects_with_an_initial_value_of_true(): void {
    $btrue = new Boolean(true);
    $btrueString = new Boolean('true');
    $bfalseString = new Boolean('false');
    $bSuLin = new Boolean('Su Lin');
    $bArrayProto = new Boolean([]);
    $bObjProto = new Boolean(new JSObject);

    self::assertTrue($btrue->valueOf());
    self::assertTrue($btrueString->valueOf());
    self::assertTrue($bfalseString->valueOf());
    self::assertTrue($bSuLin->valueOf());
    self::assertTrue($bArrayProto->valueOf());
    self::assertTrue($bObjProto->valueOf());
  }
}
