<?php require 'header.php'; ?>
<link rel="stylesheet" href="css/shohin_top.css?v=1.0.1">
<?php require 'db-connect.php'; ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.0/css/bulma.min.css">
<div class="flex">
    <figure class="image">
        <img src ="image/rogo.jpg">
    </figure>
    <div id="fm">
        <form action="shohin.php" method="post">
            <input type="text" name="kensaku" size="70" ><input type="submit" value="検索" size="35" >
        </form>
    </div>
    <div id="app">
        <nav class="navbar">
            <div class="navbar-brand">
                <div 
                :class="{'is-active': isActive}"
                class="navbar-burger"
                @click="toggleButton"
                >
                <span></span>
                <span></span>
                <span></span>
                </div>
            </div>
            <div id="menu" class="navbar-menu" :class="{'is-active': isActive}">
                <div class="navbar-start">
                    <a class="navbar-item">
                    <a href="mypage.php">マイページへ</a>
                    </a>
                    <a class="navbar-item">
                    <a href="favorite-show.php">お気に入りへ</a>
                    </a>
                    <a class="navbar-item">
                    <a href="cart-show.php">カート</a>
                    </a>
                    <a class="navbar-item">
                    <a href="logout_input.php">ログアウト</a>
                    </a>
                </div>
            </div>
        </nav>
    </div>
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="script/script.js"></script>


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