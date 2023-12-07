<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/mypage.css?v=1.0.1">
    <title>Document</title>
</head>
<body>
<div class="flex">
<figure class="image">
<img src ="image/rogo.jpg" class="hed">
</figure>
<h1>お気に入り</h1>
<div class="nav">
    
    <!-- ハンバーガーメニューの表示・非表示を切り替えるチェックボックス -->
    <input id="drawer_input" class="drawer_hidden" type="checkbox">

    <!-- ハンバーガーアイコン -->
    <label for="drawer_input" class="drawer_open"><span></span></label>

    <!-- メニュー -->
    <nav class="nav_content">
      <ul class="nav_list">
        <li class="nav_item"><a href="mypage.php" id="b">マイページへ</a></li>
        <li class="nav_item"><a href="shohin_top.php" id="b">商品トップへ</a></li>
        <li class="nav_item"><a href="cart-show.php" id="b">カート</a></li>
        <li class="nav_item"><a href="logout_input.php" id="b">ログアウト</a></li>
      </ul>
    </nav>

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