<?php

// 歩数毎の動きを表現する配列を準備
$move = range(0, 100);
// var_dump($move);

// 曲がるポイントを配列に詰める
// 1と2を詰める
$turn = [1, 2];
// 2〜9の二乗と二乗同士の中間を詰める
for ($i = 2; $i <= 9; $i++) {
    array_push($turn, pow($i, 2), (pow($i + 1, 2) + pow($i, 2) - 1) / 2);
}
// var_dump($turn);

for ($i = 2; $i < 101; $i++) {
    $move[1] = "E";
    $count = mb_strlen($move[$i - 1]);
    $last = mb_substr($move[$i - 1], $count - 1, 1);
    // echo $count;
    // echo $last;

    // 曲がるポイントがきたら方向を変える
    if (in_array($i - 1, $turn)) {
        switch ($last) {
            case "E":
                $move[$i] = $move[$i - 1] . "S";
                break;
            case "S":
                $move[$i] = $move[$i - 1] . "W";
                break;
            case "W":
                $move[$i] = $move[$i - 1] . "N";
                break;
            case "N":
                $move[$i] = $move[$i - 1] . "E";
                break;
            default:
                break;
        }
    } else {
        // 曲がるポイント以外は直進する
        $move[$i] = $move[$i - 1] . $last;
    }
}

// var_dump($move);

// 入力の取得
[$x, $y, $distance] = explode(" ", trim(fgets(STDIN)));
// echo $move[$distance];

// $moveの文字列に合わせて座標を移動
for ($i = 0; $i < mb_strlen($move[$distance]); $i++) {
    $str = mb_substr($move[$distance], $i, 1);
    switch ($str) {
        case "E":
            $x++;
            break;
        case "W":
            $x--;
            break;
        case "S":
            $y++;
            break;
        case "N":
            $y--;
            break;
        default:
            // code...
            break;
    }
}

// 出力
echo $x . " " . $y . "\n";

// 入力例
// 0 0 3

// 0 0 0
// 1 1 0 E
// 2 1 -1 ES
// 3 0 -1 ESW
// 4 -1 -1 ESWW
// 5 -1 0 ESWWN
// 6 -1 1 ESWWNN
// 7 0 1 ESWWNNE
// 8 1 1 ESWWNNEE
// 9 2 1 ESWWNNEEE
