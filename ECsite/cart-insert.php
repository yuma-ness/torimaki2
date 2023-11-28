<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/cart-insert.css?v=1.0.1">
    <link rel="stylesheet" href="css/cart.css?v=1.0.1">
    <title>カート挿入</title>
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
<?php
$id=$_POST['id'];
if(!isset($_SESSION['product'])){
    $_SESSION['product']=[];
}
$_SESSION['product'][$id]=[
    'picture'=>$_POST['picture'],
    'name'=>$_POST['name'],
    'price'=>$_POST['price'],
    'exp'=>$_POST['exp']
];
echo '<p>カートに商品を追加しました。</p>';
echo '<hr>';
require 'cart.php';
?>
<?php require 'footer.php'; ?>