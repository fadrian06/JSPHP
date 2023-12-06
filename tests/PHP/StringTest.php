<?php

declare(strict_types=1);

namespace Tests\PHP;

use JSString;
use PHPUnit\Framework\TestCase;
use function String;

final class StringTest extends TestCase {
  /** @test */
  function can_build_an_empty_string_without_String_function_argument(): void {
    self::assertSame('', (string) String());
  }

  /** @test */
  function can_build_regular_strings(): void {
    self::assertSame('abc', (string) new JSString('abc'));
  }

  /** @test */
  function can_calculate_the_length_of_a_string(): void {
    self::assertSame(3, String('abc')->length);
  }

  /**
   * @test
   * @dataProvider \Tests\DataProviders\StringsDataProvider::getRegularStringsDataProvider
   */
  function can_get_the_original_string(string ...$raws): void {
    foreach ($raws as $raw) {
      self::assertSame($raw, String($raw)->toString());
      self::assertSame($raw, String($raw)->valueOf());
    }
  }

  /**
   * @test
   * @dataProvider \Tests\DataProviders\StringsDataProvider::getRegularStringsDataProvider
   */
  function can_convert_a_string_to_upper_case(string ...$raws): void {
    foreach ($raws as $raw) {
      self::assertSame(mb_strtoupper($raw), String($raw)->toUpperCase()->valueOf());
    }
  }

  /**
   * @test
   * @dataProvider \Tests\DataProviders\StringsDataProvider::getRegularStringsDataProvider
   */
  function can_convert_a_string_to_lower_case(string ...$raws): void {
    foreach ($raws as $raw) {
      self::assertSame(mb_strtolower($raw), String($raw)->toLowerCase()->valueOf());
    }
  }

  /** @test */
  function can_trim_a_string(): void {
    self::assertSame('Hello', String('  Hello  ')->trim()->valueOf());
  }

  /** @test */
  function can_trim_the_end_of_a_string(): void {
    self::assertSame('   Hello', String('   Hello   ')->trimEnd()->valueOf());
  }

  /** @test */
  function can_trim_the_start_of_a_string(): void {
    self::assertSame('Hello   ', String('   Hello   ')->trimStart()->valueOf());
  }
}
