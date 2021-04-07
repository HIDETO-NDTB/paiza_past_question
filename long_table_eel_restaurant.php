<?php

// 入力値より席数・グループ数を取得
[$seats, $groups] = explode(" ", trim(fgets(STDIN)));
// それぞれのグループの人数・開始席を取得
for ($i = 0; $i < $groups; $i++) {
    $costomer[] = explode(" ", trim(fgets(STDIN)));
}
// var_dump($costomer);

// 終了席を求める関数
function get_end($start, $member, $seats)
{
    if ($start + $member - 1 <= $seats) {
        return $start + $member - 1;
    } else {
        return $start + $member - 1 - $seats;
    }
}

// 座りたい席を配列で返す関数
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
    $dup_flg = "false";
    foreach ($arr1 as $val1) {
        foreach ($arr2 as $val2) {
            if ($val1 === $val2) {
                $dup_flg = "true";
            }
        }
    }
    return $dup_flg;
}

// 最終的に埋まっている席の配列
$full_seat = [];

// それぞれのグループが来店し、席が空いていれば座る
for ($i = 0; $i < $groups; $i++) {
    if (
        is_dup(
            get_seat(
                $costomer[$i][1],
                get_end($costomer[$i][1], $costomer[$i][0], $seats),
                $seats
            ),
            $full_seat
        ) === "false"
    ) {
        $full_seat = array_merge(
            $full_seat,
            get_seat(
                $costomer[$i][1],
                get_end($costomer[$i][1], $costomer[$i][0], $seats),
                $seats
            )
        );
    }
}
// var_dump($full_seat);

echo count($full_seat) . "\n";
