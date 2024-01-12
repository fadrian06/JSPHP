<?php

declare(strict_types=1);

namespace Tests\PHP\JSON;

use JSBoolean;
use JSDate;
use JSNumber;
use JSObject;
use JSON;
use JSString;
use PHPUnit\Framework\TestCase;

final class stringifyTest extends TestCase {
  // function test_Try_it(): void {
  //   self::assertSame('{"x":5,"y":6}', JSON::stringify(['x' => 5, 'y' => 6]));
  //   self::assertSame('[3,"false",false]', JSON::stringify([new JSNumber(3), new JSString('false'), new JSBoolean(false)]));
  //   self::assertSame('{"x":[10,null,null,null]}', JSON::stringify(['x' => [10, undefined, function () {
  //   }, Symbol('')]]));
  //   self::assertSame('"2006-01-02T15:04:05.000Z"', JSON::stringify(new JSDate(2006, 0, 2, 15, 4, 5)));
  // }

  function test_Using_JSON_stringify(): void {
    self::assertSame('{}', JSON::stringify(new JSObject));
    self::assertSame('true', JSON::stringify(true));
    self::assertSame('"foo"', JSON::stringify('foo'));
    self::assertSame('[1,"false",false]', JSON::stringify([1, "false", false]));
    self::assertSame('[null,null,null]', JSON::stringify([NAN, null, Infinity]));
    self::assertSame('{"x":5}', JSON::stringify(['x' => 5]));
    // self::assertSame('"1906-01-02T15:04:05.000Z"', JSON::stringify(new JSDate(1906, 0, 2, 15, 4, 5)));
    self::assertSame('{"x":5,"y":6}', JSON::stringify(['x' => 5, 'y' => 6]));
    self::assertSame('[3,"false",false]', JSON::stringify([new JSNumber(3), new JSString("false"), new JSBoolean(false)]));

    // String-keyed array elements are not enumerable and make no sense in JSON
    $a = ['foo', 'bar'];
    $a['baz'] = 'quux';
    self::assertSame(['foo', 'bar', 'baz' => 'quux'], $a);
    self::assertSame('["foo","bar"]', JSON::stringify($a));
    self::assertSame(
      '{"x":[10,null,null,null]}',
      JSON::stringify([
        'x' => [
          10,
          undefined,
          function (): void {
          },
          Symbol('')
        ]
      ])
    );

    /*// Standard data structures
    self::assertSame(
      '[{},{},{},{}]',
      JSON::stringify([
        new Set([1]),
        new Map([[1, 2]]),
        new WeakSet([['a' => 1]]),
        new WeakMap([[['a' => 1], 2]])
      ])
    );

    // TypedArray
    self::assertSame('[{"0":1},{"0":1},{"0":1}]', JSON::stringify([new Int8Array([1]), new Int16Array([1]), new Int32Array([1])]));
    self::assertSame(
      '[{"0":1},{"0":1},{"0":1},{"0":1}]',
      JSON::stringify([
        new Uint8Array([1]),
        new Uint8ClampedArray([1]),
        new Uint16Array([1]),
        new Uint32Array([1])
      ])
    );
    self::assertSame('[{"0":1},{"0":1}]', JSON::stringify([new Float32Array([1]), new Float64Array([1])]));

    // toJSON()
    self::assertSame('11', JSON::stringify([
      'x' => 5,
      'y' => 6,
      'toJSON' => function (): string {
        return $this->x + $this->y;
      }
    ]));

    // Symbols:
    self::assertSame('{}', JSON::stringify(['x' => undefined, 'y' => Object, 'z' => Symbol('')]));
    self::assertSame('{}', JSON::stringify([Symbol('foo') => 'foo']));
    self::assertSame('{}', JSON::stringify([Symbol::for('foo') => 'foo'], Symbol::for('foo')));*/
    /*JSON::stringify({ [Symbol.for("foo")]: "foo" }, (k, v) => {
      if (typeof k === "symbol") {
        return "a symbol";
      }
    });
    // undefined

    // Non-enumerable properties:
    JSON::stringify(
      Object.create(null, {
        x: { value: "x", enumerable: false },
        y: { value: "y", enumerable: true },
      }),
    );
    // '{"y":"y"}'

    // BigInt values throw
    JSON::stringify({ x: 2n });
    // TypeError: BigInt value can't be serialized in JSON*/
  }

