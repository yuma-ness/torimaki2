<?php session_start();?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<div class="flex">
<figure class="image"><img 
src="image/rogo.jpg">
</figure>
<h1>新規登録<h1>
</div>
<body>
    <?php
    $name=$password=$address=$useraddress='';
    if(isset($_SESSION['customer'])){
        $name=$_SESSION['customer']['name'];
        $password=$_SESSION['customer']['password'];
        $address=$_SESSION['customer']['address'];
        $useraddress=$_SESSION['customer']['useraddress'];
    }
    echo'<form action="customer-output.php" method="post">';
    echo '<table>';
    echo '<tr><td>お名前</td><td>';
    echo '<input type="text" name="name" value="',$name,'">';
    echo '</td></tr>';

    echo '<tr><td>パスワード</td><td>';
    echo '<input type="text" name="password" value="',$password,'">';
    echo '</td></tr>';

    echo'<tr><td>メールアドレス</td><td>';
    echo '<input type="text" name="address" value="',$address,'">';
    echo '</td></tr>';

    echo '<tr><td>住所</td><td>';
    echo '<input type="text" name="useraddress" value="',$useraddress,'">';
    echo '</td></tr></table>';

    echo '<input type="submit" value="確定">';
    echo '</form>';
    ?>
    </body>
</html>