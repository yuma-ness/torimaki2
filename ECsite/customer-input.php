<?php session_start(); ?>
<?php require 'header.php'; ?>
<?php require 'menu.php'; ?>
<link rel="stylesheet" href="css/customer_input.css">
<div id="back"><img id="img" src="image/rogo.jpg" width=170 heigth=170><h1>新規登録<h1></div>
<div style="text-align:center">
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
    echo'<input type="text" align="center" name="name" value="',$name,'">','<br>';
    echo'</td></tr>';
    echo'<tr><td>メールアドレス</td><td>';
    echo'<p>','<input type="text" name="address" value="',$address,'">','<br>';
    echo'</td></tr>';
    echo'<tr><td>パスワード</td><td>';
    echo'<p>','<input type="text" name="login" value="',$login,'">','<br>';
    echo'</td></tr>';
    echo'<tr><td>パスワード確認</td><td>';
    echo'<p>','<input type="text" name="password" value="',$password,'">','<br>';
    echo'</td></tr>';
    echo'</table>';
    echo'<input type="submit" value="登録">';
    echo'</form>';
    ?>
    </div>
<?php require 'footer.php'; ?>