<?php
$S = trim(fgets(STDIN));
$sum = 0;

for($i = 0; $i < 4; $i++){
    $kigou = substr($S,$i,1);

    if($kigou == '+'){
        $sum++;
    }else{
        $sum--;
    }
}

echo $sum;