<?php

declare(strict_types=1);

namespace Tests\PHP\Boolean;

use Boolean;
use PHPUnit\Framework\TestCase;

final class valueOfTest extends TestCase {
  function test_Try_it(): void {
    $x = new Boolean;
    self::assertFalse($x->valueOf());

    $y = new Boolean('Mozilla');
    self::assertTrue($y->valueOf());
  }

  function test_Using_valueOf(): void {
    $x = new Boolean;
    $myVar = $x->valueOf();

    self::assertFalse($myVar);
  }
}
