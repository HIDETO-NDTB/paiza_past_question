<?php

// 高さ、幅、最初のターン、$fieldを取得
[$h, $w] = explode(" ", trim(fgets(STDIN)));
$turn = trim(fgets(STDIN));
for ($i = 0; $i < $h; $i++) {
    $field[] = str_split(trim(fgets(STDIN)));
}
// var_dump($field);

// $queueに入れるそれぞれの順番を用意
if ($turn === "A") {
    $turn_num_a = 0;
    $turn_num_b = 1;
} else {
    $turn_num_a = 1;
    $turn_num_b = 0;
}

// それぞれのスタート地点と順番を$queueに詰める
for ($i = 0; $i < $h; $i++) {
    for ($j = 0; $j < $w; $j++) {
        if ($field[$i][$j] === "A") {
            $queue[0][] = [$i, $j, $turn_num_a];
        }
        if ($field[$i][$j] === "B") {
            $queue[1][] = [$i, $j, $turn_num_b];
        }
    }
}
// var_dump($queue);

$game_num = 0;
while (!empty($queue[0]) || !empty($queue[1])) {
    // $game_numでゲームのターンを管理し、それに合った座標を$yと$xに詰める
    if (!empty($queue[0]) && $queue[0][0][2] === $game_num) {
        $temp = array_shift($queue[0]);
        [$y, $x, $now_turn] = [$temp[0], $temp[1], "A"];
        $temp = [];
    } elseif (!empty($queue[1]) && $queue[1][0][2] === $game_num) {
        $temp = array_shift($queue[1]);
        [$y, $x, $now_turn] = [$temp[0], $temp[1], "B"];
        $temp = [];
    } else {
        // ターンが終了したら$game_numを更新
        $game_num++;
    }

    // 陣取り処理
    if ($y !== "") {
        for ($j = -1; $j <= 1; $j += 2) {
            if (
                $y + $j >= 0 &&
                $y + $j <= $h - 1 &&
                $field[$y + $j][$x] === "."
            ) {
                if ($now_turn === "A") {
                    $field[$y + $j][$x] = "A";
                    $queue[0][] = [$y + $j, $x, $game_num + 2];
                } else {
                    $field[$y + $j][$x] = "B";
                    $queue[1][] = [$y + $j, $x, $game_num + 2];
                }
            }
            if (
                $x + $j >= 0 &&
                $x + $j <= $w - 1 &&
                $field[$y][$x + $j] === "."
            ) {
                if ($now_turn === "A") {
                    $field[$y][$x + $j] = "A";
                    $queue[0][] = [$y, $x + $j, $game_num + 2];
                } else {
                    $field[$y][$x + $j] = "B";
                    $queue[1][] = [$y, $x + $j, $game_num + 2];
                }
            }
        }
    }
    // var_dump($field);
}

// 出力
$count_a = $count_b = 0;
for ($i = 0; $i < $h; $i++) {
    for ($j = 0; $j < $w; $j++) {
        if ($field[$i][$j] === "A") {
            $count_a++;
        } elseif ($field[$i][$j] === "B") {
            $count_b++;
        }
    }
}
echo $count_a . " " . $count_b . "\n";

if ($count_a > $count_b) {
    echo "A" . "\n";
} else {
    echo "B" . "\n";
}

// 入力例
// 3 3
// A
// A..
// ...
// ..B
