<?php

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

  function __construct(string $value = '') {
    $this->value = $value;
    $this->length = (int) mb_strlen($this->value, 'utf-8');
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

  // TODO: Implement JS string methods
}

/**
 * Allows manipulation and formatting of text strings and determination and
 * location of substrings within strings.
 */
function String(string $value = ''): JSString {
  return new JSString($value);
}
