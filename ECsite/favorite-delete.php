<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/mypage.css?v=1.0.0">
    <title>Document</title>
</head>
<body>
<div class="flex">
<figure class="image">
<img src ="image/rogo.jpg" class="hed">
</figure>
<h1>お気に入り</h1>
    <div id="div">   
        <a href="mypage.php" id="hi">マイページへ</a>
        <br>
        <a href="favorite-show.php" id="favo">お気に入りへ</a>
        <br>
        <a href="shohin_top.php" id="ab">商品トップへ</a>
        <br>
        <a href="logout_input.php">ログアウト</a>
        <br>
        <a href="cart-show.php">カート</a>
    </div>
</div>
<?php require 'db-connect.php'; ?>
<?php
if(isset($_SESSION['customer'])){
    $pdo = new PDO($connect,USER,PASS);
    $sql=$pdo->prepare(
        'delete from favorite where customer_id=? and shohin_id=?'
    );
    $sql->execute([$_SESSION['customer']['id'],$_GET['id']]);
    echo 'お気に入りから削除しました。';
    echo '<hr>';
}else{
    echo 'お気に入りから商品を削除するにはログインしてください。';
}
require 'favorite.php';
?>
<?php require 'footer.php'; ?> 