<?php

// 高さ、幅を取得
[$h, $w] = explode(" ", trim(fgets(STDIN)));
// $fieldを取得
for ($i = 0; $i < $h; $i++) {
    $field[] = str_split(trim(fgets(STDIN)));
}
// var_dump($field);

// 現在地座標を$queueに詰める
$queue = [];
for ($i = 0; $i < $h; $i++) {
    for ($j = 0; $j < $w; $j++) {
        if ($field[$i][$j] === "*") {
            $queue[] = [$i, $j];
        }
    }
}
// var_dump($queue);
// echo array_shift($queue)[1];

// $queueが空になるまでループ
while (!empty($queue)) {
    // $queueの先頭の座標を取得
    $temp = array_shift($queue);
    $y = $temp[0];
    $x = $temp[1];

    // -1と+1でループを回し、条件に合えば*にする。*にできたら座標を$queueに詰める
    for ($k = -1; $k <= 1; $k += 2) {
        if ($y + $k >= 0 && $y + $k <= $h - 1 && $field[$y + $k][$x] === ".") {
            $field[$y + $k][$x] = "*";
            $queue[] = [$y + $k, $x];
        }
        if ($x + $k >= 0 && $x + $k <= $w - 1 && $field[$y][$x + $k] === ".") {
            $field[$y][$x + $k] = "*";
            $queue[] = [$y, $x + $k];
        }
    }
}
// var_dump($field);

// 出力
foreach ($field as $f) {
    echo implode("", $f) . "\n";
}

// 入力例
// 3 3
// *.#
// ..#
// ##.
