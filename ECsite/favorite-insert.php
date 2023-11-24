<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/favorite.css?v=1.0.0">
    <title>Document</title>
</head>
<body>
<div class="flex">
<figure class="image">
<img src ="image/rogo.jpg" class="hed">
</figure>
<h1>カート</h1>
<div id="div">
<a href="mypage.php" id="hi">マイページへ</a>
</div>
</div>
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