<?php

declare(strict_types=1);

namespace Tests\PHP\JSArray;

use JSArray;
use PHPUnit\Framework\TestCase;

final class forEachTest extends TestCase {
  function test_Description(): void {
    $ratings = JSArray([5, 4, 5]);
    $sum = 0;

    $sumFunction = function (int $a, int $b): int {
      return $a + $b;
    };

    $ratings->forEach(function (?int $rating) use (&$sum, $sumFunction): void {
      $sum = $sumFunction($sum, $rating);
    });

    self::assertSame(14, $sum);
  }

  function test_Using_forEach_on_sparse_arrays(): void {
    $arraySparse = JSArray([1, 3, undefined, 7]);
    $numCallbackRuns = 0;

    self::expectOutputString('137');

    $arraySparse->forEach(function ($element) use (&$numCallbackRuns): void {
      echo $element;
      ++$numCallbackRuns;
    });

    self::assertSame(3, $numCallbackRuns);
  }

  function test_Converting_a_for_loop_to_forEach(): void {
    $items = JSArray(['item1', 'item2', 'item3']);
    $copyItems = JSArray([]);

    for ($i = 0; $i < $items->length; ++$i) {
      $copyItems->push($items[$i]);
    }

    self::assertSame($items->values(), $copyItems->values());

    $copyItems = JSArray([]);
    $items->forEach(function (?string $item) use ($copyItems): void {
      $copyItems->push($item);
    });

    self::assertSame($items->values(), $copyItems->values());
  }

  function test_Printing_the_contents_of_an_array(): void {
    $logArrayElements = function (?int $element, int $index): void {
      echo "a[$index] = $element, ";
    };

    self::expectOutputString("a[0] = 2, a[1] = 5, a[3] = 9, ");
    JSArray([2, 5, undefined, 9])->forEach($logArrayElements);
  }

  function test_Using_thisArg(): void {
    $obj = new Counter;
    $obj->add(JSArray([2, 5, 9]));

    self::assertSame(3, $obj->count);
    self::assertSame(16, $obj->sum);
  }

  // function test_An_object_copy_function(): void {
  //   $copy = function ($obj) {
  //     $copy = Object::create(Object::getPrototypeOf($obj));
  //     $propNames = Object::getOwnPropertyNames($obj);

  //     $propNames->forEach(function ($name) use ($obj, $copy): void {
  //       $desc = Object::getOwnPropertyDescriptor($obj, $name);
  //       Object::defineProperty($copy, $name, $desc);
  //     });

  //     return $copy;
  //   };

  //   $obj1 = ['a' => 1, 'b' => 2];
  //   $obj2 = $copy($obj1); // obj2 looks like obj1 now

  //   self::assertSame($obj1, $obj2);
  // }

  // function test_Modifying_the_array_during_iteration(): void {
  //   $words = JSArray(['one', 'two', 'three', 'four']);

  //   $words->forEach(function (?string $word) use ($words): void {
  //     console::log($word);

  //     if ($word === 'two') {
  //       $words->shift(); //'one' will delete from array
  //     }
  //   }); // one // two // four

  //   console::log($words); // ['two', 'three', 'four']
  // }

  function test_Flatten_an_array(): void {
    $nested = JSArray([1, 2, 3, [4, 5, [6, 7], 8, 9]]);

    // self::expectOutputString('[1, 2, 3, 4, 5, 6, 7, 8, 9]');
    // console::log(self::flatten($nested));

    self::assertSame([1, 2, 3, 4, 5, 6, 7, 8, 9], self::flatten($nested)->values());
  }

  // function test_Calling_forEach_on_non_array_objects(): void {
  //   $arrayLike = new JSObject([
  //     'length' => 3,
  //     0 => 2,
  //     1 => 3,
  //     2 => 4,
  //     3 => 5, // ignored by forEach() since length is 3
  //   ]);

  //   self::expectOutputString('2, 3, 4, ');
  //   JSArray::prototype()->forEach->call($arrayLike, function (?int $x): void {
  //     console::log($x, ', ');
  //   });
  // }

  private static function flatten($arr): JSArray {
    $result = JSArray([]);

    $arr->forEach(function ($item) use ($result): void {
      if (JSArray::isArray($item)) {
        $result->push(...self::flatten(JSArray($item)));
      } else {
        $result->push($item);
      }
    });

    return $result;
  }
}
