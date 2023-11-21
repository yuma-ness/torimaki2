<?php session_start(); ?>
<?php require 'header.php'; ?>
<?php require 'db-connect.php'; ?>
<link rel="stylesheet" href="css/login-output.css">
<div class="flex">
<figure class="image"><img 
src="image/rogo.jpg">
</figure>
<h1>ログイン<h1>
</div>
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
    echo '<p class="log">いらっしゃいませ、',$_SESSION['customer']['name'],'さん。</p>';
   echo '<a href="shohin_top.php" id="my">商品一覧へ</a>';

}else{
    echo '<p class="log">ログイン名またはパスワードが違います。</p>';
    echo '<a href="login_input.php" id="my">ログイン画面へ</a>';
}
}else{
    echo '<p class="log">ログイン名またはパスワードを入力してください。</p>';
    echo '<a href="login_input.php" id="my">ログイン画面へ</a>';
}
?>
<?php require 'footer.php'; ?>