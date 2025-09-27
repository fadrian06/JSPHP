<?php

declare(strict_types=1);

/**
 * The **`console`** object provides access to the debugging console (e.g., the Web console in Firefox).
 *
 * [MDN Reference](https://developer.mozilla.org/docs/Web/API/console)
 */
final class console {
  /**
   * The **`console.log()`** static method outputs a message to the console.
   *
   * [MDN Reference](https://developer.mozilla.org/docs/Web/API/console/log_static)
   *
   * @param mixed ...$data
   */
  static function log(...$data): void {
    echo strval($data[0]);
  }
}
