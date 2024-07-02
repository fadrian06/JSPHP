<?php

declare(strict_types=1);

namespace Tests\PHP\Math;

use Math;
use PHPUnit\Framework\TestCase;
use Throwable;

final class DescriptionTest extends TestCase {
  function test_cannot_use_it_with_new_operator(): void {
    try {
      new Math;
    } catch (Throwable $error) {
      self::assertInstanceOf('\Error', $error);
    }
  }

  function test_cannot_invoke_Math_object_as_a_function(): void {
    try {
      Math();
    } catch (Throwable $error) {
      self::assertInstanceOf('\Error', $error);
    }
  }
}
