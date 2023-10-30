<?php session_start(); ?>
<?php require 'header.php'; ?>
<?php require 'db-connect.php'; ?>
購入が完了しました<br>
発送準備が出来次第お届けします<br>
<?php
$id=$_POST['id'];
$pdo = new PDO($connect,USER,PASS);
$sql = $pdo->prepare('select * from customer where user_name=?');
$sql->execute(['masa']);
foreach($sql as $row){
    echo $row['user_address'];
}

$sqlvalue = $pdo->prepare('replace into Ranking values(?,?,?)');
$id_sql = $pdo->query('select id from Ranking');
$countsql = $pdo->prepare('select count from Ranking where id=?');
$countOk=0;
foreach($_SESSION['ranking'] as $id=>$ranking){
    
    foreach($id_sql as $ids){
        if($id==$ids['id']){
        $countsql->execute([$id]);
        foreach($countsql as $countrank){
        $total=$countrank['count']+$ranking['count'];
        $sqlvalue->execute([$id,$ranking['name'],$total]);
        $total=0;
        }
        $countOk=1;
        } 
    }
    if($countOk==0){
        $sqlvalue->execute([$id,$ranking['name'],$ranking['count']]);
    }
    $countOk=0;
}



$sql = $pdo->prepare('replace into purchase_history values(?,?,?,?,?,?)');
$id_sql2 = $pdo->prepare('select shohin_id from purchase_history where customer_id=?');
$countsql2 = $pdo->prepare('select count from purchase_history where shohin_id=? and customer_id=?');
$hisOk=0;
foreach($_SESSION['purchase_history'] as $history_id=>$history){
    $id_sql2->execute([$history['customer_id']]);
    foreach($id_sql2 as $ids2){
        if($history_id==$ids2['shohin_id']){
        $countsql2->execute([$ids2['shohin_id'],$history['customer_id']]);
        foreach($countsql2 as $count2){
        $total2=$count2['count']+$history['count'];
        $sql->execute([$history_id,$history['customer_id'],$history['name'],$history['price'],$history['shohin_picture'],$total2]);
        $total2=0;
        }
        $hisOk=1;
        } 
    }
    if($hisOk==0){
        $sql->execute([$history_id,$history['customer_id'],$history['name'],$history['price'],$history['shohin_picture'],$history['count']]);
    }
    $hisOk=0;
    //$sql->execute([$history_id,$history['customer_id'],$history['name'],$history['price'],$history['shohin_picture'],$history['count']]);
}
unset($_SESSION['purchase_history']);
unset($_SESSION['ranking']);
?>
<p><a href="shohin_top.php">商品一覧へ戻る</a></p>
<?php require 'footer.php'; ?>