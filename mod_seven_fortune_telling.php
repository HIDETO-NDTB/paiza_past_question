<?php

$n = trim(fgets(STDIN));

// $countを用意し、入力値を7で割った余りを詰める
$count = array_pad([], 7, 0);
for ($i = 0; $i < $n; $i++) {
    $count[trim(fgets(STDIN)) % 7]++;
}
// var_dump($count);

// 何通りあるかをカウントする$totalを準備
$total = 0;

for ($i = 0; $i < 7; $i++) {
    // 1枚目のカード
    for ($j = $i; $j < 7; $j++) {
        // 2枚目のカード
        for ($k = $j; $k < 7; $k++) {
            // 3枚目のカード
            if (($i + $j + $k) % 7 === 0) {
                // 3枚のカードの和が7で割り切れる場合で・・・
                if ($i === $j && $j === $k) {
                    // 全てのカードの%7が同じ場合 = 全てのカードが余り0の場合
                    $total +=
                        ($count[$i] * ($count[$j] - 1) * ($count[$k] - 2)) / 6;
                } elseif ($i === $j && $j !== $k) {
                    // 3枚中2枚のカードの%7が同じ場合
                    $total +=
                        (($count[$i] * ($count[$j] - 1)) / 2) * $count[$k];
                } elseif ($i !== $j && $j === $k) {
                    $total +=
                        ($count[$i] * ($count[$j] * ($count[$k] - 1))) / 2;
                } else {
                    // 全てのカードの%7が異なる場合
                    $total += $count[$i] * $count[$j] * $count[$k];
                }
            }
        }
    }
}
// 出力
echo $total;

// 入力例
// 10
// 1
// 2
// 3
// 4
// 5
// 6
// 7
// 8
// 9
// 10
