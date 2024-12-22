<?php

declare(strict_types=1);

/**
 * An intrinsic object that provides functions to convert JavaScript values to and
 * from the JavaScript Object Notation (JSON) format.
 */
abstract class JSON {
  final protected function __construct() {
  }

  /**
   * Converts a JavaScript Object Notation (JSON) string into an object.
   * @param string $text A valid JSON string.
   * @param null|(Closure(string $key, mixed $value, object $parsed): mixed) $reviver
   * A function that transforms the results. This function is called for each member
   * of the object. If a member contains nested objects, the nested objects are
   * transformed before the parent object is.
   * @return mixed
   * @throws JsonException For invalid JSON Strings
   */
  final static function parse(string $text, ?callable $reviver = null) {
    $result = json_decode($text);

    if (json_last_error() !== JSON_ERROR_NONE) {
      throw new JsonException(json_last_error_msg());
    }

    if ($reviver !== null) {
      $result = (object) $result;

      if (property_exists($result, 'scalar')) {
        $result->{''} = $result->scalar;
        unset($result->scalar);
      }

      // TODO: execute the $reviver(...) with recursive key iteration
    }

    return $result;
  }

  /**
   * Converts a JavaScript value to a JavaScript Object Notation (JSON) string.
   * @param mixed $value A PHP value, usually an object or array, to be converted.
   * @param null|(Closure(string $key, mixed $value, object $parsed): mixed) $replacer A function that transforms the results.
   * @param null|int<0, 10>|string $space Adds indentation, white space, and line break characters to the return-value JSON text to make it easier to read.
   */
  final static function stringify($value, $replacer = null, $space = null): string {
    if (is_array($value)) {
      $value = self::parseArray($value);
    }

    return (string) json_encode($value);
  }

  /**
   * @template T
   * @param T[] $value
   * @return T[]
   */
  private static function parseArray($value): array {
    $allKeysNumeric = null;

    foreach (array_keys($value) as $key) {
      if (is_numeric($key)) {
        $allKeysNumeric = true;
        continue;
      }

      if ($allKeysNumeric === true) {
        unset($value[$key]);
      }
    }

    foreach ($value as &$item) {
      switch (true) {
        case $item instanceof JSString:
        case $item instanceof Number:
        case $item instanceof Boolean:
          $item = $item->valueOf();
          break;
        case is_array($item):
          $item = self::parseArray($item);
          break;
        case $item === null:
        case is_callable($item):
        case is_string($item) and password_verify('undefined', $item):
        case is_infinite((float) $item):
        case is_nan((float) $item):
          $item = null;
          break;
      }
    }

    return $value;
  }
}
