<?php

// 座標と歩数を取得
[$x, $y, $move] = explode(" ", trim(fgets(STDIN)));

// 向きを把握する配列を準備し、最初のキーにN(北)を詰める
$direction = array_pad([], $move, 0);
$direction[0] = "N";
// var_dump($direction);

// 動くべき方向を取得し、文字列で連結した物を配列で分ける
for ($i = 0; $i < $move; $i++) {
    $direction[$i] .= trim(fgets(STDIN));
    $direction_arr[] = str_split($direction[$i]);
}
// var_dump($direction_arr);

// 移動開始
for ($i = 0; $i < $move; $i++) {
    switch ($direction_arr[$i][0]) {
        case "N":
            if ($direction_arr[$i][1] === "L") {
                $x--;
                // 次の移動の為に向きを次のキーに詰める
                if (isset($direction_arr[$i + 1])) {
                    $direction_arr[$i + 1][0] = "W";
                }
            } else {
                $x++;
                if (isset($direction_arr[$i + 1])) {
                    $direction_arr[$i + 1][0] = "E";
                }
            }
            break;
        case "S":
            if ($direction_arr[$i][1] === "L") {
                $x++;
                if (isset($direction_arr[$i + 1])) {
                    $direction_arr[$i + 1][0] = "E";
                }
            } else {
                $x--;
                if (isset($direction_arr[$i + 1])) {
                    $direction_arr[$i + 1][0] = "W";
                }
            }
            break;
        case "E":
            if ($direction_arr[$i][1] === "L") {
                $y--;
                if (isset($direction_arr[$i + 1])) {
                    $direction_arr[$i + 1][0] = "N";
                }
            } else {
                $y++;
                if (isset($direction_arr[$i + 1])) {
                    $direction_arr[$i + 1][0] = "S";
                }
            }
            break;
        case "W":
            if ($direction_arr[$i][1] === "L") {
                $y++;
                if (isset($direction_arr[$i + 1])) {
                    $direction_arr[$i + 1][0] = "S";
                }
            } else {
                $y--;
                if (isset($direction_arr[$i + 1])) {
                    $direction_arr[$i + 1][0] = "N";
                }
            }
            break;
    }
    // var_dump($direction_arr);

    // 出力
    echo $x . " " . $y . "\n";
}

// 入力例
// -18 45 6
// L
// L
// R
// R
// L
// R
