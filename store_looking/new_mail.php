<?php
    //var_dump($_POST);
    error_reporting(0);
    session_start();
    require 'dbconnect.php';
    $results=null;
    $id=$_POST['e-mail'];
    $kind=$_POST['kind'];
    $sql="select * from user where user_address=:user_address";
    $stmt=$pdo->prepare($sql);
    $stmt->bindParam(':user_address',$_POST['e-mail'], PDO::PARAM_STR);
    $stmt->execute();
    $results=$stmt->fetchall();
    if($kind=="person"){
        if($id!=""&&count($results)!=1){
            require 'send_test.php';
        }
        else if(count($results)>0){
            $_SESSION['error']="already";
            header('Location: new_submit.php');
        }
        else{
            $_SESSION['error']="new";
            header('Location: new_submit.php');
        }
    }
    else if($kind=="shop"){
        require 'send_test.php';
    }
?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="destyle.css">
        <link rel="stylesheet" href="stylesheet.css">
        <link href="https://fonts.googleapis.com/earlyaccess/hannari.css" rel="stylesheet">
    </head>

    <body>
       <?php require 'header.php'; ?>
        <div class="main board2" style="padding-top:10% ;padding-bottom:10px">
            <div class="waku" style="padding-left:7%">
                <div class="cp_iptxt"style="margin-left:3%">
                    <h1 style="text-align:center;">送信が完了しました</h1>
                    <h2 style="text-align:center;margin-top:10%">一定時間たってもメールが送られてこない場合は</h2>
                    <h2 style="text-align:center;margin-top:3%">前のページへ戻り再度送信してください</h2>
                    <div style="margin-left:14%">
                        <a href="new_submit.php" class="btn btn--orange"style="margin-top:10%">新規登録画面へ</a>
                        <a href="top.php" class="btn btn--orange"style="margin-top:10%">トップページへ戻る</a>
                    </div>
                </div>
            </div>
        </div>

        <?php require 'footer.php'; ?>
</body>

</html>