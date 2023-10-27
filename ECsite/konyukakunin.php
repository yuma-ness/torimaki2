<?php session_start(); ?>
<?php require 'header.php'; ?>
<?php require 'db-connect.php'; ?>
購入が完了しました<br>
発送準備が出来次第お届けします<br>
<?php
$id=$_POST['id'];
$pdo = new PDO($connect,USER,PASS);
$sql = $pdo->prepare('select * from customer where user_name=?');
$sql->execute(['masa']);
foreach($sql as $row){
    echo $row['user_address'];
}
foreach($_SESSION['ranking'] as $id=>$ranking){
$sql = $pdo->prepare('replace into Ranking values(?,?,?)');
$sql->execute([$id,$ranking['name'],$ranking['count']]);
}
foreach($_SESSION['purchase_history'] as $history_id=>$history){
    $sql = $pdo->prepare('replace into purchase_history values("null",?,?,?,?,?,?)');
    $sql->execute([$history['shohin_id'],$history['customer_id'],$history['name'],$history['price'],$history['shohin_picture'],$history['count']]);
}
?>
<p><a href="shohin_top.php">商品一覧へ戻る</a></p>
<?php require 'footer.php'; ?>