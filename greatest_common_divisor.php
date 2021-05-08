<?php

// 普通にループを回すとrun time errorになるので、ユークリッドの互除法を用いる。
// ユークリッドの互除法とは「AとBの最大公約数は、BとA%Bの公約数と等しい」 という性質を利用して最大公約数を求める方法。

$num = explode(" ", trim(fgets(STDIN)));
rsort($num);

while (1) {
    $temp = $num[1];
    $num[1] = $num[0] % $num[1];
    $num[0] = $temp;
    if ($num[1] === 0) {
        $ans = $num[0];
        break;
    } elseif ($num[0] < $num[1]) {
        $ans = 1;
        break;
    }
}
echo $ans;

// 48 32とした場合の$numの動き
// $num(48,32) = $num(32, 48%32)
// $num(32,16) = $num(16, 32%16)
// $num(16,0) = 16
