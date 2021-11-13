<?php

/*
問題4
正の整数のリストを与えられたとき、数を並び替えて可能な最大数を返す関数を記述せよ。
例えば、[50, 2, 1, 9]が与えられた時、95021が答えとなる(解答例)。
 */

$list = [50, 2, 1, 9];

// usortを使うことで ユーザー定義の比較関数を使用して、配列を値でソートすることが可能
// コールバック変数により順番の指定ができる
usort($list, 'comp');

echo '<pre>';
//  implode(array $array, string $separator) 配列要素を文字列により連結する
print_r(implode('', $list));
echo '</pre>';


// コールバック
function comp($int1, $int2) {
    $str1 = (string)$int1;
    $str2 = (string)$int2;
    if ($str1 === $str2) {
        return 0;
    }
    // s1 > s2 で正の値、s1 < s2 で負の値、s1 = s2で 0 を返す。この大小関係は一般に文字コード順による
    return -1 * strcmp($str1 . $str2, $str2 . $str1);
}