<?php

declare(strict_types=1);

/**
 * An intrinsic object that provides functions to convert JavaScript values to and
 * from the JavaScript Object Notation (JSON) format.
 */
abstract class JSON {
  /**
   * Converts a PHP value to a JavaScript Object Notation (JSON) string.
   * @param mixed $value A PHP value, usually an object or array, to be converted.
   * @param ?array<int, int|string> $replacer An array of strings and numbers that acts as an approved list for selecting the object properties that will be stringified.
   * @param null|int<0, 10>|string $space Adds indentation, white space, and line break characters to the return-value JSON text to make it easier to read.
   */
  final static function stringify($value, ?array $replacer = null, $space = null): string {
    return '';
  }
}
