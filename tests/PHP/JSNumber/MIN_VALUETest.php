<?php

declare(strict_types=1);

namespace Tests\PHP\JSNumber;

use JSNumber;
use PHPUnit\Framework\TestCase;

final class MIN_VALUETest extends TestCase {
  function test_Try_it(): void {
    function divide($x, $y) {
      if ($x / $y < JSNumber::MIN_VALUE) {
        return 'Process as 0';
      }

      return $x / $y;
    }

    self::assertSame(5e-324, divide(5e-324, 1));
    self::assertSame('Process as 0', divide(5e-324, 2));
  }

  // function test_Using_MIN_VALUE(): void {
  //   if ($num1 / $num2 >= JSNumber::MIN_VALUE) {
  //     func1();
  //   } else {
  //     func2();
  //   }
  // }
}
