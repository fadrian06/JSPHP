<?php

declare(strict_types=1);

/**
 * Allows manipulation and formatting of text strings and determination and
 * location of substrings within strings.
 * @property-read int<0, max> $length Returns the length of a String object.
 * @implements ArrayAccess<int, string>
 */
final class JSString implements Stringable, ArrayAccess {
  /** @var int<0, max> */
  private $length = 0;

  /** @var string */
  private $value = '';

  /** @var bool */
  protected $isPrimitive = false;

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
      case is_string($value) and password_verify('undefined', $value):
        $value = 'undefined';
        break;
    }

    $this->value = (string) $value;
    $this->length = mb_strlen($this->value);
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

  function offsetExists($offset): bool {
    return false;
  }

  #[ReturnTypeWillChange]
  function offsetGet($offset) {
    return $this->value[$offset];
  }

  function offsetSet($offset, $value): void {
  }

  function offsetUnset($offset): void {
  }

  /**
   * Returns the position of the first occurrence of a substring.
   * @param ?string $searchString The substring to search for in the string
   * @param int<0, max> $position The index at which to begin searching the String object. If omitted, search starts at the beginning of the string.
   * @return int<-1, max> The index of the first occurrence of $searchString found, or -1 if not found.
   */
  function indexOf(?string $searchString = null, int $position = 0): int {
    if ($searchString === '' && $position >= $this->length) {
      return $this->length;
    }

    if ($searchString === '') {
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

    $position = mb_strpos($this->value, $searchString, $position);

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

    return String($result);
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

  /**
   * Returns true if the sequence of elements of $searchString converted to a String is the
   * same as the corresponding elements of this object (converted to a String) starting at
   * $endPosition – length($this). Otherwise returns false.
   */
  function endsWith(string $searchString, ?int $endPosition = null): bool {
    if ($endPosition === null) {
      $endPosition = $this->length;
    }

    return str_ends_with($this->substring(0, $endPosition)->value, $searchString);
  }

  /**
   * Returns true if $searchString appears as a substring of the result of converting this
   * object to a String, at one or more positions that are
   * greater than or equal to $position; otherwise, returns false.
   * @param ?int $position If position is undefined, 0 is assumed, so as to search all of the String.
   * @throws TypeError Thrown if $searchString is a regex.
   */
  function includes(string $searchString, ?int $position = 0): bool {
    if ($searchString === '') {
      return true;
    }

    if ($position === null) {
      $position = 0;
    }

    return mb_strpos($this->value, $searchString, $position) !== false;
  }

  /**
   * Returns the last occurrence of a substring in the string.
   * @param string $searchString The substring to search for.
   * @param ?int $position The index at which to begin searching. If omitted, the search begins at the end of the string.
   */
  function lastIndexOf(string $searchString, ?int $position = null): int {
    $haystack = $this;

    if ($searchString === '') {
      if ($position === null) {
        $position = $this->length;
      }

      return $position;
    }

    if ($position < 0) {
      return $this->indexOf($searchString);
    }

    if ($position === 0) {
      return $this->indexOf($searchString) === $position ? $position : -1;
    }

    if ($position > $this->length) {
      $position = null;
    }

    if ($position < $this->length) {
      $haystack = $this->substring(0, $position);
      $position = null;
    }

    $lastIndex = mb_strrpos($haystack->value, $searchString, $position ?? 0);

    if ($lastIndex === false || ($position !== null && $lastIndex > $position)) {
      return -1;
    }

    return $lastIndex;
  }

  /**
   * Pads the current string with a given string (possibly repeated) so that the resulting string reaches a given length.
   * The padding is applied from the end (right) of the current string.
   *
   * @param int $maxLength The length of the resulting string once the current string has been padded.
   *        If this parameter is smaller than the current string's length, the current string will be returned as it is.
   *
   * @param string $fillString The string to pad the current string with.
   *        If this string is too long, it will be truncated and the left-most part will be applied.
   *        The default value for this parameter is " " (U+0020).
   */
  function padEnd(int $maxLength, string $fillString = ' '): self {
    return new self(str_pad($this->value, $maxLength, $fillString));
  }

  /**
   * Split a string into substrings using the specified separator and return them as an array.
   * @param string $separator A string that identifies character or characters to use in separating the string. If omitted, a single-element array containing the entire string is returned.
   * @param ?int $limit A value used to limit the number of elements returned in the array.
   * @return JSArray<string>
   */
  function split($separator, ?int $limit = null): JSArray {
    return JSArray(...explode($separator, $this->value));
  }

  /**
   * Gets a substring beginning at the specified location and having the specified length.
   * @deprecated A legacy feature for browser compatibility
   * @param int $from The starting position of the desired substring. The index of the first character in the string is zero.
   * @param ?int $length The number of characters to include in the returned substring.
   */
  function substr($from = 0, $length = null): self {
    $params = [$this->value, $from];

    if ($length !== null) {
      $params[] = $length;
    }

    if (
      $length < 0
      || Number::isNaN($from)
      || Number::isNaN($length)
      || $from + ($length ?? 0) >= $this->length
    ) {
      return new self;
    }

    return String(substr(...$params));
  }

  /**
   * @param array<string, string> $options
   */
  function localeCompare(string $compareString, string $locales = 'en-US', array $options = []): int {
    return (int) collator_compare(
      collator_create($locales),
      $this->value,
      $compareString
    );
  }

  /**
   * Returns a `<b>` HTML element
   * @deprecated A legacy feature for browser compatibility
   */
  function bold(): self {
    return new self("<b>$this->value</b>");
  }

  /**
   * Returns an `<a>` HTML anchor element and sets the name attribute to the
   * text value
   * @deprecated A legacy feature for browser compatibility
   * @param string $name
   */
  function anchor(string $name): self {
    $name = htmlentities($name);

    return new self("<a name=\"$name\">$this->value</a>");
  }

  static function fromCharCode(int ...$codes): self {
    return new self(join('', array_map('mb_chr', $codes)));
  }

  /**
   * Return the String value whose elements are, in order, the elements in the List elements.
   * If length is 0, the empty string is returned.
   * @param int|float ...$codePoints
   */
  static function fromCodePoint(...$codePoints): self {
    return new self(join('', array_map(static function ($codePoint): string {
      if (!is_int($codePoint)) {
        throw new RangeError;
      }

      return mb_chr($codePoint);
    }, $codePoints)));
  }
}

/**
 * Allows manipulation and formatting of text strings and determination and
 * location of substrings within strings.
 * @param mixed $value
 */
function String($value = ''): JSString {
  $jsString = new JSString($value);
  $reflection = new ReflectionClass($jsString);
  $property = $reflection->getProperty('isPrimitive');
  $property->setAccessible(true);
  $property->setValue($jsString, true);

  return $jsString;
}
