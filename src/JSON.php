<?php

abstract class JSON {
  /**
   * @param string $text
   * @return mixed
   * @throws JsonException
   */
  static function parse(string $text) {
    // TODO: Implement parse second parameter
    $result = json_decode(
      $text,
      null,
      512,
      JSON_THROW_ON_ERROR
    );

    return $result;
  }
}
