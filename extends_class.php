<?php
// 入力値の取得
[$mem_num, $order_num] = explode(" ", trim(fgets(STDIN)));
for ($i = 0; $i < $mem_num; $i++) {
    $mem[] = trim(fgets(STDIN));
}
for ($i = 0; $i < $order_num; $i++) {
    $order[] = explode(" ", trim(fgets(STDIN)));
}

// 親クラスCustomer(アルコール以外の注文を処理)
class Customer
{
    public int $age;
    public int $price;
    public bool $alc_flg;

    public function __construct($age)
    {
        $this->age = $age;
        $this->price = 0;
        $this->alc_flg = false;
    }

    public function order($item, $price)
    {
        if ($item === "food") {
            if ($this->alc_flg === false) {
                $this->price += $price;
            } else {
                $this->price += $price - 200;
            }
        } elseif ($item === "softdrink") {
            $this->price += $price;
        }
    }
}

// 子クラスAdult_customer(アルコールの注文を処理)
class Adult_customer extends Customer
{
    public function order($item, $price)
    {
        parent::order($item, $price);

        if ($item === "alcohol") {
            $this->price += $price;
            $this->alc_flg = true;
        }
    }
}

// 年齢によりインスタンス
for ($i = 0; $i < $mem_num; $i++) {
    if ($mem[$i] < 20) {
        $table[] = new Customer($mem[$i]);
    } else {
        $table[] = new Adult_customer($mem[$i]);
    }
}
// var_dump($table);

// 注文処理
for ($i = 0; $i < $order_num; $i++) {
    $table[$order[$i][0] - 1]->order($order[$i][1], $order[$i][2]);
}

// 出力
for ($i = 0; $i < $mem_num; $i++) {
    echo $table[$i]->price . "\n";
}

// 入力例
// 7 7
// 62
// 91
// 29
// 33
// 79
// 15
// 91
// 2 food 3134
// 7 alcohol 2181
// 6 softdrink 4631
// 3 softdrink 3120
// 4 softdrink 4004
// 6 alcohol 1468
// 6 alcohol 1245
