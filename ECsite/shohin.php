<?php require 'header.php'; ?>
<link rel="stylesheet" href="css/shohin.css?v=1.0.0">
<?php require 'db-connect.php'; ?>
<div class="flex">
    <figure class="image">
    <img src ="image/rogo.jpg">
    </figure>
    <div id="fm">
    <form action="shohin.php" method="post">
    <input type="text" name="kensaku" placeholder="商品名を検索できます" size="70" ><input type="submit" value="検索" size="35" >
    </form>
    </div>
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
        <li class="nav_item"><a href="shohin_top.php" id="b">商品一覧</a></li>
        <li class="nav_item"><a href="cart-show.php" id="b">カート</a></li>
        <li class="nav_item"><a href="logout_input.php" id="b">ログアウト</a></li>
      </ul>
    </nav>

  </div>
</div>


<?php
$pdo = new PDO($connect,USER,PASS);


if(isset($_POST['kensaku'])){
    $sql = $pdo->prepare('select * from product where shohin_name like ?');
    $sql->execute(['%'.$_POST['kensaku'].'%']);
    $tr=0;
    echo '<table align="center">';
    echo '<tr>';
    foreach($sql as $row){
        echo '<td><img alt="image" src="image/',$row['id'],'.png"><br>';
        echo '<form action="cart-insert.php" method="post">';
        echo '商品名：',$row['shohin_name'],'<br>';
        echo 'カラー：',$row['exp'],'<br>';
        echo '価格：￥',$row['shohin_price'],'<br>';
        echo '<input type="hidden" name="id" value="',$row['id'],'">';
        echo '<input type="hidden" name="picture" value="image/',$row['id'],'.png">';
        echo '<input type="hidden" name="name" value="',$row['shohin_name'],'">';
        echo '<input type="hidden" name="exp" value="',$row['exp'],'">';
        echo '<input type="hidden" name="price" value="',$row['shohin_price'],'">';
        echo '<input type="submit" value="カートに追加" id="submit"></br>';
        echo '</form>';
        echo '<a href="favorite-insert.php?id=',$row['id'],'">お気に入りに追加</a></td>';
        $tr++;
        if($tr==3){
        echo '</tr>';
        $tr=0;
        echo '<tr>';
        }
    }
    echo '</table>';
}elseif(isset($_GET['category'])){
    $sql = $pdo->prepare('select * from product where shohin_category=?');
    $sql->execute([$_GET['category']]);
    $tr=0;
    echo '<table align="center">';
    echo '<tr>';
    foreach($sql as $row){
        echo '<td><img alt="image" src="image/',$row['id'],'.png"><br>';
        echo '<form action="cart-insert.php" method="post">';
        echo '商品名：',$row['shohin_name'],'<br>';
        echo 'カラー：',$row['exp'],'<br>';
        echo '価格：￥',$row['shohin_price'],'<br>';
        echo '<input type="hidden" name="id" value="',$row['id'],'">';
        echo '<input type="hidden" name="picture" value="image/',$row['id'],'.png">';
        echo '<input type="hidden" name="name" value="',$row['shohin_name'],'">';
        echo '<input type="hidden" name="exp" value="',$row['exp'],'">';
        echo '<input type="hidden" name="price" value="',$row['shohin_price'],'">';
        echo '<input type="submit" value="カートに追加" id="submit"><br>';
        echo '</form>';
        echo '<a href="favorite-insert.php?id=',$row['id'],'">お気に入りに追加</a></td>';
        $tr++;
        if($tr==3){
        echo '</tr>';
        $tr=0;
        echo '<tr>';
        }
    }
    echo '</table>';
}else{
$sql = $pdo->query('select * from product ');//一覧
$tr=0;
echo '<table align="center">';
echo '<tr>';
foreach($sql as $row){
    echo '<td><img alt="image" src="image/',$row['id'],'.png"><br>';
    echo '<form action="cart-insert.php" method="post">';
    echo '商品名：',$row['shohin_name'],'<br>';
    echo '価格：￥',$row['shohin_price'],'<br>';
    echo '<input type="hidden" name="id" value="',$row['id'],'">';
    echo '<input type="hidden" name="picture" value="image/',$row['id'],'.png">';
    echo '<input type="hidden" name="name" value="',$row['shohin_name'],'">';
    echo '<input type="hidden" name="exp" value="',$row['exp'],'">';
    echo '<input type="hidden" name="price" value="',$row['shohin_price'],'">';
    echo '<input type="submit" value="カートに追加" id="submit"><br>';
    echo '</form>';
    echo '<a href="favorite-insert.php?id=',$row['id'],'">お気に入りに追加</a></td>';
    $tr++;
        if($tr==3){
        echo '</tr>';
        $tr=0;
        echo '<tr>';
        }
}
echo '</table>';
}
?>

<?php require 'footer.php'; ?> 