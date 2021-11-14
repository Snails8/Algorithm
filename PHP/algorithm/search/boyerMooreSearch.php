<?php

/*
Boyer Moore法
見つけたい文字(パターン)の末尾から探していく
テキストの頭から進める。
パターンに含まれて居ない文字の場合はパターンの数分ずらす
パターンに含まれている場合は、最小限の移動
 */

mb_internal_encoding("UTF-8");
//日本語
//①全部同じ
var_dump(boyerMooreSearch('テストトテスト', 'テストトテスト'));                            //true
echo '<br>';

//②最初でマッチ
var_dump(boyerMooreSearch('テストトテストトトト', 'テストトテスト'));                      //true
echo '<br>';

//③途中でマッチ
var_dump(boyerMooreSearch('テストトテストストトテストテテテテテ', 'テストトテスト'));       //true
echo '<br>';

//④途中でマッチ
var_dump(boyerMooreSearch('aaaabdfdsrtatテストトテストストトテストテ', 'テストトテスト')); //true
echo '<br>';

//⑤最後でマッチ
var_dump(boyerMooreSearch('テストトテテストトテスト', 'テストトテスト'));                  //true
echo '<br>';

//⑥最後でマッチ2
var_dump(boyerMooreSearch('テストトテnトテストトテスト', 'テストトテスト'));               //true
echo '<br>';

//⑦最後でマッチ3
var_dump(boyerMooreSearch('テストトテスnテストトテスト', 'テストトテスト'));               //true
echo '<br>';

//⑧見つけたい文字よりも短い
var_dump(boyerMooreSearch('テスト', 'テストトテスト'));                                   //false
echo '<br>';

//⑨一致しない
var_dump(boyerMooreSearch('テストトテス', 'テストトテスト'));                             //false
echo '<br>';

//⑩一致しない
var_dump(boyerMooreSearch('後戻りを考慮せず無限ループではまる', 'テストトテスト'));        //false


public function boyerMooreSearch($text, $pattern) {
    // mb_strlen: 引数に指定した文字列の長さを取得
    $textLength    = mb_strlen($text);    //テキストの長さ
    $patternLength = mb_strlen($pattern); //パターンの長さ
    $shiftTable = [];                     //シフトする量のマスタテーブル

    //シフトテーブルの作成。末尾の１個前まで実施
    for ($i = 0; $i < $patternLength - 1; $i++) {
        //キーはパターンの文字。値はシフト量
        $shiftTable[mb_substr($pattern, $i, 1, 'UTF-8')] = $patternLength - $i -1;
    }

    //パターンの末尾のみの計算。もし、既に文字がある場合は何もしない。最初のfor分でやるとシフト量が0になるため
    if (!array_key_exists(mb_substr($pattern, $patternLength-1, 1, 'UTF-8'), $shiftTable)) {
        $shiftTable[mb_substr($pattern, $patternLength-1, 1, 'UTF-8')] = $patternLength;
    }

    //var_dump($shiftTable);
    //exit('');
    //探索する
    //テキストのindexをパターンの末尾とあわせる。末尾から探索していく
    $textIndex = $patternLength -1;
    while ($textIndex < $textLength) {
        //パターンの末尾位置
        $pp = $patternLength - 1;
        //文字が一致している間実施
        while (mb_substr($text, $textIndex, 1, 'UTF-8') == mb_substr($pattern, $pp, 1, 'UTF-8')) {
            if ($pp == 0) {
                //探索成功
                return true;
            }
            $textIndex--;
            $pp--;
        }
        //移動する
        if (isset($shiftTable[mb_substr($text, $textIndex, 1, 'UTF-8')])) {
            //後戻り対策。大きい方を取る
            $textIndex = $textIndex + MAX($shiftTable[mb_substr($text, $textIndex, 1, 'UTF-8')], $patternLength - $pp);
        } else {
            //パターン以外の文字の時
            $textIndex = $textIndex + $patternLength;
        }
    }

    //探索失敗
    return false;
}
