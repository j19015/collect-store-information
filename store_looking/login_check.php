<?php
  session_start();
  require 'dbconnect.php';

  //idが存在してログインから60分が経過していなかったら
  if(isset($_SESSION['user_address']) && $_SESSION['time'] + 3600 > time()){
    //ログインしている
    //現在の時刻をセッションに格納する（ここからさらに60分ログインが継続する）
    $_SESSION['time'] = time();
    if($_SESSION['kind']=="person"){
        $admin = $pdo->prepare('SELECT * FROM user WHERE user_address=?');
        $admin->execute(array($_SESSION['user_address']));
        $admin = $admin->fetch();
    }
    else{
        $admin = $pdo->prepare('SELECT * FROM store WHERE store_id=?');
        $admin->execute(array($_SESSION['user_address']));
        $admin = $admin->fetch();
    }
  }else{
    //ログインしていない
    if($check){
        $store_id=$_REQUEST['store_id'];
        header("Location: login.php?store_id=$store_id");
        exit();
    }
    else{
        header('Location: login.php');
        exit();
    }
  }
?>
