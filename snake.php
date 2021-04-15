<?php

// 図形の高さと横幅、現在のyx座標、曲がり角の数を取得
[$h, $w, $y, $x, $n] = explode(" ", trim(fgets(STDIN)));
// 図形を取得し、横も配列に詰める
for ($i = 0; $i < $h; $i++) {
    $field = trim(fgets(STDIN));
    $field_arr[] = str_split($field);
}
// var_dump($field_arr);

// 曲がり角の番号と方向を取得
for ($i = 0; $i < $n; $i++) {
    $move[] = explode(" ", trim(fgets(STDIN)));
}
// var_dump($move);

// 蛇の向きを詰める配列を準備、最初の向きをN(北)にする
$snake = array_pad([], 101, 0);
$snake[0] = "N";
// var_dump($snake);

// $snakeが曲がるタイミングで方向(LかR)を詰める
for ($i = 0; $i < $n; $i++) {
    $snake[$move[$i][0]] = $move[$i][1];
}
// 曲がるタイミングでない時は直前の向きを継続、曲がる時は現在の向きと示された方向によって向きを変える
for ($i = 1; $i < 101; $i++) {
    if ($snake[$i] === 0) {
        $snake[$i] = $snake[$i - 1];
    } else {
        switch ($snake[$i - 1]) {
            case "N":
                if ($snake[$i] === "L") {
                    $snake[$i] = "W";
                } else {
                    $snake[$i] = "E";
                }
                break;
            case "S":
                if ($snake[$i] === "L") {
                    $snake[$i] = "E";
                } else {
                    $snake[$i] = "W";
                }
                break;
            case "E":
                if ($snake[$i] === "L") {
                    $snake[$i] = "N";
                } else {
                    $snake[$i] = "S";
                }
                break;
            case "W":
                if ($snake[$i] === "L") {
                    $snake[$i] = "S";
                } else {
                    $snake[$i] = "N";
                }
                break;
            default:
                break;
        }
    }
}
// var_dump($snake);

// 移動開始、現在地が#か*でなければ移動OK。現在地に*で印をつける
for ($i = 0; $i <= 100; $i++) {
    if ($field_arr[$y][$x] === ".") {
        switch ($snake[$i]) {
            case "N":
                $field_arr[$y][$x] = "*";
                $y--;
                break;
            case "S":
                $field_arr[$y][$x] = "*";
                $y++;
                break;
            case "E":
                $field_arr[$y][$x] = "*";
                $x++;
                break;
            case "W":
                $field_arr[$y][$x] = "*";
                $x--;
                break;
            default:
                break;
        }
    } else {
        break;
    }
}
// var_dump($field_arr);

// 出力
foreach ($field_arr as $val) {
    echo implode("", $val) . "\n";
}

// 入力例
// 5 5 3 1 3
// .....
// .....
// .....
// .....
// .....
// 2 R
// 4 R
// 6 R
