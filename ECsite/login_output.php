<?php session_start(); ?>
<?php require 'header.php'; ?>
<?php require 'db-connect.php'; ?>
<?php 
unset($_SESSION['customer']);
$pdo = new PDO($connect,USER,PASS);
$sql = $pdo->prepare('select * from customer where user_name=?');
$sql->execute([$_POST['login']]);
foreach($sql as $row){
    if($_POST["password"]==$row['password']){
    $_SESSION['customer']=[
        'id'=>$row['id'],'name'=>$row['user_name'],
        'password'=>$row['password'],'address'=>$row['mail_address'],
        'useraddress'=>$row['user_address'],
    ];
    }
}
if(isset($_SESSION['customer'])){
    echo 'いらっしゃいませ、',$_SESSION['customer']['name'],'さん。';
   echo '<a href="index.php" id="my">マイページへ</a>';

}else{
    echo 'ログイン名またはパスワードが違います。';
    echo '<a href="index.php" id="my">マイページへ</a>';
}
?>
<?php require 'footer.php'; ?>