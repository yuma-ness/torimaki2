<?php session_start(); ?>
<link rel="stylesheet" href="css/konyukakunin.css?v=1.0.0">
<div class="flex">
<figure class="image"><img 
src="image/rogo.jpg">
</figure>
<h1>購入完了</h1>
<div class="nav">
    
    <!-- ハンバーガーメニューの表示・非表示を切り替えるチェックボックス -->
    <input id="drawer_input" class="drawer_hidden" type="checkbox">

    <!-- ハンバーガーアイコン -->
    <label for="drawer_input" class="drawer_open"><span></span></label>

    <!-- メニュー -->
    <nav class="nav_content">
      <ul class="nav_list">
        <li class="nav_item"><a href="mypage.php" id="b">マイページへ</a></li>
        <li class="nav_item"><a href="favorite-show.php" id="b">お気に入りへ</a></li>
        <li class="nav_item"><a href="shohin_top.php" id="b">商品トップへ</a></li>
        <li class="nav_item"><a href="cart-show.php" id="b">カート</a></li>
        <li class="nav_item"><a href="logout_input.php" id="b">ログアウト</a></li>
      </ul>
    </nav>

  </div>
</div>
<?php require 'header.php'; ?>
<?php require 'db-connect.php'; ?>
<div id="a">

<?php
$id=$_POST['id'];
$pdo = new PDO($connect,USER,PASS);
$sql = $pdo->prepare('select * from customer where user_name=?');
$sql->execute([$_SESSION['customer']['name']]);
foreach($sql as $row){
    
    echo '<p class="log">','購入が完了しました<br>';
    echo '発送準備が出来次第、';
    echo $row['user_address'];
    echo '<br>';
    echo 'にお届けします<br>';
    
}
$sqlvalue = $pdo->prepare('replace into Ranking values(?,?,?,?)');
$id_sql = $pdo->query('select shohin_id from Ranking');
$countsql = $pdo->prepare('select count from Ranking where shohin_id=?');
$countOk=0;
foreach($_SESSION['ranking'] as $id=>$ranking){
    
    foreach($id_sql as $ids){
        if($id==$ids['shohin_id']){
        $countsql->execute([$id]);
        foreach($countsql as $countrank){
        $total=$countrank['count']+$ranking['count'];
        $sqlvalue->execute([$id,$ranking['name'],$total,$ranking['colar']]);
        $total=0;
        }
        $countOk=1;
        } 
    }
    if($countOk==0){
        $sqlvalue->execute([$id,$ranking['name'],$ranking['count'],$ranking['colar']]);//ランキング
    }
    $countOk=0;
}
$s = $pdo->prepare('insert into purchase values(null,?)');
$s->execute([$_SESSION['customer']['id']]);
$id=$pdo->lastInsertId();

$sql = $pdo->prepare('insert into purchase_history values(?,?,?,?,?,?,?,?,?)');
foreach($_SESSION['purchase_history'] as $hisid=>$history){
$sql->execute([$id,$hisid,$history['customer_id'],$history['name'],$history['price'],$history['shohin_picture'],$history['count'],$history['size'],$history['day']]);
}
unset($_SESSION['purchase_history']);
unset($_SESSION['ranking']);
unset($_SESSION['product']);

?>
</p>
</div>
<p><a href="shohin_top.php"><button>商品一覧へ戻る</button></a></p>
<?php require 'footer.php'; ?>