<?php

// じゃんけん回数と出す指の合計を取得
[$battle_num, $fing_num] = explode(" ", trim(fgets(STDIN)));
// 相手の手の出し方を出力
$battle = trim(fgets(STDIN));

$game = [
    0 => "G",
    1 => "C",
    2 => "P",
];

// 相手のそれぞれの手を数える
for ($i = 0; $i < 3; $i++) {
    $your_hand[] = substr_count($battle, $game[$i]);
}
//var_dump($your_hand);

// 相手の手数を勝てる手数に変更する
$key = ["P", "G", "C"];
$win_hand = array_combine($key, $your_hand);
//var_dump($win_hand);

// 指の本数から自分の手数を特定する
for ($i = 0; $i < $fing_num; $i++) {
    for ($j = 0; $j < $fing_num; $j++) {
        if ($i * 2 + $j * 5 === (int) $fing_num && $i + $j <= $battle_num) {
            $my_hand[] = ["G" => $battle_num - $i - $j, "C" => $i, "P" => $j];
        }
    }
}
if (!isset($my_hand)) {
    $my_hand[] = ["G" => $battle_num, "C" => 0, "P" => 0];
}
// var_dump($my_hand);

// 勝てる手と自分の手数を比較し、勝ちの最大数を詰める
$max_win = 0;
for ($i = 0; $i < count($my_hand); $i++) {
    $win = 0;
    if ($win_hand["G"] <= $my_hand[$i]["G"]) {
        $win += $win_hand["G"];
    } else {
        $win += $my_hand[$i]["G"];
    }
    if ($win_hand["C"] <= $my_hand[$i]["C"]) {
        $win += $win_hand["C"];
    } else {
        $win += $my_hand[$i]["C"];
    }
    if ($win_hand["P"] <= $my_hand[$i]["P"]) {
        $win += $win_hand["P"];
    } else {
        $win += $my_hand[$i]["P"];
    }
    if ($max_win < $win) {
        $max_win = $win;
    }
}

echo $max_win . "\n";

// 入力例
// 5 10
// GPCPC
