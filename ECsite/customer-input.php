<?php session_start(); ?>
<link rel="stylesheet" href="css/customer_input.css?v=1.0.0">
<div class="flex">
<figure class="image"><img 
src="image/rogo.jpg">
</figure>
<h1>新規登録<h1>
    <!-- <div id="div">   
        <a href="mypage.php" id="hi">マイページへ</a>
        <br>
        <a href="favorite-show.php" id="favo">お気に入りへ</a>
        <br>
        <a href="shohin_top.php" id="ab">商品トップへ</a>
        <br>
        <a href="logout_input.php">ログアウト</a>
        <br>
        <a href="cart-show.php">カート</a>
    </div> -->
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
    echo'<p>','<input type="text" placeholder="必須項目です" align="center" name="name" value="',$name,'"required>','</p>';
    echo'</td></tr>';
    echo'<tr><td>メールアドレス</td><td>';
    echo'<p>','<input type="text" placeholder="必須項目です"  name="address" value="',$address,'"required>','</p>';
    echo'</td></tr>';
    echo'<tr><td>パスワード</td><td>';
    echo'<p>','<input type="password" placeholder="必須項目です"  name="password" value="',$password,'"required>','</p>';
    echo'</td></tr>';
    echo'<tr><td>郵便番号</td><td>';
    echo'<p>','<input type="text" placeholder="必須項目です"  name="post" value="',$post,'"required>','</p>';
    echo'</td></tr>';
    echo'<tr><td>住所</td><td>';
    echo'<p>','<input type="text" placeholder="必須項目です"  name="useraddress" value="',$useraddress,'"required>','</p>';
    echo'</td></tr>';
    echo '</table>';

    echo '<table align="center">';
    echo'<tr><td>';
    echo'<p align="center">','<input type="submit" value="登録">','</p>';
    echo'</form>';
    echo'</td></tr>';
    echo'<tr><td>';
    echo '<a href="login_input.php">ログイン画面へ戻る</a>';
    echo'</td></tr>';
    ?>
    </table>
    </div>
<?php require 'footer.php'; ?>