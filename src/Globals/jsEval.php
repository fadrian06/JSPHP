<?php

declare(strict_types=1);

/**
 * Evaluates JavaScript code and executes it.
 * @param string|JSString $x A String value that contains valid JavaScript code.
 * @return mixed TODO: Specify return type
 */
function jsEval($x) {
  if ($x instanceof JSString) {
    $reflection = new ReflectionClass($x);
    $property = $reflection->getProperty('isPrimitive');
    $property->setAccessible(true);
    $isPrimitive = (bool) $property->getValue($x);

    if (!$isPrimitive) {
      return (string) $x;
    }
  }

  return eval(sprintf('return %s;', String($x)));
}
