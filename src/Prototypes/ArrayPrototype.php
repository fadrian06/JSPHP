<?php

declare(strict_types=1);

namespace JSPHP\Prototypes;

use Closure;
use JSArray;
use JSFunction;

/**
 * @property-read JSFunction $forEach Performs the specified action for each element in an array.
 */
final class ArrayPrototype {
  /** @var JSFunction */
  private $forEach;

  function __construct() {
    $this->forEach = new JSFunction;
    $this->forEach->prototype = Closure::fromCallable([new JSArray, 'forEach']);
  }

  function __get(string $name): ?JSFunction {
    switch ($name) {
      case 'forEach':
        return $this->forEach;
    }

    return null;
  }
}
