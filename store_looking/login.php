<?php
    error_reporting(0);
    //var_dump($_POST);
    require 'dbconnect.php';
    session_start();
    if($_POST){
        if($_POST['kind']=="person"){
            //echo "こっち1";
            if($_POST['user_address'] != '' && $_POST['user_password'] != ''){
                $login = $pdo->prepare('SELECT * FROM user WHERE user_address=? AND user_password=?');
                $login->execute(array(
                $_POST['user_address'],
                $_POST['user_password']
              ));
              //レコードを取り出して変数（$admin）に格納する
              $admin = $login->fetch();
        
              //入力された内容が$adminと同じだったら
              if($admin){
                //ログイン成功
                //idと現在の時刻をセッションに格納する
                //index.phpに移動する
                //移動後は以降のプログラムが実行されないようにする
                $_SESSION['user_address'] = $admin['user_address'];
                $_SESSION['kind']=$_POST['kind'];
                $_SESSION['time'] = time();
                if($_REQUEST['store_id']){
                    $store_id=$_REQUEST['store_id'];
                    header("Location: qr_reading.php?store_id=$store_id");
                    exit();
                }
                else{
                    header('Location: top.php');
                    exit();
                }
              }else{
                //ログイン失敗
                //$error['login']に'failed'という文字を代入する
                $error['login'] = 'failed';
              }
            }
            else{
              //ユーザIDかパスワードが空欄だったら
              //$error['login']に'blank'という文字を代入する
              $error['login'] = 'blank';
            }
            //var_dump($admin);
        }
        else{
            //echo "こっち";
            if($_POST['user_address'] != '' && $_POST['user_password'] != ''){
                $login = $pdo->prepare('SELECT * FROM store WHERE store_id=? AND store_password=?');
                $login->execute(array(
                $_POST['user_address'],
                $_POST['user_password']
              ));
              //レコードを取り出して変数（$admin）に格納する
              $admin = $login->fetch();
        
              //入力された内容が$adminと同じだったら
              if($admin){
                //ログイン成功
                //idと現在の時刻をセッションに格納する
                //index.phpに移動する
                //移動後は以降のプログラムが実行されないようにする
                $_SESSION['user_address'] = $admin['store_id'];
                $_SESSION['kind']=$_POST['kind'];
                $_SESSION['time'] = time();
                header('Location: top.php');
                exit();
              }else{
                //ログイン失敗
                //$error['login']に'failed'という文字を代入する
                $error['login'] = 'failed';
              }
            }
            else{
              //ユーザIDかパスワードが空欄だったら
              //$error['login']に'blank'という文字を代入する
              $error['login'] = 'blank';
            }
            //var_dump($admin);
        }
    }
    if($error['login']){
      $alert = "<script type='text/javascript'>alert('アカウントIDもしくはパスワードが間違っています。');</script>";
      echo $alert;
    }
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="destyle.css">
    <link rel="stylesheet" href="stylesheet.css">
    <link href="https://fonts.googleapis.com/earlyaccess/hannari.css" rel="stylesheet">
    <title>ログインページ</title>
</head>

<body>
    <?php require 'header.php'; ?>
    <div class="main board2" style="padding-top:10% ;padding-bottom:10px">
      <div class="waku" style="padding-left:7%">
        <div class="cp_iptxt" >
          <form action="" method="post">
              <h1 style="text-align:center">ログイン</h1>
              <h2 style="margin-top:10%;margin-left:42%">アカウントID</h2>
              <input style="margin-top:4%;color:black"type="text" name="user_address" class="rightgreen " placeholder="アカウントのID,メールアドレスを入力してください"><br>
              <h2 style="margin-top:4%;margin-left:42%">パスワード</h2>
              <input style="margin-top:4%;color:black" type="text" name="user_password" class="rightgreen" placeholder="アカウントのパスワードを入力してください"><br>
              <h2 style="margin-top:4%;margin-left:39%">アカウントの種類</h2>
              <select style="margin-top:4%;margin-left:35% ;width:36%; color:black" name="kind" class="rightgreen"><br>
                  <option value="person" class="rightgreen">アカウントの種類を選択</option>
                  <option value="shop" class="rightgreen">店舗アカウント</option>
                  <option value="person" class="rightgreen">個人アカウント</option>
              </select><br>
              <input style="margin:10% 38%" value="ログイン" type="submit" name="login" class="rightgreen btn btn--orange"><br>
          </form>
        </div>
      </div>
    </div>

    <?php require 'footer.php'; ?>
</body>