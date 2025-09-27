<?php

declare(strict_types=1);

/** @param mixed $value TODO: Specify type */
function typeof($value): string {
  if ($value instanceof JSString) {
    $reflectionClass = new ReflectionClass($value);
    $isPrimitiveProperty = $reflectionClass->getProperty('isPrimitive');
    $isPrimitiveProperty->setAccessible(true);
    $isPrimitive = (bool) $isPrimitiveProperty->getValue($value);

    if ($isPrimitive) {
      return 'string';
    }
  }

  return 'object';
}
