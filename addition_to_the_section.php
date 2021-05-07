<?php

// 普通に$taskを回して全て計算することで回答を出せるが、入力値が大きい場合にrun time errorとなる。
// そこでimos法というアルゴリズムを使用。
// 1 $taskを回し、区間の開始に値をプラス、区間の終わり+1に値をマイナス
// 2 全てのタスクを回したら、$addを累積和にする $i+1 = $i + $i+1
// 3 $dataに累積和にした$addを足して出力

[$data_num, $task_num] = explode(" ", trim(fgets(STDIN)));
$data = explode(" ", trim(fgets(STDIN)));
for ($i = 0; $i < $task_num; $i++) {
    $task[] = explode(" ", trim(fgets(STDIN)));
}
// var_dump($data);
// var_dump($task);

for ($i = 0; $i < $data_num; $i++) {
    $add[$i] = 0;
}

for ($i = 0; $i < $task_num; $i++) {
    $add[$task[$i][0] - 1] += $task[$i][2];
    if (isset($add[$task[$i][1]])) {
        $add[$task[$i][1]] -= $task[$i][2];
    }
}

for ($i = 0; $i < $data_num - 1; $i++) {
    $add[$i + 1] = $add[$i] + $add[$i + 1];
}
// var_dump($add);

for ($i = 0; $i < $data_num; $i++) {
    echo $data[$i] + $add[$i] . "\n";
}

// 入力例
// 10 5
// 1 2 3 4 5 6 7 8 9 10
// 1 6 10
// 8 10 5
// 2 8 3
// 3 7 -5
// 3 6 1
