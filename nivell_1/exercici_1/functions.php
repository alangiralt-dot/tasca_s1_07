<?php
declare(strict_types=1);
function calculateAverage(array $numbers): float {
  if (count($numbers) === 0) throw new Exception("I cannot divide by zero.");
  return array_sum($numbers) / count($numbers);
}