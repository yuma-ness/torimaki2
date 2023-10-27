<?php session_start(); ?>
<?php require 'header.php'; ?>
<link rel="stylesheet" href="css/cart.css">
<link rel="stylesheet" href="css/cart-delete.css">
<div id="back">
    <div id="link">
    <h1>カート</h1>
    </div>
</div>
<?php
unset($_SESSION['product'][$_GET['id']]);
echo 'カートから商品を削除しました。';
echo '<hr>';
require 'cart.php';
?>
<?php require 'footer.php'; ?>