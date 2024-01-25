<?php

declare(strict_types=1);

namespace Tests\PHP\JSString;

use PHPUnit\Framework\TestCase;

final class lastIndexOfTest extends TestCase {
  function test_Demo_String_lastIndexOf(): void {
    $paragraph = String("I think Ruth's dog is cuter than your dog!");
    $searchTerm = 'dog';

    self::expectOutputString('Index of the last "dog" is 38');
    echo "Index of the last \"$searchTerm\" is {$paragraph->lastIndexOf($searchTerm)}";
  }

  function test_Parameters(): void {
    self::assertSame(-1, String('hello world hello')->lastIndexOf('world', 4));
    self::assertSame(12, String('hello world hello')->lastIndexOf('hello', 99));
    self::assertSame(0, String('hello world hello')->lastIndexOf('hello', 0));
    self::assertSame(0, String('hello world hello')->lastIndexOf('hello', -5));
  }

  function test_Description(): void {
    self::assertSame(3, String('canal')->lastIndexOf('a'));
    self::assertSame(1, String('canal')->lastIndexOf('a', 2));
    self::assertSame(-1, String('canal')->lastIndexOf('a', 0));
    self::assertSame(-1, String('canal')->lastIndexOf('x'));
    self::assertSame(0, String('canal')->lastIndexOf('c', -5));
    self::assertSame(0, String('canal')->lastIndexOf('c', 0));
    self::assertSame(5, String('canal')->lastIndexOf(''));
    self::assertSame(2, String('canal')->lastIndexOf('', 2));
  }

  function test_Case_sensitivity(): void {
    self::assertSame(-1, String('Blue Whale, Killer Whale')->lastIndexOf('blue'));
  }

  function test_Using_indexOf_and_lastIndexOf(): void {
    $anyString = String('Brave, Brave New World');

    self::assertSame(0, $anyString->indexOf('Brave'));
    self::assertSame(7, $anyString->lastIndexOf('Brave'));
  }
}
