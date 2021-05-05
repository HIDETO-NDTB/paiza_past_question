<?php
// 入力値を取得
[$piece_num, $pazzle_size, $piece_size] = explode(" ", trim(fgets(STDIN)));
for ($i = 0; $i < $pazzle_size; $i++) {
    $pazzle[] = trim(fgets(STDIN));
}
// パズルをピースと同じ大きさに分割
for ($i = 0; $i < $pazzle_size; $i++) {
    for ($j = 0; $j < $pazzle_size; $j += $piece_size) {
        $formed_pazzle[$i][] = mb_substr($pazzle[$i], $j, $piece_size);
    }
}
// var_dump($formed_pazzle);
// パズルをピースの集合体に整形
for ($i = 0; $i < $pazzle_size; $i += $piece_size) {
    for ($j = 0; $j < count($formed_pazzle[$i]); $j++) {
        for ($k = 0; $k < $piece_size; $k++) {
            $formed_pazzle2[$i + $j][] = $formed_pazzle[$i + $k][$j];
        }
    }
}
// キーの数字の飛びを補正
$formed_pazzle2 = array_values($formed_pazzle2);
// var_dump($formed_pazzle2);

// 入力からピースを取得
for ($i = 0; $i < $piece_num * $piece_size; $i++) {
    $piece[] = trim(fgets(STDIN));
}
// ピースを整形
$formed_piece = array_chunk($piece, $piece_size);
// var_dump($formed_piece);

// 回答を出力する為の座標を取得
for ($i = 1; $i < $pazzle_size; $i += $piece_size) {
    for ($j = 1; $j < $pazzle_size; $j += $piece_size) {
        $field[] = [$i, $j];
    }
}
// var_dump($field);

// ピースの順番にパズルに入るか検索
for ($i = 0; $i < $piece_num; $i++) {
    // 回転用の$nを準備
    for ($n = 0; $n <= 3; $n++) {
        $error = 0;
        for ($j = 0; $j < count($formed_pazzle2); $j++) {
            if ($formed_piece[$i] === $formed_pazzle2[$j]) {
                $result[$i] = [$j, $n];
                $n = 3;
                break;
            } else {
                $error++;
                // そのままではパズルに入らないので、回転処理を行う
                if ($error === count($formed_pazzle2)) {
                    $temp = $formed_piece[$i];
                    $formed_piece[$i] = [];
                    $temp_arr = $formed_temp_str = $formed_temp = [];
                    // var_dump($temp);
                    for ($k = 0; $k < $piece_size; $k++) {
                        for ($l = $piece_size - 1; $l >= 0; $l--) {
                            $temp_arr[] = mb_substr($temp[$l], $k, 1);
                        }
                    }
                    // var_dump($temp_arr);
                    $formed_temp_str = implode("", $temp_arr);
                    // var_dump($formed_temp_str);
                    for (
                        $k = 0;
                        $k < mb_strlen($formed_temp_str);
                        $k += $piece_size
                    ) {
                        $formed_temp[] = mb_substr(
                            $formed_temp_str,
                            $k,
                            $piece_size
                        );
                    }
                    // var_dump($formed_temp);
                    $formed_piece[$i] = $formed_temp;
                    // var_dump($formed_piece);
                    // var_dump($temp);
                }
            }
            // 3回転させてもパズルに入らない場合はngを詰める
            if ($n === 3 && $error === count($formed_pazzle2)) {
                $result[$i] = "ng";
            }
        }
    }
}
// var_dump($result);

// 出力
for ($i = 0; $i < $piece_num; $i++) {
    if ($result[$i] === "ng") {
        echo "-1" . "\n";
    } else {
        echo $field[$result[$i][0]][0] .
            " " .
            $field[$result[$i][0]][1] .
            " " .
            $result[$i][1] .
            "\n";
    }
}

// 入力例
// 10 6 3
// YYYBYB
// BYYBBB
// BYYBBB
// BYYBYB
// BBYYYY
// YYYYYB
// YYB
// BBY
// BYB
// BBY
// YBB
// BYB
// BBY
// YBB
// YYB
// BBB
// BBB
// BYB
// BYB
// BYB
// YYB
// YYY
// YYY
// YBY
// YYY
// YBB
// YYB
// YYB
// YYB
// YYY
// YYB
// YYY
// BYB
// BBB
// YYB
// BYY
