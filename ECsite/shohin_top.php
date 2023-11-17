<?php require 'header.php'; ?>
<link rel="stylesheet" href="css/shohin_top.css">
<?php require 'db-connect.php'; ?>
<?php
if(isset($_POST['passward']) || isset($_POST['login'])){
    unset($_SESSION['customer']);
    unset($_SESSION['login']);
    unset($_SESSION['loginkaisu']);
    $_SESSION['login']=[
        'id'=>0
    ];
    $_SESSION['loginkaisu']=[
        'id'=>0
    ];
if($_POST['password'] != null && $_POST['login'] != null){
$pdo = new PDO($connect,USER,PASS);
$sql = $pdo->prepare('select * from customer where user_name=?');
$sql->execute([$_POST['login']]);
foreach($sql as $row){
    if($_POST["password"]==$row['password']){
    $_SESSION['customer']=[
        'id'=>$row['id'],'name'=>$row['user_name'],'post'=>$row['post'],
        'password'=>$row['password'],'address'=>$row['mail_address'],
        'useraddress'=>$row['user_address'],
    ];
    }
}
if(isset($_SESSION['customer']) && $_SESSION['loginkaisu']['id']==0){
    echo 'いらっしゃいませ、',$_SESSION['customer']['name'],'さん。';
    $_SESSION['login']=[
        'id'=>1
    ];
    $_SESSION['loginkaisu']=[
        'id'=>1
    ];
}else{
    echo 'ログイン名またはパスワードが違います。';
    echo '<a href="index.php" id="my">マイページへ</a>';
}
}else{
    echo 'ログイン名またはパスワードを入力してください。';
    echo '<a href="index.php" id="my">マイページへ</a>';
}
}
if($_SESSION['login']['id']==1){
?>    
<div id="back">
    <div id="link">
    <a href="mypage.php" id="my">マイページへ</a>
    <br>
    <a href="favorite-show.php" id="favo">お気に入りへ</a>
    </div>
    <form action="shohin.php" method="post">
    <div id="kensaku">
    <input type="text" name="kensaku" size="70" ><input type="submit" value="検索" size="35" >
    </div>
    </form>
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
    echo '<td><img alt="image" src="image/',$a["id"],'.png" id="rank"></td>';
    echo '<td>',$a['name'],'</td>';                                  //echo '<td>　商品名：',$a['name'],'</td>';    //echo '<td>商品番号：',$a['id'],'</td>';
                                                            
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
    echo '<img src="image2/',$row['picture'],'.png" alt="image">';//カテゴリ画像表示⇒image2
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
<div id="cart">
<a href="cart-show.php">カート</a>
<?php
}
?>
</div>
<?php require 'footer.php'; ?> 