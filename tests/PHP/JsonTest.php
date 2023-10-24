<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class JsonTest extends TestCase {
  /** @test */
  function CannotCreateAJsonInstance(): void {
    $this->expectException('Error');
    new JSON; // @phpstan-ignore-line
  }

  /** @test */
  function CannotParseAInvalidJson(): void {
    $this->expectException('JsonException');
    JSON::parse('Some invalid json');
  }

  /**
   * @test
   * @dataProvider getRegularStringsDataProvider
   */
  function CanParseValidLiteralStrings(string $text): void {
    $result = JSON::parse("\"$text\"");
    self::assertSame($text, $result);
  }

  /** @return array<string, array<int, string>> */
  static function getRegularStringsDataProvider(): array {
    $emptyHeredoc = <<<HEREDOC

    HEREDOC;
    $emptyNowDoc = <<<'NOWDOC'

    NOWDOC;

    return [
      'empty string' => [
        '',
        "",
        $emptyHeredoc,
        $emptyNowDoc
      ],
      'anscii characters' => [
        'Hello World',
        '1234567890',
        'abcdefghijklmnopqrstuvwxyz',
        'ABCDEFGHIJKLMNOPQRSTUVWXYZ',
        '!@#$%^&*()',
        'Lorem ipsum dolor sit amet',
        'Testing 123',
        'ASCII art',
        'Quick brown fox',
        'The answer is 42'
      ],
      'unicode characters' => [
        '¡Hola!',
        'Cómo estás?',
        'Muñeca',
        'Año nuevo',
        'Café',
        'Niño',
        'Música',
        'Piñata',
        'Hábito',
        'Fácil'
      ],
      'emoticon characters' => [
        '❤️😊',
        '🌟✨',
        '😍⭐️',
        '💖✌️',
        '🎉🌈',
        '💛😃',
        '😘✨',
        '💕🌟',
        '😁⚡️',
        '💙🌞'
      ],
      'slashes' => [
        'file/path',
        'C:\Windows\System32',
        'https://www.example.com',
        '1/2',
        'root\directory',
        'user/home',
        'www\images',
        'folder/subfolder',
        'file.ext',
        'C:/Program Files'
      ],
      'quotes' => [
        "I'm happy",
        'He said, "Hello"',
        'She replied, `Sure!`',
        'This is an <example>.',
        'They exclaimed, "Wow!"',
        "I can't believe it!",
        '`Hello` world',
        '<strong>Text</strong>',
        "It's a \"beautiful\" day",
        "She whispered, 'I love you'"
      ],
    ];
  }
}
