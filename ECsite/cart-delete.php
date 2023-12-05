<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/cart-show.css?v=1.0.0">
    <link rel="stylesheet" href="css/cart.css?v=1.0.1">
    <title>カート削除</title>
</head>
<body>
<div class="flex">
<figure class="image">
<img src ="image/rogo.jpg" class="hed">
</figure>
<h1>カート</h1>
    <div id="div">   
        <a href="mypage.php" id="hi">マイページへ</a>
        <br>
        <a href="favorite-show.php" id="fa">お気に入りへ</a>
        <br>
        <a href="shohin_top.php" id="ab">商品トップへ</a>
        <br>
        <a href="logout_input.php">ログアウト</a>
        <br>
        <a href="cart-show.php">カート</a>
    </div>
</div>
<?php
unset($_SESSION['product'][$_GET['id']]);
echo 'カートから商品を削除しました。';
echo '<hr>';
require 'cart.php';
?>
<?php require 'footer.php'; ?>