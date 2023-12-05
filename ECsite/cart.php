
<?php
if(!empty($_SESSION['product'])){
    $i=1;
    $size=0;
    echo '<form action="kounyu.php" method="post">';
    echo '<table align="center">';
//  echo '<tr><th></th><th>商品名</th><th>価格</th><th>サイズ</th><th>個数</th></tr>';
    foreach($_SESSION['product'] as $id=>$product){
        if($i==1){
        $size=$id+10;
        $i++;
        }
        echo '<tr id="a">';
        echo '<td><img alt="image" src="', $product['picture'] ,'"></td>';
       
       
        echo '<td id="name">',$product['name'],'<br>';//エラーでてる 12/05
        echo '<br>',$product['exp'];
        
        echo '<select name="',$size,'">';
        echo '<option value="S" selected>S</option>';
        echo '<option value="M">M</option>';
        echo '<option value="L">L</option>';
        echo '</select>';
        

        echo '<select name="',$id,'">';
        echo '<option value="1" selected>1</option>';
        echo '<option value="2">2</option>';
        echo '<option value="3">3</option>';
        echo '<option value="4">4</option>';
        echo '<option value="5">5</option>';
        echo '</select>',"￥",number_format($product['price']),"税込",'</td>';
        
        echo '<td><a href="cart-delete.php?id=',$id,'">削除</a></td>';
        echo '</tr><br>';
        $size++;
    }
    echo '</table>';
    echo '<p><input type="submit" value="購入確認画面へ"></p>';
    echo '</form>';
    echo '<p><a href="shohin_top.php"><button>商品一覧へ</button></a></p>';
}else{
    echo '<p>カートに商品がありません<br></p>';
    echo '<p><a href="shohin_top.php"><button>商品一覧へ</button></a></p>';
}
?>