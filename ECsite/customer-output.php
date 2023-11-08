<?php session_start();?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/logout-output.css">
    <title>Document</title>
</head>
<div class="flex">
<figure class="image">
<img src ="image/rogo.jpg">
</figure>
    <h1>ログアウト</h1>
</div>
<body>
<?php require 'db-connect.php';?>
<div id='a'>
<?php
     $pdo=new PDO($connect,USER,PASS);
     if(isset($_SESSION['customer'])){
        $id=$_SESSION['customer']['id'];
        $sql=$pdo->prepare('select * from customer where id!=? and user_name=?');
        $sql->execute([$id,$_REQUEST['name']]);
     }else{
        $sql=$pdo->prepare('select * from customer where user_name=?');
        $sql->execute([$_REQUEST['name']]);
     }
     //mail
     if(isset($_SESSION['customer'])){
        $id2=$_SESSION['customer']['id'];
        $sql2=$pdo->prepare('select * from customer where id!=? and mail_address=?');
        $sql2->execute([$id2,$_REQUEST['address']]);
     }else{
        $sql2=$pdo->prepare('select * from customer where mail_address=?');
        $sql2->execute([$_REQUEST['address']]);
     }

     if(empty($sql2->fetchAll())){
     if(empty($sql->fetchAll())){
            $sql=$pdo->prepare('insert into customer values(null,?,?,?,?,?)');
            $sql->execute([
                $_REQUEST['name'],$_REQUEST['password'],
                $_REQUEST['address'],$_REQUEST['useraddress'],$_REQUEST['post']
            ]);
                echo'<p class="log">お客様情報を登録しました。</p>';
    }else{
        echo'<p class="log">ログイン名が既に使用されていますので、変更してください。</p>';
    }
    }else{
        echo'<p class="log">メールアドレスが既に使用されていますので、変更してください。</p>';
    }
?>
</div>
<a href="login_input.php" id="my"><button>ログインへ戻る</button></a>
</body>
</html>