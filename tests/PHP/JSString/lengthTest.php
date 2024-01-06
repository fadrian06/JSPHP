<?php

declare(strict_types=1);

namespace Tests\PHP\JSString;

use PHPUnit\Framework\TestCase;

final class lengthTest extends TestCase {
  function test_Demo_String_length(): void {
    $str = String('Life, the universe and everything. Answer:');

    self::expectOutputString('Life, the universe and everything. Answer: 42');
    echo "$str $str->length";
  }

  // function test_getCharacterLength(): void {
  //   $getCharacterLength = function (string $str): int {
  //     // The string iterator that is used here iterates over characters,
  //     // not mere code units
  //     return [...$str]->length;
  //   };

  //   self::expectOutputString('3');
  //   echo $getCharacterLength('A\uD87E\uDC04Z');
  // }

  /** @dataProvider String_length_basic_usage */
  function test_String_length_basic_usage(string $echoString, string $expectedString): void {
    self::expectOutputString($expectedString);
    echo $echoString;
  }

  /*function test_Strings_with_length_not_equal_to_the_number_of_characters(): void {
    const emoji = "😄";
    console.log(emoji.length); // 2
    console.log([...emoji].length); // 1
    const adlam = "𞤲𞥋𞤣𞤫";
    console.log(adlam.length); // 8
    console.log([...adlam].length); // 4
    const formula = "∀𝑥∈ℝ,𝑥²≥0";
    console.log(formula.length); // 11
    console.log([...formula].length); // 9
  }*/

  function test_Assigning_to_length(): void {
    $myString = String('bluebells');
    $myString->length = 4;

    self::expectOutputString('bluebells9');
    echo $myString;
    echo $myString->length;
  }

  static function String_length_basic_usage(): array {
    $x = String('Mozilla');
    $empty = String('');

    return [
      ["$x is $x->length code units long", 'Mozilla is 7 code units long'],
      ["The empty string has a length of $empty->length", 'The empty string has a length of 0']
    ];
  }
}
