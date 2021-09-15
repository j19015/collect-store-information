<?php
    //var_dump($_REQUEST);
    error_reporting(0);
    require 'dbconnect.php';
    session_start();
    if($_REQUEST['kind']=="person"){
        $sql=$pdo->prepare("INSERT INTO user (user_address, user_name,user_password) VALUES (:user_address,:user_name,:user_password)");
        $sql->bindParam(':user_name',$user_name, PDO::PARAM_STR);
        $sql->bindParam(':user_address',$user_address,PDO::PARAM_STR);
        $sql->bindParam(':user_password',$user_password,PDO::PARAM_STR);
        $user_name=$_REQUEST['user_name'];
        $user_address=$_REQUEST['user_address'];
        $user_password=$_REQUEST['user_password'];
        $sql->execute();
    }
    else{
        $fileName1 = $_FILES['cover']['name'];
        if(!empty($fileName1)){
        //substr = 文字列から一部を切り取る（-3は後ろから3文字）
            $ext = substr($fileName1, -3);
            if($ext != 'jpg' && $ext != 'png'){
                $error['cover'] = 'type1';
            }
        }
        if($_REQUEST['store_id']==null)$error['post']=blank;
        if($_REQUEST['store_name']==null)$error['post']=blank;
        if($_REQUEST['store_password']==null)$error['post']=blank;
        if($_REQUEST['store_address']==null)$error['post']=blank;
        if($_REQUEST['store_mail_address']==null)$error['post']=blank;
        if($_REQUEST['store_comment']==null)$error['post']=blank;
        if($_REQUEST['store_user_password']==null)$error['post']=blank;
        
        if(empty($error)){
            $cover = $_FILES['cover']['name'];
      		move_uploaded_file($_FILES['cover']['tmp_name'], '../cover/'.$cover);
      		$sql=$pdo->prepare("INSERT INTO store (store_id,store_name,store_password,store_mail_address,store_address,store_comment,store_user_password,store_image) 
            VALUES (:store_id,:store_name,:store_password,:store_mail_address,:store_address,:store_comment,:store_user_password,:cover)");
            
            $sql->bindParam(':store_id',$store_id, PDO::PARAM_STR);
            $sql->bindParam(':store_name',$store_name,PDO::PARAM_STR);
            $sql->bindParam(':store_password',$store_password,PDO::PARAM_STR);
            $sql->bindParam(':store_address',$store_address,PDO::PARAM_STR);
            $sql->bindParam(':store_mail_address',$store_mail_address,PDO::PARAM_STR);
            $sql->bindParam(':store_comment',$store_comment,PDO::PARAM_STR);
            $sql->bindParam(':store_user_password',$store_user_password,PDO::PARAM_STR);
            $sql->bindParam(':cover',$cover,PDO::PARAM_STR);
            
            $store_id=$_REQUEST['store_id'];
            $store_name=$_REQUEST['store_name'];
            $store_password=$_REQUEST['store_password'];
            $store_address=$_REQUEST['store_address'];
            $store_mail_address=$_REQUEST['store_mail_address'];
            $store_comment=$_REQUEST['store_comment'];
            $store_user_password=$_REQUEST['store_user_password'];
            $sql->execute();
        }
        
        else{
            $_SESSION['error']="blank";
            header("Location: new_password.php");
            exit();
        }
    }
?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="destyle.css">
        <link rel="stylesheet" href="stylesheet.css">
        <link href="https://fonts.googleapis.com/earlyaccess/hannari.css" rel="stylesheet">
        <title>情報交換ページ</title>
    </title>

    <body>
        <?php require 'header.php'; ?>
        
        
        <div class="main board2" style="padding-top:10% ;padding-bottom:10px">
            <div class="waku" style="padding-left:7%">
                <div class="cp_iptxt" style="margin-left:3%">
                    <h1 style="text-align:center">パスワード登録完了</h1>
                    <h2 style="margin-top:6%;margin-left:15%">下記ボタンよりTOPページに戻りログインをお願いします</h2>
                    <a style="margin-left:35%;margin-top:10%" href="top.php" class="btn btn--orange">TOPページへ</a>
                </div>
            </div>
        </div>
    
        <?php require 'footer.php'; ?>
    </body>
</html>