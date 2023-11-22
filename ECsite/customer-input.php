<?php session_start(); ?>
<link rel="stylesheet" href="css/customer_input.css">
<div class="flex">
<figure class="image"><img 
src="image/rogo.jpg">
</figure>
<h1>新規登録<h1>
</div>
<div id="back">
<?php
$name=$address=$post=$useraddress=$password='';
if (isset($_SESSION['customer'])){
    $name=$_SESSION['customer']['name'];
    $post=$_SESSION['customer']['post'];
    $address=$_SESSION['customer']['address'];
    $useraddress=$_SESSION['customer']['useraddress'];
    $password=$_SESSION['customer']['password'];
}
    echo'<form action="customer-output.php" method="post">';
    echo'<table align="center">';
    echo'<tr><td>ユーザー名</td><td>';
    echo'<p>','<input type="text" align="center" name="name" value="',$name,'">','</p>';
    echo'</td></tr>';
    echo'<tr><td>メールアドレス</td><td>';
    echo'<p>','<input type="text" name="address" value="',$address,'">','</p>';
    echo'</td></tr>';
    echo'<tr><td>パスワード</td><td>';
    echo'<p>','<input type="text" name="password" value="',$password,'">','</p>';
    echo'</td></tr>';
    echo'<tr><td>郵便番号</td><td>';
    echo'<p>','<input type="text" name="post" value="',$post,'">','</p>';
    echo'</td></tr>';
    echo'<tr><td>住所</td><td>';
    echo'<p>','<input type="text" name="useraddress" value="',$useraddress,'">','</p>';
    echo'</td></tr>';
    echo'</table>';
    echo'<p align="center">','<input type="submit" value="登録">','</p>';
    echo'</form>';

    echo '<a href="login_input.php"><button>ログイン画面へ戻る</button></a>';
    ?>
    </div>
<?php require 'footer.php'; ?>