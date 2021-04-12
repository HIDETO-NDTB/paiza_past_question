<?php
// 縦・横の取得
[$h, $w] = explode(" ", trim(fgets(STDIN)));
// 盤面を取得し、横を文字列から配列に
for ($i = 0; $i < $h; $i++) {
    $str = trim(fgets(STDIN));
    $data[] = str_split($str);
}
// var_dump($data);

// 横並びチェック
$w_ans = [];
for ($i = 0; $i < $h; $i++) {
    for ($j = 0; $j < $w; $j++) {
        if (
            isset($data[$i][$j - 1]) &&
            $data[$i][$j - 1] === "#" &&
            isset($data[$i][$j + 1]) &&
            $data[$i][$j + 1] === "#"
        ) {
            $w_ans[] = [$i, $j];
        } elseif (!isset($data[$i][$j - 1]) && $data[$i][$j + 1] === "#") {
            $w_ans[] = [$i, $j];
        } elseif (!isset($data[$i][$j + 1]) && $data[$i][$j - 1] === "#") {
            $w_ans[] = [$i, $j];
        }
    }
}
// var_dump($w_ans);

// 縦並びチェック
$h_ans = [];
for ($i = 0; $i < $w; $i++) {
    for ($j = 0; $j < $h; $j++) {
        if (
            isset($data[$j - 1][$i]) &&
            $data[$j - 1][$i] === "#" &&
            isset($data[$j + 1][$i]) &&
            $data[$j + 1][$i] === "#"
        ) {
            $h_ans[] = [$j, $i];
        } elseif (!isset($data[$j - 1][$i]) && $data[$j + 1][$i] === "#") {
            $h_ans[] = [$j, $i];
        } elseif (!isset($data[$j + 1][$i]) && $data[$j - 1][$i] === "#") {
            $h_ans[] = [$j, $i];
        }
    }
}
// var_dump($h_ans);

// 横縦共通の値を$ansに詰める
foreach ($w_ans as $w) {
    foreach ($h_ans as $h) {
        if ($w === $h) {
            $ans[] = $w;
        }
    }
}
// var_dump($ans);

for ($i = 0; $i < count($ans); $i++) {
    echo $ans[$i][0] . " " . $ans[$i][1] . "\n";
}

// 3 3　縦、横
// ##.　盤面
// ###
// ...
