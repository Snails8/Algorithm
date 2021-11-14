<?php

/*
問題1
forループ、whileループ、および再帰を使用して、リスト内の数字の合計を計算する3つの関数を記述せよ
*/

$list1 = array(1,2,3,4,5,6);
echo '<pre>';
print_r(getSumByFor($list1));
echo '<br>';
$list2 = array(1,2,3,4,5,6);
print_r(getSumByWhile($list2));
echo '<br>';
$list3 = array(1,2,3,4,5,6);
print_r(getSumByRecursive(0, $list3));
echo '</pre>';

// for
function getSumByFor($list) {
    $length = count($list);
    $sum = 0;

    for ($i = 0; $i < $length; $i++) {
        $sum += $list[i];
    }

    return $sum;
}

// while
function getSumByWhile($list) {
    $sum = 0;
    while (true) {
        if (empty($list)) {
            break;
        }
        // array の最初の値を取り出して返す。配列 array は、要素一つ分だけ短くなり、全ての要素は前にずれる
        $sum = array_shift($list);
    }

    return $sum;
}

// 再帰
function getSumByRecursive($sum, $list) {
    if(empty($list)) {
        return $sum;
    }
    $sum += array_shift($list);
    return getSumByRecursive($sum, $list);
}
