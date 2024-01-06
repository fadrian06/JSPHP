<?php

declare(strict_types=1);

namespace Tests\PHP\JSString;

use PHPUnit\Framework\TestCase;

final class indexOfTest extends TestCase {
  /** @dataProvider Demo_String_indexOf */
  function test_Demo_String_indexOf(string $echoString, string $expectedString): void {
    self::expectOutputString($echoString);
    echo $expectedString;
  }

  function test_Return_value_when_using_an_empty_search_string(): void {
    /* Searching for an empty search string produces strange results. With no
    second argument, or with a second argument whose value is less than the
    calling string's length, the return value is the same as the value of the
    second argument: */
    self::assertSame(0, String('hello world')->indexOf(''));
    self::assertSame(0, String('hello world')->indexOf('', 0));
    self::assertSame(3, String('hello world')->indexOf('', 3));
    self::assertSame(8, String('hello world')->indexOf('', 8));

    /* However, with a second argument whose value is greater than or equal to
    the string's length, the return value is the string's length: */
    self::assertSame(11, String('hello world')->indexOf('', 11));
    self::assertSame(11, String('hello world')->indexOf('', 13));
    self::assertSame(11, String('hello world')->indexOf('', 22));
  }

  function test_Description(): void {
    self::assertSame(0, String('Blue Whale')->indexOf('Blue'));
    self::assertSame(-1, String('Blue Whale')->indexOf('Blute'));
    self::assertSame(5, String('Blue Whale')->indexOf('Whale', 0));
    self::assertSame(5, String('Blue Whale')->indexOf('Whale', 5));
    self::assertSame(-1, String('Blue Whale')->indexOf('Whale', 7));
    self::assertSame(0, String('Blue Whale')->indexOf(''));
    self::assertSame(9, String('Blue Whale')->indexOf('', 9));
    self::assertSame(10, String('Blue Whale')->indexOf('', 10));
    self::assertSame(10, String('Blue Whale')->indexOf('', 11));

    /* The indexOf() method is case sensitive. For example, the following
    expression returns -1: */
    self::assertSame(-1, String('Blue Whale')->indexOf('blue'));
  }

  function test_Checking_occurrences(): void {
    self::assertTrue(String('Blue Whale')->indexOf('Blue') !== -1);
    self::assertFalse(String('Blue Whale')->indexOf('Bloe') !== -1);
  }

  function test_Using_indexOf(): void {
    $str = String('Brave new world');

    self::assertSame(8, $str->indexOf('w'));
    self::assertSame(6, $str->indexOf('new'));
  }

  function test_indexOf_and_case_sensitivity(): void {
    $myString = String('brie, pepper jack, cheddar');
    $myCapString = String('Brie, Pepper Jack, Cheddar');

    self::assertSame(19, $myString->indexOf('cheddar'));
    self::assertSame(-1, $myCapString->indexOf('cheddar'));
  }

  function test_Using_indexOf_to_count_occurrences_of_a_letter_in_a_string(): void {
    $str = String('To be, or not to be, that is the question.');
    $count = 0;
    $position = $str->indexOf('e');

    while ($position !== -1) {
      ++$count;
      $position = $str->indexOf('e', $position + 1);
    }

    self::assertSame(4, $count);
  }

  static function Demo_String_indexOf(): array {
    $paragraph = String("I think Ruth's dog is cuter than your dog!");
    $searchTerm = 'dog';
    $indexOfFirst = $paragraph->indexOf($searchTerm);

    return [
      ["The index of the first \"$searchTerm\" is $indexOfFirst", 'The index of the first "dog" is 15'],
      ["The index of the second \"$searchTerm\" is {$paragraph->indexOf($searchTerm, $indexOfFirst + 1)}", 'The index of the second "dog" is 38']
    ];
  }
}
