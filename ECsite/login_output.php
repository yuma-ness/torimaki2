<?php session_start(); ?>
<?php require 'header.php'; ?>
<?php require 'db-connect.php'; ?>
<link rel="stylesheet" href="css/login_output.css?v=1.0.2">
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
$sql = $pdo->prepare('select * from customer where mail_address=?');//user_name ユーザー名をメアドに変更
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
   echo '<a href="shohin_top.php" id="my"><button>商品一覧へ</button></a>';

}else{
    echo '<p class="log">ログイン名またはパスワードが違います。</p>';
    echo '<a href="login_input.php" id="my"><button>ログイン画面へ</button></a>';
}
}else{
    echo '<p class="log">ログイン名またはパスワードを入力してください。</p>';
    echo '<a href="login_input.php" id="my"><button>ログイン画面へ</button></a>';
}
?>
<?php require 'footer.php'; ?>