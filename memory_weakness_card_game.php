<?php
// カードの縦・横と参加人数を取得
[$h, $w, $mem] = explode(" ", trim(fgets(STDIN)));

$card = [];
$whose_turn = 1;
$get_card = [];

// カードの値を取得
for ($i = 0; $i < $h; $i++) {
    $val[] = explode(" ", trim(fgets(STDIN)));
}

// $cardに[座標番号]=>値となるよう詰める(後のログと合うよう、座標をそれぞれプラス1)
for ($i = 0; $i < $h; $i++) {
    for ($j = 0; $j < $w; $j++) {
        $card[$i + "1" . $j + "1"] = $val[$i][$j];
    }
}
// var_dump($card);

// 参加者のカード取得情報を入れた配列を0でセット
for ($i = 0; $i < $mem; $i++) {
    $get_card[$i + 1] = 0;
}

// ターン数とログを取得
$turn = trim(fgets(STDIN));
for ($i = 0; $i < $turn; $i++) {
    [$y[0], $x[0], $y[1], $x[1]] = explode(" ", trim(fgets(STDIN)));
    $open_card[$i] = [$y[0] . $x[0], $y[1] . $x[1]];
}
// var_dump($open_card);

// ログの座標から値を導き、カードが異なる場合は順番を送る。合致した場合はカード取得を2枚増やす
for ($i = 0; $i < $turn; $i++) {
    if ($card[$open_card[$i][0]] !== $card[$open_card[$i][1]]) {
        if ((int) $whose_turn !== (int) $mem) {
            $whose_turn++;
        } else {
            $whose_turn = 1;
        }
    } else {
        $get_card[$whose_turn] += 2;
    }
}
// var_dump($get_card);

// 出力
foreach ($get_card as $val) {
    echo $val . "\n";
}
