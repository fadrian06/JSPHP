<?php

/**
 * Evaluates JavaScript code and executes it.
 * @param string|JSString $x A String value that contains valid JavaScript code.
 * @return mixed
 */
function jsEval($x) {
  if ($x instanceof JSString) {
    // Read $isPrimitive private property using reflection
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
