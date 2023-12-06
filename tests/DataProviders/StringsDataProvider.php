<?php

declare(strict_types=1);

namespace Tests\DataProviders;

final class StringsDataProvider {
  /** @return array<string, array<int, string>> */
  static function getRegularStringsDataProvider(): array {
    return [
      'empty string' => [
        '',
        "",
        <<<HEREDOC

        HEREDOC,
        <<<'NOWDOC'

        NOWDOC
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
        'C:\\\Windows\\\System32',
        'https://www.example.com',
        '1/2',
        'root\\\directory',
        'user/home',
        'www\\\images',
        'folder/subfolder',
        'file.ext',
        'C:/Program Files'
      ],
      'quotes' => [
        "I'm happy",
        'He said, \\"Hello\\"',
        'She replied, `Sure!`',
        'This is an <example>.',
        'They exclaimed, \\"Wow!\\"',
        "I can't believe it!",
        '`Hello` world',
        '<strong>Text</strong>',
        'It\'s a \\"beautiful\\" day',
        "She whispered, 'I love you'"
      ],
    ];
  }
}
