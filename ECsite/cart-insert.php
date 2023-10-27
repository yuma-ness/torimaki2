<?php session_start(); ?>
<?php require 'header.php'; ?>
<link rel="stylesheet" href="css/cart-insert.css">
<link rel="stylesheet" href="css/cart.css">
<div id="back">
    <div id="link">
    <a href="index.php" id="moji">マイページへ</a>
    <h1>カート</h1>
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
    'price'=>$_POST['price']
];
echo '<p>カートに商品を追加しました。</p>';
echo '<hr>';
require 'cart.php';
?>
<?php require 'footer.php'; ?>