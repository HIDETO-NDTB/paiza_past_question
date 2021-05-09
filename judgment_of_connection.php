<?php
// 入力値の取得
[$n, $m] = explode(" ", trim(fgets(STDIN)));
for ($i = 0; $i < $m; $i++) {
    $line[] = explode(" ", trim(fgets(STDIN)));
}
// var_dump($line);

// $targetの為の$queue、最終結果を判断する為の$completeを準備。最初の数字を詰める
$queue[] = $complete[] = $line[0][0];

// $queueの先頭を$targetとし、移動先の数字を$queueと$complete（まだない場合に限る)に詰める
while (1) {
    $target = array_shift($queue);
    $unset = [];
    for ($i = 1; $i < count($line); $i++) {
        if ($line[$i][0] === $target) {
            $queue[] = $line[$i][1];
            if (!in_array($line[$i][1], $complete)) {
                $complete[] = $line[$i][1];
            }
            $unset[] = $i;
        } elseif ($line[$i][1] === $target) {
            $queue[] = $line[$i][0];
            if (!in_array($line[$i][0], $complete)) {
                $complete[] = $line[$i][0];
            }
            $unset[] = $i;
        }
    }
    // 詰め終わったものは$lineから削除
    foreach ($unset as $key) {
        unset($line[$key]);
    }
    $line = array_values($line);

    // $queueが空になれば終了
    if (empty($queue)) {
        break;
    }
}
// var_dump($complete);

// 出力
if (count($complete) === (int) $n) {
    echo "YES" . "\n";
} else {
    echo "NO" . "\n";
}

// 入力例
// 4 2
// 1 2
// 3 2
