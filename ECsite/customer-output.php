<?php session_start();?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php require 'db-connect.php';?>
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
            /*$sql=$pdo->prepare('update customer set user_name=?, password=?,mail_address=?,user_address=?,post=? where id=?');
            $sql->execute([
                $_REQUEST['name'],$_REQUEST['password'],
                $_REQUEST['address'],$_REQUEST['useraddress'],$_REQUEST['post'],$id
            ]);
            $_SESSION['customer']=[
                'id'=>$id,'name'=>$_REQUEST['name'],
                'password'=>$_REQUEST['password'],'address'=>$_REQUEST['address'],
                'useraddress'=>$_REQUEST['useraddress'],'post'=>$_REQUEST['post']
            ];
            echo 'お客様情報を更新しました。';
            */
            $sql=$pdo->prepare('insert into customer values(null,?,?,?,?,?)');
            $sql->execute([
                $_REQUEST['name'],$_REQUEST['password'],
                $_REQUEST['address'],$_REQUEST['useraddress'],$_REQUEST['post']
            ]);
                echo'お客様情報を登録しました。';
    }else{
        echo'ログイン名が既に使用されていますので、変更してください。';
    }
    }else{
        echo'メールアドレスが既に使用されていますので、変更してください。';
    }
            ?>
            </body>
</html>