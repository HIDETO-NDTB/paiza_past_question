<?php

// 高さ、幅、行動回数を取得し、$fieldと$gameを取得
[$h, $w, $n] = explode(" ", trim(fgets(STDIN)));
for ($i = 0; $i < $h; $i++) {
    $field[] = str_split(trim(fgets(STDIN)));
}
// var_dump($field);
for ($i = 0; $i < $n * 2; $i++) {
    $game[] = explode(" ", trim(fgets(STDIN)));
}
// var_dump($game);

// ゲームのターンを管理する$turnを準備
$turn = ["A", "B"];
// var_dump($turn);

for ($i = 0; $i < $n * 2; $i++) {
    // 共通処理
    $y = $game[$i][0];
    $x = $game[$i][1];
    if ($i % 2 === 0) {
        $field[$y][$x] = "A";
    } else {
        $field[$y][$x] = "B";
    }

    // 縦列
    for ($j = -1; $j <= 1; $j += 2) {
        for ($k = 1; ; $k++) {
            if (
                $y + $j * $k === -1 ||
                $y + $j * $k === (int) $h ||
                $field[$y + $j * $k][$x] === "#"
            ) {
                break;
            }
            // AかBかを$turnで判定
            if ($field[$y + $j * $k][$x] === $turn[$i % 2]) {
                for (
                    $l = min($y, $y + $j * $k);
                    $l < max($y, $y + $j * $k);
                    $l++
                ) {
                    $field[$l][$x] = $turn[$i % 2];
                }
                break;
            }
        }
    }

    // 横列
    for ($j = -1; $j <= 1; $j += 2) {
        for ($k = 1; ; $k++) {
            if (
                $x + $j * $k === -1 ||
                $x + $j * $k === (int) $w ||
                $field[$y][$x + $j * $k] === "#"
            ) {
                break;
            }
            if ($field[$y][$x + $j * $k] === $turn[$i % 2]) {
                for (
                    $l = min($x, $x + $j * $k);
                    $l < max($x, $x + $j * $k);
                    $l++
                ) {
                    $field[$y][$l] = $turn[$i % 2];
                }
                break;
            }
        }
    }

    // 斜め
    for ($j = -1; $j <= 1; $j += 2) {
        for ($k = 1; ; $k++) {
            if (
                $y + $j * $k === -1 ||
                $y + $j * $k === (int) $h ||
                $x + $j * $k === -1 ||
                $x + $j * $k === (int) $w ||
                $field[$y + $j * $k][$x + $j * $k] === "#"
            ) {
                break;
            }
            if ($field[$y + $j * $k][$x + $j * $k] === $turn[$i % 2]) {
                for (
                    $l = min($y, $y + $j * $k);
                    $l < max($y, $y + $j * $k);
                    $l++
                ) {
                    $field[$l][$l - $y + $x] = $turn[$i % 2];
                }
                break;
            }
        }
    }

    for ($j = -1; $j <= 1; $j += 2) {
        for ($k = 1; ; $k++) {
            if (
                $y - $j * $k === -1 ||
                $y - $j * $k === (int) $h ||
                $x + $j * $k === -1 ||
                $x + $j * $k === (int) $w ||
                $field[$y - $j * $k][$x + $j * $k] === "#"
            ) {
                break;
            }
            if ($field[$y - $j * $k][$x + $j * $k] === $turn[$i % 2]) {
                for (
                    $l = min($x, $x + $j * $k);
                    $l < max($x, $x + $j * $k);
                    $l++
                ) {
                    $field[$x + $y - $l][$l] = $turn[$i % 2];
                }
                break;
            }
        }
    }
}

// 出力
foreach ($field as $f) {
    echo implode("", $f) . "\n";
}

//入力例
// 5 5 3
// ....#
// .....
// .....
// .....
// .#...
// 0 0
// 4 0
// 2 2
// 4 2
// 3 4
// 1 1
