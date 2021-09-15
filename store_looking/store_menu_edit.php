<?php
    require 'dbconnect.php';
    require 'login_check.php';
    error_reporting(0);
    if($_POST){
        if($_POST['submit']&&$_POST['menu_name']!=""&&$_POST['menu_comment']!=""){
            $sql=$pdo->prepare("INSERT INTO store_infomation (store_id,cook_name,cook_comment) 
            VALUES (:store_id,:cook_name,:cook_comment)");
            $sql->bindParam(':store_id',$store_id, PDO::PARAM_STR);
            $sql->bindParam(':cook_name',$cook_name,PDO::PARAM_STR);
            $sql->bindParam(':cook_comment',$cook_comment,PDO::PARAM_STR);
            $cook_name=$_REQUEST['menu_name'];
            $cook_comment=$_REQUEST['menu_comment'];
            $store_id=$_SESSION['user_address'];
            $sql->execute();
        }
        else if($_POST['delete']&&$_POST['menu_name']!=""){
            $sql=$pdo->prepare("DELETE from store_infomation where store_id=:store_id and cook_name=:cook_name");
            $sql->bindParam(':store_id',$store_id,PDO::PARAM_STR);
            $sql->bindParam(':cook_name',$menu_name,PDO::PARAM_STR);
            $store_id=$_REQUEST['store_id'];
            $menu_name=$_SESSION['user_address'];
            $sql->execute();
        }
        else{
            echo '<script>'.'alert("入力内容に誤りがありました。");'.'</script>';
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
        <title>メニュー編集ページ</title>
    </head>
    
    <?php require 'header.php'; ?>
    
    <body>
        <div class="main board2" style="padding-top:10% ;padding-bottom:10px">
            <div class="waku" style="padding-left:7%">
                <div class="cp_iptxt" style="margin-left:3%">
                    <form action="" method="post" >
                        <h1 style="text-align:center;">料理の登録</h1>
                        <input style="margin-top:5%;color:black" type="text" class="rightgreen" name="menu_name" placeholder="登録したい料理名を入力してください"><br>
                        <input style="margin-top:5%;color:black" type="text" class="rightgreen" name="menu_comment" placeholder="料理についてのコメントをお願いします"><br>
                        <input style="margin-top:5%;margin-left:40%" class="btn btn--orange" type="submit" name="submit" value="追加"><br>
                    </form>
                </div>
            </div>
                    
            <div class="waku" style="padding-left:7%;margin-top:10%">
                <div class="cp_iptxt" style="margin-left:3%">
                    <form action="" method="post">
                        <h1 style="text-align:center;margin-top:5%">料理の削除</h1>
                        <input style="margin-top:5%;color:black" type="text" class="rightgreen" name="menu_name" placeholder="削除したい料理名を入力してください"><br>
                        <input style="margin-top:5%;margin-left:40%" class="btn btn--orange" type="submit" name="delete" value="削除"><br>
                    </form>
                </div>
            </div>
        </div>
    </body>
    
    
    <?php require 'footer.php'; ?>
    
</hmtl>