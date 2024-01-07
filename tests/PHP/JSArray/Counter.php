<?php

declare(strict_types=1);

namespace Tests\PHP\JSArray;

use JSArray;

class Counter {
  /** @var int */
  public $sum = 0;

  /** @var int */
  public $count = 0;

  function add(JSArray $array): void {
    // Only function expressions will have its own this binding
    $array->forEach(function ($entry): void {
      $this->sum += $entry;
      $this->count++;
    }, $this);
  }
}
