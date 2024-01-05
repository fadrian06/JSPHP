<?php

declare(strict_types=1);

namespace Tests\PHP;

use PHPUnit\Framework\TestCase;
use JSON;
use JsonException;

final class JsonTest extends TestCase {
  function test_cannot_create_a_JSON_instance(): void {
    $this->expectException('Error');
    new JSON; // @phpstan-ignore-line
  }

  function test_cannot_create_an_instance_from_a_JSON_child_class(): void {
    $this->expectException('Error');
    new class() extends JSON { // @phpstan-ignore-line
    };
  }

  function test_cannot_parse_an_invalid_JSON(): void {
    $this->expectException(JsonException::class);
    JSON::parse('Some invalid json');
  }

  /** @dataProvider \Tests\DataProviders\StringsDataProvider::getRegularStringsDataProvider */
  function test_can_parse_valid_literal_strings(string ...$raws): void {
    foreach ($raws as $raw) {
      try {
        self::assertSame(
          str_replace(['\\\\', '\"'], ['\\', '"'], $raw),
          JSON::parse("\"$raw\"")
        );
      } catch (JsonException $error) {
        throw new JsonException("Failed to parse string \"$raw\"");
      }
    }
  }

  function test_can_parse_a_json_null_datatype(): void {
    self::assertNull(JSON::parse('null'));
  }

  /** @dataProvider getRegularNumbersDataProvider */
  function test_can_parse_valid_literal_numbers(string $number): void {
    self::assertEquals($number, JSON::parse("$number"));
  }

  function test_can_parse_valid_literal_booleans(): void {
    self::assertTrue(JSON::parse('true'));
    self::assertFalse(JSON::parse('false'));
  }

  function test_can_parse_valid_literal_arrays(): void {
    self::assertSame([], JSON::parse('[]'));
    self::assertSame(['a', 'b', 'c'], JSON::parse('["a", "b", "c"]'));
    self::assertSame([1, 2, 3], JSON::parse('[1, 2, 3]'));
    self::assertSame([null, true, false], JSON::parse('[null, true, false]'));
    self::assertSame([[], []], JSON::parse('[[], []]'));
  }

  function test_can_parse_valid_literal_objects(): void {
    self::assertIsObject(JSON::parse('{}'));

    self::assertEquals((object) ['a' => 'b'], JSON::parse('{"a": "b"}'));
    self::assertEquals((object) ['a' => 1, 'b' => 2], JSON::parse('{"a": 1, "b": 2}'));
    self::assertEquals((object) ['a' => null, 'b' => true, 'c' => false], JSON::parse('{"a": null, "b": true, "c": false}'));
    self::assertEquals((object) ['a' => [], 'b' => []], JSON::parse('{"a": [], "b": []}'));
    self::assertEquals((object) ['a' => (object) ['aa' => 'bb']], JSON::parse('{"a": {"aa": "bb"}}'));
  }

  /** @return array<string, array<int, string>> */
  static function getRegularNumbersDataProvider(): array {
    return [
      'zero' => ['0'],
      'positive integer' => ['1'],
      'negative integer' => ['-1'],
      'positive float' => ['1.5'],
      'negative float' => ['-1.5'],
      'positive exponential' => ['1e5'],
      'negative exponential' => ['-1e5'],
      'negative zero' => ['-0']
    ];
  }
}
