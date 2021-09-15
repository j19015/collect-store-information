<?php
    error_reporting(0);
    require 'login_check.php';
    require 'dbconnect.php';
    //error_reporting(0);
    //var_dump($_POST);
    if($_SESSION['error']=="memo"){
        echo '<script>'.'alert("入力内容に誤りがありました。")'.'</script>';
        $_SESSION['error']=null;
    }
    if($_POST['memo']){
        if($_POST['store_name']!=""&&$_POST['store_comment']!=""&&$_POST['store_place']!=""&&$_POST['visit_time']!=""){
            $sql=$pdo->prepare("INSERT INTO store_visit (user_address,store_name,cook_comment,store_place,visit_time,make_user) 
            VALUES (:user_address,:store_name,:store_comment,:store_place,:visit_time,:make_user)");
            $sql->bindParam(':user_address',$user_address, PDO::PARAM_STR);
            $sql->bindParam(':store_name',$store_name,PDO::PARAM_STR);
            $sql->bindParam(':store_comment',$store_comment,PDO::PARAM_STR);
            $sql->bindParam(':store_place',$store_place,PDO::PARAM_STR);
            $sql->bindParam(':visit_time',$visit_time,PDO::PARAM_STR);
             $sql->bindParam(':make_user',$make_user,PDO::PARAM_STR);
            $user_address=$_SESSION['user_address'];
            $store_name=$_POST['store_name'];
            $store_comment=$_POST['store_comment'];
            $store_place=$_POST['store_place'];
            $visit_time=$_POST['visit_time'];
            $make_user=$_SESSION['user_address'];
            $sql->execute();
            $_SESSION['complete']="memo";
            header("Location: top.php");
        }
        else{
            $_SESSION['error']="memo";
            header("Location: store_memo.php");
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
        <title>メモ</title>
    </head>
    
    <body>
        <?php require 'header.php'; ?>
        
        <div class="main board2" style="padding-top:10% ;padding-bottom:10px;height:3000px">
                <div class="waku" style="padding-left:7%">
                    <div class="cp_iptxt" style="margin-left:3%">
                        <form action="" method="post">
                            <h1 style="text-align:center;">　店舗メモの登録</h1>
                            <!--<input type="hidden" name="user_address" value=<?php echo $_REQUEST['id'] ?> ><br>-->
                            <!--<input type="hidden" name="kind" value=<?php echo $_REQUEST['kind'] ?> ><br>-->
                            <h2 style="margin-top:10%;text-align:center;color:black">店舗名</h2>
                            <input style="margin-top:3%;color:black" type="text"  class="rightgreen" name="store_name" placeholder="店舗名の入力をお願いします"><br>
                            <h2 style="margin-top:10%;text-align:center;color:black">場所</h2>
                            <input style="margin-top:3%;color:black"type="text" class="rightgreen" name="store_place" placeholder="店舗の適当な住所を入力をお願いします"><br>
                            <h2 style="margin-top:10%;text-align:center;color:black">コメント</h2>
                            <input style="margin-top:3%;color:black"type="text" class="rightgreen" name="store_comment" placeholder="店舗に関するメモの入力をお願いします"><br>
                            <h2 style="margin-top:10%;text-align:center;color:black">来店日</h2>
                            <input style="margin-left:37%;margin-top:3%;color:black" class="rightgreen" type="date" name="visit_time"  placeholder="来店日の入力をお願いします"><br>
                            <input style="margin-left:40%;margin-top:10%;text-align:center;color:black" class="btn btn--orange"type="submit" name="memo"><br>
                        </form>
                    </div>
                </div>
            </div>
        
        <?php require 'footer.php'; ?>
    </body>
</html>