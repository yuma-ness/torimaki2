<?php session_start(); ?>
<?php require 'header.php'; ?>
<link rel="stylesheet" href="css/logout-output.css">
<div id='back'>
    <h1>ログアウト</h1>
    <div class="i">
    <img src ="image/rogo.jpg">
</div>
</div>
<div id='a'>
<?php
if(isset($_SESSION['customer'])){
    unset($_SESSION['customer']);
    echo '<p class="log">ログアウトしました。</p>';
}else{
    echo '<p class="log">既にログアウトしています。</p>';
}
?>

</div>
    <a href="login_inout.php" id="my"><button>ログインへ戻る</button></a>
<?php require 'footer.php'; ?>