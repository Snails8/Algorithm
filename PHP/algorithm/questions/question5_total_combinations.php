<?php
/*
問題4
1,2,…,9の数をこの順序で、”+”、”-“、またはななにもせず結果が100となるあらゆる組合せを出力するプログラムを記述せよ。
例えば、1 + 2 + 34 – 5 + 67 – 8 + 9 = 100となる
 */

// 同じ意味 =  define('TARGET_SUM', 100);
const TARGET_SUM = 100;

$values = [1,2,3,4,5,6,7,8,9];
$answer = f(TARGET_SUM, $values[0], 1);

foreach ($answer as $ans) {
    print_r($ans);
    echo '<br>';
}

function f($sum, $number, $index) {
    $values = [1,2,3,4,5,6,7,8,9];

    $digit = abs($number % 10);
    if ($index >= count($values)) {
        if ($sum == $number) {
            $array = [];
            $array[] = (string)$digit;
            return $array;
        } else {
            return array();
        }
    }

    $branch1 = f($sum - $number, $values[$index], $index + 1);
    $branch2 = f($sum - $number, -$values[$index], $index + 1);

    $concatenatedNumber = $number >= 0? 10 * $number + $values[$index]: 10 * $number - $values[$index];
    $branch3 = f($sum, $concatenatedNumber, $index + 1);

    $results = [];

    $results = array_merge([], add($digit, "+", $branch1));
    $results = array_merge($results, add($digit, "-", $branch2));
    $results = array_merge($results, add($digit, "", $branch3));

    return $results;
}

function add($digit, $str, $array) {
    for ($i=0; $i < count($array); $i++) {
        $array[$i] = $digit . $str . $array[$i];
    }
    return $array;
}