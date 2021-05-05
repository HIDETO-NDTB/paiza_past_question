<?php
// 高さ、幅、人数、ターン数を取得
[$h, $w, $mem_num, $turn_num] = explode(" ", trim(fgets(STDIN)));
// $fieldを取得
for ($i = 0; $i < $h; $i++) {
    $field[] = str_split(trim(fgets(STDIN)));
}
// var_dump($field);

// ログを取得
for ($i = 0; $i < $turn_num; $i++) {
    $log[] = explode(" ", trim(fgets(STDIN)));
}
// var_dump($log);

// ゲームを開始し、指手と座標を詰める
for ($i = 0; $i < $turn_num; $i++) {
    $turn = $log[$i][0];
    $y = $log[$i][1];
    $x = $log[$i][2];
    $field[$y][$x] = $turn;

    // 縦列検索
    for ($j = -1; $j <= 1; $j += 2) {
        for ($k = 1; $k < $h; $k++) {
            if (
                $y + $j * $k === -1 ||
                $y + $j * $k === (int) $h ||
                $field[$y + $j * $k][$x] === "#"
            ) {
                break;
            } elseif ($field[$y + $j * $k][$x] === $turn) {
                for (
                    $l = min($y + $j * $k, $y);
                    $l <= max($y + $j * $k, $y);
                    $l++
                ) {
                    $field[$l][$x] = $turn;
                }
                break;
            }
        }
    }
    // 横列検索
    for ($j = -1; $j <= 1; $j += 2) {
        for ($k = 1; $k < $w; $k++) {
            if (
                $x + $j * $k === -1 ||
                $x + $j * $k === (int) $w ||
                $field[$y][$x + $j * $k] === "#"
            ) {
                break;
            } elseif ($field[$y][$x + $j * $k] === $turn) {
                for (
                    $l = min($x + $j * $k, $x);
                    $l <= max($x + $j * $k, $x);
                    $l++
                ) {
                    $field[$y][$l] = $turn;
                }
                break;
            }
        }
    }
    // 斜め検索
    for ($j = -1; $j <= 1; $j += 2) {
        for ($k = 1; $k < $h; $k++) {
            if (
                $y + $j * $k === -1 ||
                $y + $j * $k === (int) $h ||
                $x + $j * $k === -1 ||
                $x + $j * $k === (int) $w ||
                $field[$y + $j * $k][$x + $j * $k] === "#"
            ) {
                break;
            } elseif ($field[$y + $j * $k][$x + $j * $k] === $turn) {
                for (
                    $l = min($y + $j * $k, $y);
                    $l <= max($y + $j * $k, $y);
                    $l++
                ) {
                    $field[$l][$l - $y + $x] = $turn;
                }
                break;
            }
        }
    }
    for ($j = -1; $j <= 1; $j += 2) {
        for ($k = 1; $k < $w; $k++) {
            if (
                $y - $j * $k === -1 ||
                $y - $j * $k === (int) $h ||
                $x + $j * $k === -1 ||
                $x + $j * $k === (int) $w ||
                $field[$y - $j * $k][$x + $j * $k] === "#"
            ) {
                break;
            } elseif ($field[$y - $j * $k][$x + $j * $k] === $turn) {
                for (
                    $l = min($x + $j * $k, $x);
                    $l <= max($x + $j * $k, $x);
                    $l++
                ) {
                    $field[$x + $y - $l][$l] = $turn;
                }
                break;
            }
        }
    }
}

// 出力
foreach ($field as $val) {
    echo implode("", $val) . "\n";
}

// 入力例
// 3 3 2 4
// ...
// ...
// .#.
// 1 0 0
// 2 2 0
// 1 0 2
// 2 2 2
