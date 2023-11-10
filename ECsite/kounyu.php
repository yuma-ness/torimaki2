<?php session_start(); ?>
<?php require 'header.php'; ?>
<link rel="stylesheet" href="css/konyu.css">
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
echo '<table>';
//echo '<tr><th>商品番号</th><th>商品名</th><th>価格</th><th>サイズ</th><th>個数</th><th></th></tr>';
foreach($_SESSION['product'] as $id=>$product){
    if($i==1){
        $size=$id+10;
        $i++;
    }
echo '<tr>';
echo '<td><img alt="image" src="image/',$id,'.png"></td>';
echo '<input type="hidden" name="id" value="',$id,'">';
echo '<td>',$product['name'],'</td>';//名前
echo '<td>',"￥",$product['price'],'</td>';//値段
echo '<td>',$_POST[$size],'</td>';//サイズ
echo '<td>',$_POST[$id],'</td>';//個数

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
echo '<tr><th>合計金額</th><th></th><th></th><th></th><th></th><th>',"￥",$total,'</th></tr>';
echo '</table>';
echo '<h3>購入を確定しますか？</h3>';
?>
<p><input type="submit" value="購入確定"></p>
</form>
<br>
<a href="cart-show.php">カートへ戻る</a>
<?php require 'footer.php'; ?>