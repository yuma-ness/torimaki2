<?php session_start(); ?>
<?php require 'header.php'; ?>
<?php require 'db-connect.php'; ?>
<?php 
unset($_SESSION['customer']);
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
if(isset($_SESSION['customer'])){
    echo 'いらっしゃいませ、',$_SESSION['customer']['name'],'さん。';
   echo '<a href="shohin_top.php" id="my">商品一覧へ</a>';

}else{
    echo 'ログイン名またはパスワードが違います。';
    echo '<a href="index.php" id="my">マイページへ</a>';
}
}else{
    echo 'ログイン名またはパスワードを入力してください。';
    echo '<a href="index.php" id="my">マイページへ</a>';
}
?>
<?php require 'footer.php'; ?>