  // function test_Using_a_function_as_replacer(): void {
  //   function replacer(string $key, $value) {
  //     // Filtering out properties
  //     if (is_string($value)) {
  //       return undefined;
  //     }

  //     return $value;
  //   }

  //   $foo = [
  //     'foundation' => 'Mozilla',
  //     'model' => 'box',
  //     'week' => 45,
  //     'transport' => 'car',
  //     'month' => 7
  //   ];

  //   self::assertSame('{"week":45,"month":7}', JSON::stringify($foo, 'replacer'));

  //   /* If you wish the replacer to distinguish an initial object from a
  //   key with an empty string property (since both would give the empty
  //   string as key and potentially an object as value), you will have to
  //   keep track of the iteration count (if it is beyond the first iteration,
  //   it is a genuine empty string key). */
  //   function makeReplacer() {
  //     $isInitial = true;

  //     return function (string $key, $value) use (&$isInitial) {
  //       if ($isInitial) {
  //         $isInitial = false;

  //         return $value;
  //       }

  //       if ($key === '') {
  //         // Omit all properties with name "" (except the initial object)
  //         return undefined;
  //       }

  //       return $value;
  //     };
  //   }

  //   $replacer = makeReplacer();
  //   self::assertSame('{"b":2}', JSON::stringify([ '' => 1, 'b' => 2 ], $replacer));
  // }

  /*function test_Using_an_array_as_replacer(): void {
    $foo = [
      'foundation' => 'Mozilla',
      'model' => 'box',
      'week' => 45,
      'transport' => 'car',
      'month' => 7
    ];

    self::assertSame('{"week":45,"month":7}', JSON::stringify($foo, ["week", "month"]));
  }*/

//   function test_Using_the_space_parameter(): void {
//     self::expectOutputString(<<<OUTPUT
// {
//  "a": 2
// }
// OUTPUT);
//     echo JSON::stringify([ 'a' => 2 ], null, ' ');

//     /* Using a tab character mimics standard pretty-print appearance: */
//     $expected = <<<OUTPUT
// {
// \t"uno": 1,
// \t"dos": 2
// }
// OUTPUT;
//     $result = JSON::stringify([ 'uno' => 1, 'dos' => 2 ], null, "\t");
//     self::assertSame($expected, $result);
//   }

  /*function test_toJSON_behavior(): void {
    $obj = [
      'data' => 'data',
      'toJSON' => function ($key = null) {
        return $key ? `Now I am a nested object under key '$key'` : $this;
      }
    ];

    self::assertSame('{"data":"data"}', JSON::stringify($obj));
    self::assertSame('{"obj":"Now I am a nested object under key \'obj\'"}', JSON::stringify([ 'obj' => $obj ]));
    self::assertSame('["Now I am a nested object under key \'0\'"]', JSON::stringify([$obj]));
  }*/

  /*function test_Issue_with_serializing_circular_references(): void {
    $circularReference = new JSObject([]);
    $circularReference->myself = $circularReference;

    // Serializing circular references throws "TypeError: cyclic object value"
    JSON::stringify($circularReference);
  }*/

  /*function test_Using_JSON_stringify_with_localStorage(): void {
    // Creating an example of JSON
    const session = {
      screens: [],
      state: true,
    };
    session.screens.push({ name: "screenA", width: 450, height: 250 });
    session.screens.push({ name: "screenB", width: 650, height: 350 });
    session.screens.push({ name: "screenC", width: 750, height: 120 });
    session.screens.push({ name: "screenD", width: 250, height: 60 });
    session.screens.push({ name: "screenE", width: 390, height: 120 });
    session.screens.push({ name: "screenF", width: 1240, height: 650 });

    // Converting the JSON string with JSON.stringify()
    // then saving with localStorage in the name of session
    localStorage.setItem("session", JSON.stringify(session));

    // Example of how to transform the String generated through
    // JSON.stringify() and saved in localStorage in JSON object again
    const restoredSession = JSON.parse(localStorage.getItem("session"));

    // Now restoredSession variable contains the object that was saved
    // in localStorage
    console.log(restoredSession);
  }*/

  // function test_Well_formed_JSON_stringify(): void {
  //   self::assertSame('"�"', JSON::stringify("\uD800"));

  //   /* But with this change JSON.stringify() represents lone surrogates
  //   using JSON escape sequences that can be encoded in valid UTF-8 or
  //   UTF-16: */
  //   self::assertSame('"\\ud800"', JSON::stringify("\uD800"));
  // }
}
