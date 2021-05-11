<?php

// 入力値の取得
[$m, $n] = explode(" ", trim(fgets(STDIN)));
for ($i = 0; $i < $n; $i++) {
    $field[] = explode(" ", trim(fgets(STDIN)));
}
// var_dump($field);

// 島をカウントする変数を準備
$count = 0;
for ($i = 0; $i < $n; $i++) {
    for ($j = 0; $j < $m; $j++) {
        if ($field[$i][$j] === "1") {
            $field[$i][$j] = "2";
            $queue[] = [$i, $j];
            $count++;
            while (!empty($queue)) {
                $target = array_shift($queue);
                [$y, $x] = [$target[0], $target[1]];
                for ($k = -1; $k <= 1; $k += 2) {
                    // 縦チェック
                    if (
                        $y + $k !== -1 &&
                        $y + $k !== (int) $n &&
                        $field[$y + $k][$x] === "1"
                    ) {
                        $field[$y + $k][$x] = "2"; // 重複を防ぐ為にカウント済みの数字を変える
                        $queue[] = [$y + $k, $x];
                    }
                }
                for ($k = -1; $k <= 1; $k += 2) {
                    // 横チェック
                    if (
                        $x + $k !== -1 &&
                        $x + $k !== (int) $m &&
                        $field[$y][$x + $k] === "1"
                    ) {
                        $field[$y][$x + $k] = "2";
                        $queue[] = [$y, $x + $k];
                    }
                }
            }
        }
    }
}
// var_dump($field);

// 出力
echo $count . "\n";

// 入力例
// 6 6
// 1 1 1 1 1 1
// 1 0 1 0 0 0
// 1 0 1 0 1 1
// 0 1 0 0 0 1
// 1 0 1 1 1 1
// 0 1 0 0 0 0
