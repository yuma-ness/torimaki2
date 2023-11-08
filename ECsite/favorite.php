<?php
if(isset($_SESSION['customer'])){
    echo '<table>';
    $pdo = new PDO($connect,USER,PASS);
    $sql=$pdo->prepare(
        'select * from favorite,product where customer_id=? and shohin_id=id'
    );
    $sql->execute([$_SESSION['customer']['id']]);
    foreach($sql as $row){
        $id=$row['id'];
        echo '<tr>';
        echo '<td><img alt="image" src="image/',$id,'.png"></td>';
        echo '<form action="cart-insert.php" method="post">';
        echo '<td>';
        echo '商品名：',$row['shohin_name'],'<br>';
        echo '価格：',$row['shohin_price'],'<br>';
        echo '<input type="hidden" name="id" value="',$row['id'],'">';
        echo '<input type="hidden" name="picture" value="image/',$row['id'],'.png">';
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
    echo 'お気に入りを表示するには、ログインしてください。';
}
?>