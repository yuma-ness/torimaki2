<link rel="stylesheet" href="css/favorite.css">
<?php
if(isset($_SESSION['customer'])){
    echo '<table>';
    $pdo = new PDO($connect,USER,PASS);
    $sql=$pdo->prepare(
        'select * from favorite,product where customer_id=? and shohin_id=id'
    );
    $sql->execute([$_SESSION['customer']['id']]);
    $sth=$pdo->prepare(
        'select * from favorite,product where customer_id=? and shohin_id=id'
    );
    $sth->execute([$_SESSION['customer']['id']]);
    $a=$sth->fetch(PDO::FETCH_COLUMN);
    if($a>0){
    foreach($sql as $row){
        $id=$row['id'];
        echo '<tr>';
        echo '<td><img alt="image" src="image/',$id,'.png"></td>';
        echo '<form action="cart-insert.php" method="post">';
        echo '<td>';
        echo '商品名：',$row['shohin_name'],'<br>';
        echo 'カラー：',$row['exp'],'<br>';
        echo '価格：',$row['shohin_price'],'<br>';
        echo '<input type="hidden" name="id" value="',$row['id'],'">';
        echo '<input type="hidden" name="picture" value="image/',$row['id'],'.png">';
        echo '<input type="hidden" name="exp" value="',$row['exp'],'">';
        echo '<input type="hidden" name="name" value="',$row['shohin_name'],'">';
        echo '<input type="hidden" name="price" value="',$row['shohin_price'],'">';
        echo '<input type="submit" value="カートに追加"><br>';
        echo '</form>';
        echo '</td>';
        echo '<td><a href=favorite-delete.php?id=',$id,'">削除</a></td>';
        echo '</tr>';
    }
    echo '</table>';
}else{
    echo 'お気に入りに商品がありません。';
}
    echo '<a href="shohin_top.php">商品一覧へ</a><br>';
    echo '<a href="mypage.php">マイページへ</a>';
}else{
    echo 'お気に入りを表示するには、ログインしてください。';
    echo '<a href="login_input.php">ログイン画面へ</a>';
}
?>