<?php

declare(strict_types=1);

final class JSBoolean {
  /** @var bool */
  private $value;

  /** @param mixed $value */
  function __construct($value) {
    $this->value = $value;
  }

  function __toString(): string {
    return $this->value ? 'true' : 'false';
  }

  /** Returns the primitive value of the specified object. */
  function valueOf(): bool {
    return $this->value;
  }

  /** Returns a string representation of an object. */
  function toString(): string {
    return (string) $this;
  }
}
