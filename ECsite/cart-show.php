<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/cart-show.css?v=1.0.0">
    <link rel="stylesheet" href="css/cart.css?v=1.0.1">
    <title>Document</title>
</head>
<body>
<div class="flex">
<figure class="image">
<img src ="image/rogo.jpg" class="hed">
</figure>
<h1>カート</h1>
<div id="hi">
<a href="mypage.php">マイページへ</a>
</div>
</div>
<?php require 'cart.php'; ?>
<?php require 'footer.php'; ?>