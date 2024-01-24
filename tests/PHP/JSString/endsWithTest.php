<?php

declare(strict_types=1);

namespace Tests\PHP\JSString;

use PHPUnit\Framework\TestCase;

final class endsWithTest extends TestCase {
  function test_Demo_String_endsWith(): void {
    $str1 = String('Cats are the best!');

    self::assertTrue($str1->endsWith('best!'));
    self::assertTrue($str1->endsWith('best', 17));

    $str2 = String('Is this a question?');
    self::assertFalse($str2->endsWith('question'));
  }

  function test_Using_endsWith(): void {
    $str = String('To be, or not to be, that is the question.');

    self::assertTrue($str->endsWith('question.'));
    self::assertFalse($str->endsWith('to be'));
    self::assertTrue($str->endsWith('to be', 19));
  }
}
