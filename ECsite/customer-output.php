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
     }
     else{
        $sql=$pdo->prepare('select * from customer where user_name=?');
        $sql->execute([$_REQUEST['name']]);
     }
     if(empty($sql->fetchAll())){
        if(isset($_SESSION['customer'])){
            $sql=$pdo->prepare('update customer set user_name=?, password=?,mail_address=?,user_address=? where id=?');
            $sql->execute([
                $_REQUEST['name'],$_REQUEST['password'],
                $_REQUEST['address'],$_REQUEST['useraddress'],$id
            ]);
            $_SESSION['customer']=[
                'id'=>$id,'user_name'=>$_REQUEST['name'],
                'password'=>$_REQUEST['password'],'mail_address'=>$_REQUEST['address'],
                'user_address'=>$_REQUEST['useraddress']
            ];
            echo 'お客様情報を更新しました。';
    }else{
            $sql=$pdo->prepare('insert into customer values(null,?,?,?,?)');
            $sql->execute([
                $_REQUEST['name'],$_REQUEST['password'],
                $_REQUEST['address'],$_REQUEST['useraddress']
            ]);
                echo'お客様情報を登録しました。';
            }
        
        }else{
            echo'ログイン名が既に使用されていますので、変更してください。';
        }
            ?>
            </body>
</html>