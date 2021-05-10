<?php

// $daysの配列を0から回しキャンペーン日数毎に足し算して$customerに詰めても良いが、$day_numの最大値が300,000で、
// その場合の計算量が多く、run time errorになることから、最初のキャンペーン日数の足し算から初めの日を引いて新たに1日分を足し
// $customerに詰めることで計算量を減らすことができる

// 入力値の取得
[$day_num, $campagn_num] = explode(" ", trim(fgets(STDIN)));
$days = explode(" ", trim(fgets(STDIN)));
// var_dump($days);

// キャンペーン日数の最初の合計を$customerに詰める
$total = 0;
for ($i = 0; $i < $campagn_num; $i++) {
    $total += $days[$i];
}
$customer[] = $total;
// var_dump($customer);

// 最新の合計値から初日分を引き、新たな1日分を足し、$customerに詰める
for ($i = 0; $i < $day_num - $campagn_num; $i++) {
    array_push(
        $customer,
        $customer[count($customer) - 1] - $days[$i] + $days[$campagn_num + $i]
    );
}
// var_dump($customer);

// 客数が最大値になる回数と初めの順番を取得
$max = max($customer);
$count = 0;
$index = "";
for ($i = count($customer) - 1; $i >= 0; $i--) {
    if ($customer[$i] === $max) {
        $count++;
        $index = $i + 1;
    }
}
// 出力
echo $count . " " . $index . "\n";

// 入力例
// 10 2
// 6 2 0 7 1 3 5 3 2 6
