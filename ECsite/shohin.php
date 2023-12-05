<?php require 'header.php'; ?>
<link rel="stylesheet" href="css/shohin.css">
<?php require 'db-connect.php'; ?>
<div class="flex">
    <figure class="image">
    <img src ="image/rogo.jpg">
    </figure>
    <div id="fm">
    <form action="shohin.php" method="post">
    <input type="text" name="kensaku" size="70" ><input type="submit" value="検索" size="35" >
    </form>
    </div>
<div id="div">   
        <a href="mypage.php" id="hi">マイページへ</a>
        <br>
        <a href="favorite-show.php" id="favo">お気に入りへ</a>
        <br>
        <a href="shohin_top.php" id="ab">商品トップへ</a>
        <br>
        <a href="logout_input.php">ログアウト</a>
        <br>
        <a href="cart-show.php">カート</a>
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
<div id="cart">
<a href="cart-show.php">カート</a>
</div>
<?php require 'footer.php'; ?> 