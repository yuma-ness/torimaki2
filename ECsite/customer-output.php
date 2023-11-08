<?php session_start();?>
<link rel="stylesheet" href="css/customer_output.css">
<div class="flex">
<figure class="image"><img 
src="image/rogo.jpg">
</figure>
<h1>新規登録<h1>
</div>
<div id='a'>
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
<<<<<<< HEAD
=======
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
            echo '<p class="log">お客様情報を更新しました。</p>';
    }else{
            echo 'お客様情報を更新しました。';
            */
>>>>>>> ba1dd8719981d333a851ea868709a1141d6f4676
            $sql=$pdo->prepare('insert into customer values(null,?,?,?,?,?)');
            $sql->execute([
                $_REQUEST['name'],$_REQUEST['password'],
                $_REQUEST['address'],$_REQUEST['useraddress'],$_REQUEST['post']
            ]);
                echo'<p class="log">お客様情報を登録しました。</p>';
            }
        
        }else{
            echo'<p class="log">ログイン名が既に使用されていますので、<br>変更してください。</p>';
        }
                echo'お客様情報を登録しました。';
    }else{
        echo'ログイン名が既に使用されていますので、変更してください。';
    }
    }else{
        echo'メールアドレスが既に使用されていますので、変更してください。';
    }
            ?>
            </div>
            <a href="login_input.php" id="my"><button>ログインへ戻る</button></a>
            