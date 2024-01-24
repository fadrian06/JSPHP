<?php

declare(strict_types=1);

/**
 * Allows manipulation and formatting of text strings and determination and
 * location of substrings within strings.
 * @property-read int $length Returns the length of a String object.
 */
final class JSString implements Stringable {
  /** @var int */
  private $length = 0;

  /** @var string */
  private $value = '';

  /** @param mixed $value */
  function __construct($value = '') {
    switch (true) {
      case is_array($value):
        $value = JSArray(...$value);
        break;
      case $value === null:
        $value = 'null';
        break;
      case is_bool($value):
        $value = $value ? 'true' : 'false';
        break;
    }

    $this->value = (string) $value;
    $this->length = mb_strlen($this->value, 'utf-8');
  }

  function __toString(): string {
    return $this->value;
  }

  /** @param 'length' $name Property name */
  function __get(string $name): ?int {
    if ($name === 'length') {
      return $this->length;
    }

    return null;
  }

  /** @param mixed $value */
  function __set(string $name, $value): void {
  }

  /**
   * Returns the position of the first occurrence of a substring.
   * @param ?string $searchString The substring to search for in the string
   * @param int<0, max> $position The index at which to begin searching the String object. If omitted, search starts at the beginning of the string.
   * @return int The index of the first occurrence of searchString found, or -1 if not found.
   */
  function indexOf(?string $searchString = null, int $position = 0): int {
    if ($searchString === '' && $position >= $this->length) {
      return $this->length;
    } elseif ($searchString === '') {
      return $position;
    }

    if ($searchString === null) {
      $searchString = 'undefined';
    }

    if ($position >= $this->length) {
      return -1;
    }

    if ($position < 0) {
      $position = 0;
    }

    $position = mb_strpos($this->value, $searchString, $position, 'utf-8');

    return $position === false ? -1 : $position;
  }

  /**
   * Returns the substring at the specified location within a String object.
   * @param int $start The zero-based index number indicating the beginning of the substring.
   * @param ?int $end Zero-based index number indicating the end of the substring. The substring includes the characters up to, but not including, the character indicated by end.
   * If end is omitted, the characters from start through the end of the original string are returned.
   */
  function substring(int $start, ?int $end = null): self {
    $result = '';

    if ($end === null) {
      $end = $this->length;
    }

    if ($start < 0) {
      $start = 0;
    }

    if ($end < 0) {
      $end = 0;
    }

    if ($start > $end) {
      return $this->substring($end, $start);
    }

    for ($i = $start; $i < $end; ++$i) {
      if (!isset($this->value[$i])) {
        break;
      }

      $result .= $this->value[$i];
    }

    return new self($result);
  }

  /**
   * Returns the character at the specified index.
   * @param int|float $pos The zero-based index of the desired character.
   */
  function charAt($pos): self {
    return new self($this->value[$pos]);
  }

  /** Converts all the alphabetic characters in a string to uppercase. */
  function toUpperCase(): self {
    return new self(mb_strtoupper($this->value));
  }

  /** Converts all the alphabetic characters in a string to lowercase. */
  function toLowerCase(): self {
    return new self(mb_strtolower($this->value));
  }

  /**
   * Removes the leading and trailing white space and line terminator characters
   * from a string.
   */
  function trim(): self {
    return new self(trim($this->value));
  }

  /** Removes the trailing white space and line terminator characters from a string. */
  function trimEnd(): self {
    return new self(rtrim($this->value));
  }

  /** Removes the leading white space and line terminator characters from a string. */
  function trimStart(): self {
    return new self(ltrim($this->value));
  }

  /** Returns a string representation of a string. */
  function toString(): string {
    return $this->value;
  }

  /** Returns the primitive value of the specified object. */
  function valueOf(): string {
    return $this->value;
  }

  /**
   * Returns a string that contains the concatenation of two or more strings.
   * @param string|self ...$strings The strings to append to the end of the string.
   */
  function concat(...$strings): self {
    $strings = array_map(function ($string): self {
      return new self($string);
    }, $strings);

    return new static($this->value . join('', $strings));
  }

  // TODO: Implement JS string methods
}

/**
 * Allows manipulation and formatting of text strings and determination and
 * location of substrings within strings.
 */
function String(string $value = ''): JSString {
  return new JSString($value);
}

/**
 * Allows manipulation and formatting of text strings and determination and
 * location of substrings within strings.
 */
function JSString(string $value = ''): JSString {
  return new JSString($value);
}
