<?php
    $check=true;
    require 'login_check.php';
    require 'dbconnect.php';
    
    $sql=$pdo->prepare("SELECT * FROM store where store_id=:store_id and store_user_password=:store_user_password");
    $sql->bindParam(':store_id',$store_id,PDO::PARAM_STR);
    $sql->bindParam(':store_user_password',$store_user_password,PDO::PARAM_STR);
    $store_id=$_POST['store_id'];
    $store_user_password=$_POST['password'];
    $sql->execute();
    $check=$sql->fetch();
    if($check){
    
        $sql=$pdo->prepare("INSERT INTO user_report (user_address, store_id) VALUES (:user_address,:store_id)");
        $sql->bindParam(':user_address',$user_id, PDO::PARAM_STR);
        $sql->bindParam(':store_id',$store_id,PDO::PARAM_STR);
        $user_id=$_SESSION['user_address'];
        $store_id=$_POST['store_id'];
        $sql->execute();
    }
    else{
        header("Location: qr_reading.php?store_id=$store_id");
        exit();
    }
    
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>ストア情報をインポート完了</title>
</head>

<body>
    <h1>処理が完了いたしました</h1>
    <h2><a href="top.php">トップページへ</a>
</body>
</html>