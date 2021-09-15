<?php
    require 'dbconnect.php';
    require 'login_check.php';
    error_reporting(0);
    /*var_dump($_POST);*/
    $error=false;
    if($_POST['exchange']){
        if($_POST['exchange_user_address']==""){
            $error=true;
        }
        if(!$error){
            $sql=$pdo->prepare("INSERT INTO user_report (user_address, store_id) VALUES (:user_address,:store_id)");
            $sql->bindParam(':user_address',$user_id, PDO::PARAM_STR);
            $sql->bindParam(':store_id',$store_id,PDO::PARAM_STR);
            $user_id=$_POST['exchange_user_address'];
            $store_id=$_POST['store_id'];
            $sql->execute();
            $_SESSION['complete']="exchange";
            header("Location: top.php");
        }
        else{
            echo "<script>alert('入力内容に誤りがあります');</script>";
        }
    }
    else if($_POST['exchange_memo']){
        if($_POST['exchange_user_address']==""){
            $error=true;
        }
        
        if(!$error){
            
            $sql="select * from store_visit where user_address=:user_address and store_name=:store_name";
            $stmt=$pdo->prepare($sql);
            $stmt->bindParam(':user_address',$user_address, PDO::PARAM_STR);
            $stmt->bindParam(':store_name',$store_name,PDO::PARAM_STR);
            $user_address=$_SESSION['user_address'];
            $store_name=$_POST['store_name'];
            $stmt->execute();
            $results=$stmt->fetchall();
            
            var_dump($results);
            
            $sql="INSERT INTO store_visit (user_address,store_name,store_place,cook_comment,visit_time,make_user) 
            VALUES (:user_address,:store_name,:store_place,:cook_comment,:visit_time,:make_user)";
            $stmt=$pdo->prepare($sql);
            $stmt->bindParam(':user_address',$user_address, PDO::PARAM_STR);
            $stmt->bindParam(':store_name',$store_name,PDO::PARAM_STR);
            $stmt->bindParam(':store_place',$store_place,PDO::PARAM_STR);
            $stmt->bindParam(':cook_comment',$cook_comment,PDO::PARAM_STR);
            $stmt->bindParam(':visit_time',$visit_time,PDO::PARAM_STR);
            $stmt->bindParam(':make_user',$make_user,PDO::PARAM_STR);
            $user_address=$_POST['exchange_user_address'];
            $store_name=$results[0]['store_name'];
            $store_place=$results[0]['store_place'];
            $cook_comment=$results[0]['cook_comment'];
            $visit_time=$results[0]['visit_time'];
            $make_user=$results[0]['make_user'];
            $stmt->execute();
            $_SESSION['complete']="exchange";
            header("Location: top.php");
        }
        else{
        echo "<script>alert('入力内容に誤りがあります');</script>";
        }
    }

    $sql="SELECT * FROM user_report where user_address=:id";
    $stmt=$pdo->prepare($sql);
    $stmt->bindParam(':id',$id, PDO::PARAM_STR);
    $id=$_SESSION['user_address'];
    $stmt->execute();
    $results=$stmt->fetchall();
    //var_dump($results);
    
?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="destyle.css">
        <link rel="stylesheet" href="stylesheet.css">
        <link href="https://fonts.googleapis.com/earlyaccess/hannari.css" rel="stylesheet">
        <title>情報交換ページ</title>
    </head>
    
    <body>
        <?php require 'header.php'; ?>
        <div class="main board2" style="padding-top:10% ;padding-bottom:10px;height:2500px">
            
            
            <?php if($_REQUEST['kind']=="store"){ ?>
            <div id="id1"class="waku" style="padding-left:7%">
                <div class="cp_iptxt" style="margin-left:3%">
                    <form action="" method="post">
                        <h1 style="text-align:center;">ストア情報交換ページ</h1>
                        <h2 style="margin-top:10%;text-align:center;color:black">1. 情報を渡したい相手のメールアドレス入力してください</h2>
                        <input class="rightgreen" style="margin-top:10%;text-align:center;" type="text" name="exchange_user_address" placeholder="例:XXXXXXXX@gmail.com">
                        <h2 style="margin-top:10%;text-align:center;">2. 相手に送りたい情報を選択してください（一件のみ）</h2>
                        <select style="margin-top:15%;margin-left:25%;width:50%; text-align:center;"class="rightgreen" name="store_id">
                            <?php foreach($results as $result){ ?>
                                <?php
                                    $sql="SELECT * FROM store where store_id=:store_id";
                                    $stmt=$pdo->prepare($sql);
                                    $stmt->bindParam(':store_id',$store_id, PDO::PARAM_STR);
                                    $store_id=$result['store_id'];
                                    $stmt->execute();
                                    $results2=$stmt->fetchall();
                                    var_dump($results)
                                ?>
                                <option value=<?php echo $result['store_id']; ?> > <?php echo $results2[0]['store_name']; ?> </option>
                            <?php } ?>
                        </select>
                        <div><input type="submit" style="margin-top:15%;margin-left:40%;text-align:center" name="exchange" class="btn btn--orange"></div>
                    </form>
                </div>
            </div>
            
            <?php }else if($_REQUEST['kind']=="memo"){ ?>
            
            <div id="id2" class="waku" style="padding-left:7%;margin-top:10%">
                <div class="cp_iptxt" style="margin-left:3%">
                    <form action="" method="post">
                        <h1 style="text-align:center;">メモ情報交換ページ</h1>
                        <h2 style="margin-top:10%;text-align:center;color:black">1. 情報を渡したい相手のメールアドレス入力してください</h2>
                        <input class="rightgreen" style="margin-top:10%;text-align:center;" type="text" name="exchange_user_address" placeholder="例:XXXXXXXX@gmail.com">
                        <h2 style="margin-top:10%;text-align:center;">2. 相手に送りたい情報を選択してください（一件のみ）</h2>
                        <select style="margin-top:15%;margin-left:25%;width:50%; text-align:center;"class="rightgreen" name="store_name">
                                <?php
                                    $sql="SELECT * FROM store_visit where user_address=:user_address";
                                    $stmt=$pdo->prepare($sql);
                                    $stmt->bindParam(':user_address',$user_address, PDO::PARAM_STR);
                                    $user_address=$_SESSION['user_address'];
                                    $stmt->execute();
                                    $results2=$stmt->fetchall();
                                ?>
                            <?php foreach($results2 as $result){ ?>
                                <option value=<?php echo $result['store_name']; ?> > <?php echo $result['store_name']; ?> </option>
                            <?php } ?>
                        </select>
                        <div><input type="submit" style="margin-top:15%;margin-left:40%;text-align:center" name="exchange_memo" class="btn btn--orange"></div>
                    </form>
                </div>
            </div>
            
            <?php }else{ ?>
            
            <div class="waku" style="margin-bottom:30%;padding-left:10%">
                <div class="cp_iptxt" style="">
                    <h1 style="text-align:center;margin-top:5%">交換する情報の種類をお選びください</h1>
                    <h2 style="margin-top:3%;margin-left:15%">ストア情報:公式な店舗データ</h2>
                    <h2 style="margin-top:3%;margin-left:15%">メモ情報　:ユーザが作成した店舗データ</h2>
                    <div style="margin-top:5%">
                        <a href="exchange.php?kind=store"style="margin-left:5%"class="btn btn--orange">ストア情報交換</a>
                        <a href="exchange.php?kind=memo"style="margin-left:5%"class="btn btn--orange">メモ情報交換</a>
                    </div>
                </div>
            </div>
            
            <?php  } ?>
        </div>
        <?php require 'footer.php'; ?>
    </body>
</html>