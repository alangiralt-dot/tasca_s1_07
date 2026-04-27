<?php
$studentGrades = [/*
    "Liam"     => [8.5, 9.2, 7.8, 8.8, 6.4],
    "Emma"     => [9.0, 9.5, 9.2, 8.4, 9.1],
    "Noah"     => [5.2, 6.0, 6.5, 4.8, 5.9],
    "Olivia"   => [9.8, 8.8, 9.4, 9.6, 9.2],
    "Ava"      => [7.5, 8.4, 8.0, 7.2, 8.1],
    "James"    => [6.8, 7.4, 8.1, 5.9, 7.0],
    "Sophia"   => [9.1, 9.3, 8.9, 9.7, 9.5],
    "William"  => [4.5, 5.1, 6.2, 5.5, 4.8],
    "Isabella" => [8.2, 7.9, 8.5, 8.1, 8.4],
    "Oliver"   => [7.0, 6.5, 7.2, 6.8, 7.1],
    "Amelia"   => [9.4, 9.6, 9.5, 9.2, 9.8],
    "Lucas"    => [6.2, 5.8, 6.5, 6.0, 6.3]*/
];
printf("%-10s%10s%10s%10s%10s%10s%10s\n",'NAME', 'MATH', 'PHP', 'ENGLISH', 'DESIGN', 'BIOLOGY', 'AVERAGE');
$studentAverageGrades = [];
foreach ($studentGrades as $name => $grades) {
    $sum = 0;
    foreach ($grades as $g) $sum += $g;
    array_push($studentAverageGrades, $sum / 5.0);
    printf(
        "%-10s%10.1f%10.1f%10.1f%10.1f%10.1f%10.1f\n",
        $name,
        $grades[0], $grades[1], $grades[2], $grades[3], $grades[4],
        $studentAverageGrades[count($studentAverageGrades) - 1]
    );
}
try {
  if (count($studentGrades) === 0) throw new Exception("Since I cannot divide by zero, I cannot calculate the arithmetic mean of each student's average grades.");
  printf("\n%-10s%60.1f\n", 'TOTAL', array_sum($studentAverageGrades) / count($studentGrades));
} catch(Exception $e) {
  printf("\n%-10s%60s\n", 'TOTAL', '?');
  echo PHP_EOL . $e->getMessage() . PHP_EOL;
}