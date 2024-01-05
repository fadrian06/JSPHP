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
    $this->length = (int) mb_strlen($this->value);
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
