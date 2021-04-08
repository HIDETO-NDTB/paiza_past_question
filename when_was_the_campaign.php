<?php
// 全日数とキャンペーン日数を取得
[$total_days, $campaign] = explode(" ", trim(fgets(STDIN)));
// 1日毎の来客数を配列に入れる
$guest = explode(" ", trim(fgets(STDIN)));
// var_dump($guest);

// 最終チェック用の配列を準備(配列の数は全日数とキャンペーン日数から導く)
$check_data = array_pad([], $total_days - $campaign + 1, 0);
// var_dump($check_data);

// 来客数データの最初からキャンペーン日数の塊での平均来客数を出し、チェック用配列に入れる
for ($i = 0; $i < $total_days - $campaign + 1; $i++) {
    $data = array_slice($guest, $i, $campaign);
    $total_guest = 0;
    $ave = 0;
    foreach ($data as $d) {
        $total_guest += $d;
        $ave = $total_guest / $total_days;
    }
    $check_data[$i] = $ave;
}

// 最大来客数が出てくるカウントとインデックスを算出して出力
$max = max($check_data);
$count = 0;
foreach ($check_data as $d) {
    if ($d === $max) {
        $count++;
    }
}
$index = array_search($max, $check_data) + 1;
echo $count . " " . $index;
