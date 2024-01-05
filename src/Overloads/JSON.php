<?php

declare(strict_types=1);

abstract class JSON {
  /**
   * Converts a PHP value to a JavaScript Object Notation (JSON) string.
   * @param mixed $value A PHP value, usually an object or array, to be converted.
   * @param ?array<int, int|string> $replacer An array of strings and numbers that acts as an approved list for selecting the object properties that will be stringified.
   * @param null|int|string $space Adds indentation, white space, and line break characters to the return-value JSON text to make it easier to read.
   * @return string
   */
  final static function stringify($value, $replacer = null, $space = null) {
    return '';
  }
}
