<?php session_start(); ?>
<?php require 'header.php'; ?>
<link rel="stylesheet" href="css/konyu.css?v=1.0.2">
<div class="flex">
<figure class="image"><img 
src="image/rogo.jpg">
</figure>
<h1>購入確認</h1>
<div class="nav">
    
    <!-- ハンバーガーメニューの表示・非表示を切り替えるチェックボックス -->
    <input id="drawer_input" class="drawer_hidden" type="checkbox">

    <!-- ハンバーガーアイコン -->
    <label for="drawer_input" class="drawer_open"><span></span></label>

    <!-- メニュー -->
    <nav class="nav_content">
      <ul class="nav_list">
        <li class="nav_item"><a href="mypage.php" id="b">マイページへ</a></li>
        <li class="nav_item"><a href="favorite-show.php" id="b">お気に入りへ</a></li>
        <li class="nav_item"><a href="shohin_top.php" id="b">商品トップへ</a></li>
        <li class="nav_item"><a href="cart-show.php" id="b">カート</a></li>
        <li class="nav_item"><a href="logout_input.php" id="b">ログアウト</a></li>
      </ul>
    </nav>

  </div>
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
//echo '<input type="hidden" name="exp" value="',$_POST['exp'],'">';
echo '</div>';
echo '</div>';
echo '</tr>';
echo '</table>';

$total=$total+$product['price']*$_POST[$id];

$_SESSION['ranking'][$id]=[ //ランキング
    'name'=>$product['name'],
    'count'=>$_POST[$id],
    'colar'=>$product['exp']
];

$_SESSION['purchase_history'][$id]=[ //購入履歴
    'customer_id'=>$_SESSION['customer']['id'],
    'name'=>$product['name'],
    'price'=>$product['price'],
    'shohin_picture'=>$id,
    'count'=>$_POST[$id],
    'size'=>$_POST[$size],
    'day'=>date("Y/m/d")
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
?>
</tr>
<tr>
<td>
<p><button>購入確定</button></p>
</form>
</td>
</tr>
</table>
<?php require 'footer.php'; ?>
<!--  -->