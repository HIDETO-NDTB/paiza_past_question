<?php

// 入力値より席数・グループ数を取得
[$seats, $groups] = explode(" ", trim(fgets(STDIN)));

// テーブルを再現し、着席している席には1を入れる配列
$seat_no = array_pad([], $seats, 0);
// var_dump($seat_no);

// 着席できた人数をカウント
$count = 0;

// それぞれのグループの人数・開始席を取得
for ($i = 0; $i < $groups; $i++) {
    [$guest_num, $sit_point] = explode(" ", trim(fgets(STDIN)));
    $sit_point--;
    // 座れる状態であればtrue
    $sit_flg = true;

    // 空席チェック
    for ($j = $sit_point; $j < $sit_point + $guest_num; $j++) {
        if ($seat_no[$j % $seats] > 0) {
            $sit_flg = false;
            break;
        }
    }

    // グループ全員分が空席なら着席
    if ($sit_flg === true) {
        for ($j = $sit_point; $j < $sit_point + $guest_num; $j++) {
            $seat_no[$j % $seats] = 1;
            $count++;
        }
    }
}

echo $count;
