<?php session_start(); ?>
<link rel="stylesheet" href="css/history.css?v=1.0.1">
<?php require 'db-connect.php'; ?>
<div class="flex">
<figure class="image">
<img src ="image/rogo.jpg">
</figure>
    <h1>注文履歴</h1>
    <div class="nav">
    
    <!-- ハンバーガーメニューの表示・非表示を切り替えるチェックボックス -->
    <input id="drawer_input" class="drawer_hidden" type="checkbox">

    <!-- ハンバーガーアイコン -->
    <label for="drawer_input" class="drawer_open"><span></span></label>

    <!-- メニュー -->
    <nav class="nav_content">
      <ul class="nav_list">
        <li class="nav_item"><a href="history.php" id="b">注文履歴</a></li>
        <li class="nav_item"><a href="mypage.php" id="b">マイページへ</a></li>
        <li class="nav_item"><a href="favorite-show.php" id="b">お気に入りへ</a></li>
        <li class="nav_item"><a href="shohin_top.php" id="b">商品トップへ</a></li>
        <li class="nav_item"><a href="cart-show.php" id="b">カート</a></li>
      </ul>
    </nav>

  </div>
    </div>
<?php
$dayopen=0;
unset($_SESSION['history']);
if(isset($_SESSION['customer'])){

if(!isset($_SESSION['history'])){
    $_SESSION['history']=[];
}

$pdo = new PDO($connect,USER,PASS);
$sql=$pdo->prepare('select id from purchase where customer_id=? order by id desc');
$sql->execute([$_SESSION['customer']['id']]);
$id=0;
$t=0;
$psql=$pdo->prepare('select * from purchase_history where purchase_id=? order by purchase_id desc');
$product=$pdo->prepare('select * from product where id=?');
foreach($sql as $a){
    $id=$a['id'];
    $psql->execute([$id]);
    foreach($psql as $row){
        $_SESSION['history'][$t]=[
            'purchase_id'=>$row['purchase_id'],
            'product_id'=>$row['shohin_id'],
            'count'=>$row['count']
        ];
        $t++;
    }
}
$total=0;
$kaw=0;
echo '<table frame="box" align="center">';
//echo '<tr><th>商品名</th><th>価格</th><th>個数</th><th>小計</th></tr>';
    foreach($_SESSION['history'] as $hisid=>$row2){
    $nowid=$row2['purchase_id']; 
    $product->execute([$row2['product_id']]);
    if($kaw==0){
        $tabid=$row2['purchase_id'];
        $kaw=1;
    }
    if($tabid==$nowid){
        echo '';
    }else{
    echo '<tr><td></td><td></td><td></td><td></td><td>','合計金額:','￥',$total,'</td></tr>';
    echo '</table>';
    $dayopen=0;
    echo '<table frame="box" align="center">';
    //echo '<tr><th>　　　</th><th>商品名</th><th>価格</th><th>個数</th><th>小計</th></tr>';
    $tabid=$row2['purchase_id'];
    $total=0;
    }    

    $t2=0;
    $osql=$pdo->prepare('select day from purchase_history where purchase_id=? limit 1');
    foreach($product as $pros){
        echo '<tr>';
        $osql->execute([$nowid]);
    if($dayopen==0){
        foreach($osql as $wer){
            echo '<th>',$wer['day'],'</th>';
        }
    $dayopen=1;
    }
        echo '</tr>';
        $t2++;
        echo '<tr>';
        echo '<td><img alt="image" src="image/',$pros['id'],'.png" id="rank" width="150" height="150"></td>';
        echo '<td>',$pros['shohin_name'],'</td>','<br>';
        echo '</tr>';
        echo '<tr>';
        echo '<td></td><td>','￥',$pros['shohin_price'],'</td>';
        echo '<td><td></td><td>','(',$row2['count'],'点)','</td>';
        $goukei=$pros['shohin_price']*$row2['count'];
        $total+=$goukei;
        //echo '<td>',$goukei,'</td>';
        echo '</tr>';
    }   

}
echo '<tr><td></td><td></td><td></td><td></td><td>','合計金額:','￥',$total,'</td></tr>';
echo '</table>';
    



unset($_SESSION['history']);


}else{
    echo 'ログインしてください。';
}
?>


<?php require 'footer.php'; ?> 