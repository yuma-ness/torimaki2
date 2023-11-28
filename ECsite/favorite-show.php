<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/mypage.css?v=1.0.0">
    <title>お気に入り</title>
</head>
<body>
<div class="flex">
<figure class="image">
<img src ="image/rogo.jpg" class="hed">
</figure>
<h1>お気に入り</h1>
<div id="div">
<a href="mypage.php" id="hi">マイページへ</a>
</div>
</div>
<?php require 'db-connect.php'; ?>
<?php require 'favorite.php';?>
<?php require 'footer.php'; ?> 