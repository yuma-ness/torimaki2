<?php session_start(); ?>
<?php require 'header.php'; ?>
<?php require 'db-connect.php'; ?>
<?php
if(isset($_SESSION['customer'])){
    $pdo = new PDO($connect,USER,PASS);
    $sql=$pdo->prepare('insert into favorite values(?,?) on duplicate key update shohin_id=shohin_id,customer_id=customer_id');
    $sql->execute([$_GET['id'],$_SESSION['customer']['id']]);
    echo 'お気に入りに商品を追加しました。';
    echo '<hr>';
    require 'favorite.php';
}else{
    echo 'お気に入りに商品を追加するにはログインしてください。';
}
?>
<?php require 'footer.php'; ?>  