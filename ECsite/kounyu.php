<?php session_start(); ?>
<?php require 'header.php'; ?>
<link rel="stylesheet" href="css/konyu.css?v=1.0.0">
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
echo '<form action="konyukakunin.php" method="post" style="text-align: center">';
// echo '<table>';
//echo '<tr><th>商品番号</th><th>商品名</th><th>価格</th><th>サイズ</th><th>個数</th><th></th></tr>';
foreach($_SESSION['product'] as $id=>$product){
    if($i==1){
        $size=$id+10;
        $i++;
    }
echo '<table align="center" border="1">';
echo '<tr>';
echo '<div class="item">';
echo '<td><img alt="image" src="image/',$id,'.png" width="150" height="150"></td>';
echo '<input type="hidden" name="id" value="',$id,'">';
echo '<div class="item-s">';
echo '<td><div>',$product['name'],'<br>';//名前
echo '<span class="color">',$_POST[$size],'</span>','サイズ　';//サイズ
echo '<span class="color-1">',$_POST[$id],'</span>','個　';//個数
echo "￥",$product['price'],'</div></td>';//値
echo '</div>';
echo '</div>';
echo '</tr>';
echo '</table>';

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
    'size'=>$_POST[$size],
    'day'=>date("Y/m/i")
];
$size++;
}
echo '<table align="center">';
echo '<tr>';
echo '<th>';
echo '<div class="kane">';
echo '合計金額:';
echo '<div class="kane-s">';
echo "<label>￥",$total,"</label>税込";
echo '</div>';
echo '</div>';
echo '<h3>購入を確定しますか？</h3>';
echo '</th>';
echo '</tr>';
echo '</table>';

?>
</tr>
<tr>
<td>
<p><input type="submit" value="購入確定"></p>
</form>
<br>
<a href="cart-show.php">カートへ戻る</a>
</td>
</tr>
</table>
<?php require 'footer.php'; ?>