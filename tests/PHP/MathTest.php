<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class MathTest extends TestCase {
  function test_cannot_create_a_Math_instance(): void {
    $this->expectException('Error');
    new Math; // @phpstan-ignore-line
  }

  function test_cannot_create_an_instance_from_a_Math_child_class(): void {
    $this->expectException('Error');
    new class() extends Math { // @phpstan-ignore-line
    };
  }

  /** @dataProvider absoluteValuesDataProvider */
  function test_can_return_the_abs_value_of_a_number($raw, $abs): void {
    self::assertSame($abs, Math::abs($raw));
  }

  /** @return array<string, array{int|float, int|float}> */
  static function absoluteValuesDataProvider(): array {
    return [
      'positives' => [1, 1],
      'negatives' => [-1, 1]
    ];
  }
}
