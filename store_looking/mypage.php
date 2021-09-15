<?php
    require 'login_check.php';
    require 'dbconnect.php';
    /*echo "ログインしているアカウントのIDは"."<h2>".$_SESSION['user_address']."</h2>";
    echo "ログインアカウントの種類は"."<h2>".$_SESSION['kind']."</h2>";*/
    error_reporting(0);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="destyle.css">
    <link rel="stylesheet" href="stylesheet.css">
    <link href="https://fonts.googleapis.com/earlyaccess/hannari.css" rel="stylesheet">

    <title>マイページ</title>
</head>

<body>
    <?php require 'header.php'; ?>
    <div class="main board2" style="padding-top:10% ;padding-bottom:10px;height:2000px;" >
        
       
        <?php if($_GET['kind']=="store"){ ?>
        <div id="id1" class="waku" style="margin-bottom:30%;;height:auto">
            <div class="cp_iptxt" style="text-align:center;padding:5% 5%;margin-left:10%">
                <h1>自分が所有しているストア情報</h1>
                <?php
                    $sql="SELECT * FROM user_report where user_address=:id";
                    $stmt=$pdo->prepare($sql);
                    $stmt->bindParam(':id',$id, PDO::PARAM_STR);
                    $id=$_SESSION['user_address'];
                    $stmt->execute();
                    $results=$stmt->fetchall();
                    
                    foreach($results as $row){
                        $sql="SELECT * FROM store where store_id=:id";
                        $stmt=$pdo->prepare($sql);
                        $stmt->bindParam(':id',$id, PDO::PARAM_STR);
                        $id=$row['store_id'];
                        $stmt->execute();
                        $results2=$stmt->fetchall();
                        //var_dump($results2[0]);
                        echo '<h3 style="text-align:center;;background:white;margin-top:5%;border-bottom: 2px dotted #6e7955;border-left: 10px solid #6e7955;padding: 7px;"><a href="store.php?store_id='.$row['store_id'].'">'.$results2[0]['store_name'].'</a></h3>';
                    }
                    //foreach($results as $row){
                       // echo '<h3 style="text-align:center;;background:white;margin-top:3%;border-bottom: 2px dotted #6e7955;border-left: 10px solid #6e7955;padding: 7px;"><a href="store.php?store_id='.$row['store_id'].'">'.$row['store_id'].'</a></h3>';
                    //}
                ?>
                
                <a href="mypage.php"style="margin-top:10%;margin-left:5%"class="btn btn--orange">マイページに戻る</a>
            </div>
        </div>
        <?php }else if($_GET['kind']=="memo"){ ?>
        <div id="id2" class="waku" style="padding-left:7%;height:auto;margin-top:5%">
            <div class="cp_iptxt" style="text-align:center;padding:5% 5%;margin-left:5%">
                <h1>自分が所有しているメモ情報</h1>
                
                <?php
                    $sql="SELECT * FROM store_visit where user_address=:id";
                    $stmt=$pdo->prepare($sql);
                    $stmt->bindParam(':id',$id, PDO::PARAM_STR);
                    $id=$_SESSION['user_address'];
                    $stmt->execute();
                    $results=$stmt->fetchall();
                    //var_dump($results);
                    foreach($results as $row){
                        echo '<h3 style="text-align:center;;background:white;margin-top:5%;border-bottom: 2px dotted #6e7955;border-left: 10px solid #6e7955;padding: 7px;"><a href="memo_display.php?store_name='.$row['store_name'].'">'.$row['store_name'].'</a></h3>';
                    }
                ?>
                <a href="mypage.php"style="margin-top:10%;margin-left:5%"class="btn btn--orange">マイページに戻る</a>
            </div>
        </div>
        <?php }else{ ?>
         <div class="waku" style="margin-bottom:30%;">
            <div class="cp_iptxt" style="padding:5% 5%;margin-left:10%">
                <h1 style="text-align:center;margin-top:5%">閲覧する情報の種類をお選びください</h1>
                <h2 style="margin-top:3%;margin-left:15%">ストア情報:公式な店舗データ</h2>
                <h2 style="margin-top:3%;margin-left:15%">メモ情報　:ユーザが作成した店舗データ</h2>
                <div style="margin-top:5%">
                    <a href="mypage.php?kind=store"style="margin-left:5%"class="btn btn--orange">ストア情報交換</a>
                    <a href="mypage.php?kind=memo"style="margin-left:5%"class="btn btn--orange">メモ情報交換</a>
                </div>
            </div>
        </div>
        <?php } ?>
        
        
    </div>

    <?php require 'footer.php'; ?>
</body>
</html>