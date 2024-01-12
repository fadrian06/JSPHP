<?php

declare(strict_types=1);

namespace Tests\PHP\JSON;

use JSON;
use JsonException;
use PHPUnit\Framework\TestCase;
use stdClass;

final class parseTest extends TestCase {
  // function test_The_reviver_parameter(): void {
  //   $transformedObj1 = JSON::parse('[1,5,{"s":1}]', function (string $key, $value) {
  //     return is_object($value) ? undefined : $value;
  //   });

  //   self::assertSame(undefined, $transformedObj1);
  // }

  function test_Using_JSON_parse(): void {
    self::assertEquals(new stdClass, JSON::parse('{}'));
    self::assertTrue(JSON::parse('true'));
    self::assertSame('foo', JSON::parse('"foo"'));
    self::assertSame([1, 5, 'false'], JSON::parse('[1, 5, "false"]'));
    self::assertNull(JSON::parse('null'));
  }

  /*function test_Using_the_reviver_parameter(): void {
    $result = JSON::parse(
      '{"p": 5}',
      function (string $key, $value) {
        return is_numeric($value)
          ? $value * 2 // return value * 2 for numbers
          : $value; // return everything else unchanged
      }
    );

    self::assertSame(10, $result->p);

    self::expectOutputString('123653');
    JSON::parse('{"1": 1, "2": 2, "3": {"4": 4, "5": {"6": 6}}}', function (string $key, $value) {
      echo $key;

      return $value;
    });
    // 1
    // 2
    // 4
    // 6
    // 5
    // 3
    // ""
  }*/

  /*function test_Using_reviver_when_paired_with_the_replacer_of_JSON_stringify(): void {
    // Maps are normally serialized as objects with no properties.
    // We can use the replacer to specify the entries to be serialized.
    $map = new Map([
      [1, 'one'],
      [2, 'two'],
      [3, 'three'],
    ]);

    $jsonText = JSON::stringify($map, function (string $key, $value) {
      return $value instanceof Map ? JSArray::from($value . entries()) : $value;
    });

    self::assertSame('[[1,"one"],[2,"two"],[3,"three"]]', $jsonText);

    $map2 = JSON::parse($jsonText, function (string $key, $value) {
      return JSArray::isArray($value) ? new Map($value) : $value;
    });

    console::log($map2);
    // Map { 1 => "one", 2 => "two", 3 => "three" }
  }*/

  function test_JSON_parse_does_not_allow_trailing_commas(): void {
    self::expectException(JsonException::class);
    self::expectExceptionMessage('Syntax error');

    JSON::parse("[1, 2, 3, 4, ]");
    JSON::parse('{"foo" : 1, }');
  }

  function test_JSON_parse_does_not_allow_single_quotes(): void {
    self::expectException(JsonException::class);
    self::expectExceptionMessage('Syntax error');

    JSON::parse("{'foo': 1}");
  }
}
