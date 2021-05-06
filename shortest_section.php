<?php
// 入力値の取得
[$num, $val] = explode(" ", trim(fgets(STDIN)));
$data = explode(" ", trim(fgets(STDIN)));
// var_dump($data);

$plus = $minus = 0;
$sum = $data[0]; // $sumに最初の値を詰める
$ans = $num + 1; // $ansに全体数+1を詰める

// 全ての値を回り切るまでループを回す
while (1) {
    if ($sum >= $val) {
        $sum -= $data[$minus];
        $ans = min($ans, $plus - $minus + 1);
        $minus++;
    } else {
        $plus++;
        if ($plus === (int) $num) {
            break;
        } else {
            $sum += $data[$plus];
        }
    }
}

// 出力
if ($ans !== $num + 1) {
    echo $ans . "\n";
} else {
    echo "-1" . "\n";
}

// 入力例
// 10 27
// 16 9 2 6 18 3 1 3 6 8
