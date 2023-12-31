<?php require 'header.php'; ?>
<link rel="stylesheet" href="css/shohin_top.css?v=1.0.4">
<?php require 'db-connect.php'; ?>

<div class="flex">
    <figure class="image">
        <img src ="image/rogo.jpg">
    </figure>
    <div id="fm">
        <form action="shohin.php" method="post">
            <input type="text" placeholder="商品名を検索できます" name="kensaku" size="70" ><input type="submit" value="検索" size="35" >
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
            <li class="nav_item"><a href="history.php" id="b">注文履歴</a></li>
            <li class="nav_item"><a href="mypage.php" id="b">マイページへ</a></li>
            <li class="nav_item"><a href="favorite-show.php" id="b">お気に入りへ</a></li>
            <li class="nav_item"><a href="cart-show.php" id="b">カート</a></li>
            <li class="nav_item"><a href="logout_input.php" id="b">ログアウト</a></li>
          </ul>
        </nav>
   
      </div>
</div>
<div id="ranking">
    <h1>ランキング</h1>
<?php

$pdo = new PDO($connect,USER,PASS);
$jyuni=1;
$sqla = $pdo->query('select * from Ranking order by count desc');
echo '<table align="center">';
foreach($sqla as $a){
    if($jyuni<6){
    echo '<tr>';
    echo '<td>',$jyuni,'位：</td>';
    echo '<td><img alt="image" src="image/',$a["shohin_id"],'.png" id="rank"></td>';
    echo '<td>',$a['name'],'</td>';
    echo '<td>',$a['colar'],'</td>';                                  //echo '<td>　商品名：',$a['name'],'</td>';    //echo '<td>商品番号：',$a['id'],'</td>';
                                                            
    $jyuni++;
    echo '</tr>';
    }else{
        break;
    }
}
echo '</table>';
echo '</div>';
echo '<br>';
$tr=0;
echo '<h2>カテゴリから探す</h2>';
$sql2 = $pdo->query('select * from category');
echo '<div>';
echo '<table id="cate" align="center">';
echo '<tr>';
foreach($sql2 as $row){
    echo '<td id="cate"><a href="shohin.php?category=',$row['category'],'">';
    echo '<img src="image2/',$row['picture'],'.png" alt="image" width="200" height="240">';//カテゴリ画像表示⇒image2
    echo '</a><br>';
    echo '<a href="shohin.php?category=',$row['category'],'">',$row['category'],'</a>';
    echo '</td>';
    $tr++;
    if($tr==4){
    echo '</tr>';
    $tr=0;
    echo '<tr>';
    }
}

echo '</table>';
echo '</div>';
?>
<?php require 'footer.php'; ?> 