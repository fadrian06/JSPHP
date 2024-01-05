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
   * @param ?Closure(string $key, mixed $value, object $parsed): mixed $reviver
   * A function that transforms the results. This function is called for each member
   * of the object. If a member contains nested objects, the nested objects are
   * transformed before the parent object is.
   * @throws JsonException For invalid JSON Strings
   */
  final static function parse(string $text, ?callable $reviver = null): mixed {
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
}
