<?php

declare(strict_types=1);

namespace Tests\PHP\JSArray;

use OutOfRangeException;
use PHPUnit\Framework\TestCase;

final class lengthTest extends TestCase {
  function test_Demo_Array_length(): void {
    $clothing = JSArray(['shoes', 'shirts', 'socks', 'sweaters']);

    self::assertSame(4, $clothing->length);
  }

  function test_Description(): void {
    $listA = JSArray([1, 2, 3]);
    $listB = JSArray(6);

    self::assertSame(3, $listA->length);
    self::assertSame(6, $listB->length);

    self::expectException(OutOfRangeException::class);
    self::expectExceptionMessage('Invalid array length');

    $listB->length = 2 ** 32;
    $listC = JSArray(-100);
  }

  function test_Setting_length(): void {
    $arr = JSArray([1, 2]);
    self::assertSame([1, 2], $arr->values());

    $arr->length = 5;
    self::assertSame([1, 2, null, null, null], $arr->values());

    self::expectOutputString('12');

    $arr->forEach(function (?int $element): void {
      echo $element;
    });
  }

  function test_Iterating_over_an_array(): void {
    $numbers = JSArray([1, 2, 3, 4, 5]);
    $length = $numbers->length;

    for ($i = 0; $i < $length; ++$i) {
      $numbers[$i] *= 2;
    }

    self::assertSame([2, 4, 6, 8, 10], $numbers->values());
  }

  function test_Shortening_an_array(): void {
    $numbers = JSArray([1, 2, 3, 4, 5]);

    if ($numbers->length > 3) {
      $numbers->length = 3;
    }

    self::assertSame([1, 2, 3], $numbers->values());
    self::assertSame(3, $numbers->length);
    // TODO
    // self::assertSame(undefined, $numbers[3]);
    self::assertSame(null, $numbers[3]);
  }

  function test_Create_empty_array_of_fixed_length(): void {
    $numbers = JSArray([]);
    $numbers->length = 3;

    self::assertSame([null, null, null], $numbers->values());
  }

  // function test_Array_with_non_writable_length(): void {
  //   'use strict';

  //   $numbers = new JSArray([1, 2, 3, 4, 5]);

  //   Object::defineProperty($numbers, 'length', [ 'writable' => false ]);
  //   $numbers[5] = 6; // TypeError: Cannot assign to read only property 'length' of object '[object Array]'
  //   $numbers->push(5); // TypeError: Cannot assign to read only property 'length' of object '[object Array]'
  // }
}
