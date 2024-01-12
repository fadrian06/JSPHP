<?php

declare(strict_types=1);

namespace JSPHP\Prototypes;

use Closure;

/**
 * @property ?Closure(): string $toString Returns a string representation of an object.
 */
final class BooleanPrototype {
  /** @var ?Closure(): string */
  private $toString = null;

  function __get(string $name): ?Closure {
    if ($name === 'toString') {
      return $this->toString;
    }

    return null;
  }

  function __set(string $name, callable $value): void {
    if ($name === 'toString') {
      $this->toString = Closure::fromCallable($value);
    }
  }
}
