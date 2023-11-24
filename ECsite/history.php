<?php session_start(); ?>
<?php require 'header.php'; ?>
<?php require 'menu.php'; ?>
<?php require 'db-connect.php'; ?>
<?php
if(isset($_SESSION['customer'])){

if(!isset($_SESSION['history'])){
    $_SESSION['history']=[];
}

$pdo = new PDO($connect,USER,PASS);
$sql=$pdo->prepare('select id from purchase where customer_id=?');
$sql->execute([$_SESSION['customer']['id']]);
$id=0;
$t=0;
$psql=$pdo->prepare('select * from purchase_history where purchase_id=?');
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
echo '<table>';
echo '<tr><th>商品番号</th><th>商品名</th><th>価格</th><th>個数</th><th>小計</th></tr>';
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
    echo '<tr><td>合計</td><td></td><td></td><td></td><td>',$total,'</td></tr>';
    echo '<table>';
    echo '<tr><th>　　　</th><th>商品名</th><th>価格</th><th>個数</th><th>小計</th></tr>';
    $tabid=$row2['purchase_id'];
    $total=0;
    }    
    foreach($product as $pros){
        echo '<tr>';
        echo '<td><img alt="image" src="image/',$pros['id'],'.png" id="rank"></td>';
        echo '<td>',$pros['shohin_name'],'</td>';
        echo '<td>',$pros['shohin_price'],'</td>';
        echo '<td>',$row2['count'],'</td>';
        $goukei=$pros['shohin_price']*$row2['count'];
        $total+=$goukei;
        echo '<td>',$goukei,'</td>';
        echo '</tr>';
    }   
}
echo '<tr><td>合計</td><td></td><td></td><td></td><td>',$total,'</td></tr>';
    



unset($_SESSION['history']);


}else{
    echo 'ログインしてください。';
}
?>
<?php require 'footer.php'; ?> 