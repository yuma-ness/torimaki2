<?php session_start(); ?>
<?php require 'header.php'; ?>
<?php
if(isset($_SESSION['customer'])){
    unset($_SESSION['customer']);
    echo 'ログアウトしました。';
    echo '<a href="index.php" id="my">マイページへ</a>';
}else{
    echo '既にログアウトしています。';
    echo '<a href="index.php" id="my">マイページへ</a>';
}
?>
<?php require 'footer.php'; ?>