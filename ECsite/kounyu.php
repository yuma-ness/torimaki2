<?php session_start(); ?>
<?php require 'header.php'; ?>
<link rel="stylesheet" href="css/konyu.css">
<div class="flex">
<figure class="image"><img 
src="image/rogo.jpg">
</figure>
<h1>購入確認<h1>
</div>
<?php
$total=0;
if(!isset($_SESSION['ranking'])){
$_SESSION['ranking']=[];
}
if(!isset($_SESSION['purchase_history'])){
    $_SESSION['purchase_history']=[];
}
$i=1;
$size=0;
echo '<form action="konyukakunin.php" method="post">';
// echo '<table>';
//echo '<tr><th>商品番号</th><th>商品名</th><th>価格</th><th>サイズ</th><th>個数</th><th></th></tr>';
foreach($_SESSION['product'] as $id=>$product){
    if($i==1){
        $size=$id+10;
        $i++;
    }
echo '<div class="item">';
echo '<img alt="image" src="image/',$id,'.png" width="150" height="150">';
echo '<input type="hidden" name="id" value="',$id,'">';
echo '<div class="item-s">';
echo '<div>',$product['name'],'</div>';//名前
echo '<div>','<span class="color">',$_POST[$size],'</span>','　サイズ','</div>';//サイズ
echo '<div>',$_POST[$id],'　個</div>';//個数
echo '<div>',"￥",$product['price'],'</div>';//値段
echo '</div>';
echo '</div>';

$total=$total+$product['price']*$_POST[$id];

$_SESSION['ranking'][$id]=[ //ランキング
    'name'=>$product['name'],
    'count'=>$_POST[$id]
];

$_SESSION['purchase_history'][$id]=[ //購入履歴
    'customer_id'=>$_SESSION['customer']['id'],
    'name'=>$product['name'],
    'price'=>$product['price'],
    'shohin_picture'=>$id,
    'count'=>$_POST[$id],
    'size'=>$_POST[$size]
];
$size++;
}
echo '<div class="kane">';
echo '合計金額　　　　　　　　　　　　　　　　　　';
echo '<div class="kane-s">';
echo "￥",$total;
echo '</div>';
echo '</div>';
// echo '</table>';
echo '<h3>購入を確定しますか？</h3>';

// echo '<tr id="a">';
// echo '<td>','<img alt="image" src="image/',$id,'.png" style="width: 200px;
// height: 200px;">','</td>';
// echo '<input type="hidden" name="id" value="',$id,'">';
// echo '<td>',$product['name'],'</td>';//名前
// echo '<br>';
// echo '<td>',"数量：",$_POST[$id],'</td>';//個数
// echo '<td>',"サイズ：",$_POST[$size],'</td>';//サイズ
// echo '<td>',"￥",$product['price'],'</td>';//値段

// $total=$total+$product['price']*$_POST[$id];

// $_SESSION['ranking'][$id]=[ //ランキング
//     'name'=>$product['name'],
//     'count'=>$_POST[$id]
// ];

// $_SESSION['purchase_history'][$id]=[ //購入履歴
//     'customer_id'=>$_SESSION['customer']['id'],
//     'name'=>$product['name'],
//     'price'=>$product['price'],
//     'shohin_picture'=>$id,
//     'count'=>$_POST[$id],
//     'size'=>$_POST[$size]
// ];
// $size++;
// }
// echo '<tr><th>合計金額</th><th></th><th></th><th></th><th></th><th>',"￥",$total,'</th></tr>';
// echo '</table>';
// echo '<h3>購入を確定しますか？</h3>';
?>
<p><input type="submit" value="購入確定"></p>
</form>
<br>
<a href="cart-show.php">カートへ戻る</a>
<?php require 'footer.php'; ?>