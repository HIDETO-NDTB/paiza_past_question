<?php

// 入力値より席数・グループ数を取得
[$seats, $groups] = explode(" ", trim(fgets(STDIN)));
// それぞれのグループの人数・開始席を取得 [人数, 開始席]
for ($i = 0; $i < $groups; $i++) {
    $costomer[] = explode(" ", trim(fgets(STDIN)));
}
// var_dump($costomer);

// 終了席を求める関数(総席数を超える場合は、1に戻る)
function get_end($start, $member, $seats)
{
    if ($start + $member - 1 <= $seats) {
        return $start + $member - 1;
    } else {
        return $start + $member - 1 - $seats;
    }
}

// 座りたい席を配列で返す関数(開始より終了が小さいかどうかで条件分岐)
function get_seat($start, $end, $seats)
{
    if ($start <= $end) {
        foreach (range($start, $end) as $seat) {
            $need_seat[] = $seat;
        }
    } else {
        foreach (range($start, $seats) as $seat) {
            $need_seat[] = $seat;
        }
        foreach (range(1, $end) as $seat) {
            $need_seat[] += $seat;
        }
    }
    return $need_seat;
}
// var_dump(get_seat(6, get_end(6, 4, 6), 6));

// 配列に重複した値があるか調べる関数
function is_dup($arr1, $arr2)
{
    $dup_flg = false;
    foreach ($arr1 as $val1) {
        foreach ($arr2 as $val2) {
            if ($val1 === $val2) {
                $dup_flg = true;
            }
        }
    }
    return $dup_flg;
}

// 最終的に埋まっている席の配列
$full_seat = [];

// それぞれのグループが来店し、席が空いていれば座る
for ($i = 0; $i < $groups; $i++) {
    $start = $costomer[$i][1];
    $end = get_end($start, $costomer[$i][0], $seats);
    if (!is_dup(get_seat($start, $end, $seats), $full_seat)) {
        $full_seat = array_merge($full_seat, get_seat($start, $end, $seats));
    }
}
// var_dump($full_seat);

echo count($full_seat) . "\n";
