<?php

// 人数、単語数、しりとりゲーム数を取得
[$mem_num, $word_num, $game_num] = explode(" ", trim(fgets(STDIN)));

// しりとりで発言しても良い言葉を取得
for ($i = 0; $i < $word_num; $i++) {
    $words[] = trim(fgets(STDIN));
}
// var_dump($words);

// しりとりの内容を取得
for ($i = 0; $i < $game_num; $i++) {
    $game[] = trim(fgets(STDIN));
}
// var_dump($game);

// 参加者を配列に詰める
for ($i = 0; $i < $mem_num; $i++) {
    $mem[] = $i + 1;
}
// var_dump($mem);

// しりとり開始
$first_flg = true;
$logs = [];
$turn = 1;
$loser = [];
for ($i = 0; $i < $game_num; $i++) {
    $error_flg = false;
    // 1人目以外もしくは前の人がミスをした以外の場合
    if ($first_flg === false) {
        if (
            mb_substr($logs[0], mb_strlen($logs[0]) - 1, 1) !==
            mb_substr($game[$i], 0, 1)
        ) {
            $error_flg = true;
        }
    }
    // 他のルールチェック
    if (!in_array($game[$i], $words)) {
        $error_flg = true;
    }
    if (in_array($game[$i], $logs)) {
        $error_flg = true;
    }
    if (mb_substr($game[$i], mb_strlen($game[$i]) - 1, 1) === "z") {
        $error_flg = true;
    }
    // 1つでもルールに反した場合は$loserに詰める
    if ($error_flg === true) {
        $loser[] = $turn;
        $first_flg = true;
    } else {
        $first_flg = false;
    }

    // 直近の発言を$logの先頭に詰める
    array_unshift($logs, $game[$i]);

    // 全ての人のターンが終わっているか確認し、それぞれ処理
    if ($turn !== $mem[count($mem) - 1]) {
        $turn = $mem[array_search($turn, $mem) + 1];
    } else {
        foreach ($loser as $l) {
            unset($mem[array_search($l, $mem)]);
        }
        $loser = [];
        $mem = array_values($mem);
        $turn = $mem[0];
    }
    // ターン終了前でも最終ゲームの場合は脱落者処理
    if ($i === $game_num - 1) {
        foreach ($loser as $l) {
            unset($mem[array_search($l, $mem)]);
        }
        $mem = array_values($mem);
    }
}
// var_dump($mem);

// 残っている人数と番号を出力
echo count($mem) . "\n";
foreach ($mem as $m) {
    echo $m . "\n";
}

// 入力例
// 3 6 7
// a
// aloha
// app
// az
// paiza
// warp
// app
// paiza
// a
// aloha
// az
// warp
// paiza
