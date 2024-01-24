<?php

declare(strict_types=1);

namespace Tests\PHP\JSString;

use JSObject;
use PHPUnit\Framework\TestCase;

final class concatTest extends TestCase {
  function test_Demo_String_concat(): void {
    $str1 = String('Hello');
    $str2 = String('World');

    self::expectOutputString('Hello World');
    echo $str1->concat(' ', $str2);

    self::assertEquals('World, Hello', $str2->concat(', ', $str1));
  }

  function test_Using_concat(): void {
    $hello = String('Hello, ');

    self::expectOutputString('Hello, Kevin. Have a nice day.');
    echo $hello->concat('Kevin', '. Have a nice day.');

    $greetList = ['Hello', ' ', 'Venkat', '!'];
    self::assertEquals('Hello Venkat!', String('')->concat(...$greetList));

    self::assertEquals('[object Object]', String('')->concat(new JSObject));
    self::assertEquals('', String('')->concat([]));
    self::assertEquals('null', String('')->concat(null));
    self::assertEquals('true', String('')->concat(true));
    self::assertEquals('45', String('')->concat(4, 5));
  }
}
