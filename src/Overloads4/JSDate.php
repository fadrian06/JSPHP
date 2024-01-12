<?php

declare(strict_types=1);

final class JSDate {
  /**
   * Creates a new Date.
   * @param int $year The full year designation is required for cross-century date accuracy. If year is between 0 and 99 is used, then year is assumed to be 1900 + year.
   * @param int<0, 11> $monthIndex The month as a number between 0 and 11 (January to December).
   * @param ?int<1, 31> $date The date as a number between 1 and 31.
   * @param ?int<0, 23> $hours Must be supplied if minutes is supplied. A number from 0 to 23 (midnight to 11pm) that specifies the hour.
   * @param ?int<0, 59> $minutes Must be supplied if seconds is supplied. A number from 0 to 59 that specifies the minutes.
   * @param ?int<0, 59> $seconds Must be supplied if milliseconds is supplied. A number from 0 to 59 that specifies the seconds.
   * @param ?int<0, 999> $ms A number from 0 to 999 that specifies the milliseconds.
   */
  function __construct(int $year, int $monthIndex, ?int $date = null, ?int $hours = null, ?int $minutes = null, ?int $seconds = null, ?int $ms = null) {
  }
}
