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
$name=$address=$login=$password='';
if (isset($_SESSION['customer'])){
    $name=$_SESSION['customer']['name'];
    $address=$_SESSION['customer']['address'];
    $login=$_SESSION['customer']['login'];
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
    echo'<p>','<input type="text" name="login" value="',$login,'">','</p>';
    echo'</td></tr>';
    echo'<tr><td>パスワード確認</td><td>';
    echo'<p>','<input type="text" name="password" value="',$password,'">','</p>';
    echo'</td></tr>';
    echo'</table>';
    echo'<p align="center">','<input type="submit" value="登録">','</p>';
    echo'</form>';
    ?>
    </div>
<?php require 'footer.php'; ?>