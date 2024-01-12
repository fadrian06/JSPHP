<?php

declare(strict_types=1);

namespace Tests\PHP\Boolean;

use Boolean;
use PHPUnit\Framework\TestCase;

final class toStringTest extends TestCase {
  function test_Boolean_prototype_toString(): void {
    $flag1 = new Boolean(true);

    self::expectOutputString('true');
    echo $flag1->toString();

    $flag2 = new Boolean(1);
    self::assertSame('true', $flag2->toString());
  }

  function test_Using_toString(): void {
    $flag = new Boolean(true);

    self::expectOutputString('true');
    echo $flag->toString();

    self::assertSame('false', Boolean(false)->toString());
  }

  function test_Description(): void {
    Boolean::prototype()->toString = function (): string {
      return 'Overridden';
    };

    self::assertSame('true', '' . true ? 'true' : 'false');
    self::assertSame('Overridden', '' . new Boolean(true));
  }

}
