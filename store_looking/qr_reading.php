<?php
    $check=true;
    require 'login_check.php';
    require 'dbconnect.php';
    //var_dump($_POST);
    if($_POST){
        if($_POST['submit']){
            $sql="select * from store where store_id=:store_id and store_user_password=:store_user_password";
            $stmt=$pdo->prepare($sql);
            $stmt->bindParam(':store_id',$_POST['store_id'],PDO::PARAM_STR);
            $stmt->bindParam(':store_user_password',$_POST['password'],PDO::PARAM_STR);
            $stmt->execute();
            $results=$stmt->fetchall();
            var_dump($results);
            if($results){
                if($check){
                    $sql=$pdo->prepare("INSERT INTO user_report (user_address, store_id) VALUES (:user_address,:store_id)");
                    $sql->bindParam(':user_address',$user_id, PDO::PARAM_STR);
                    $sql->bindParam(':store_id',$store_id,PDO::PARAM_STR);
                    $user_id=$_SESSION['user_address'];
                    $store_id=$_POST['store_id'];
                    $sql->execute();
                    $_SESSION['qr']="complete";
                    header("Location: top.php");
                }
            }
            else{
                echo '<script>alert("入力内容に誤りがありました。");</script>';
            }
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
    </head>

    <body>
    
        <?php require 'header.php'; ?>
        
        <div class="main board2" style="padding-top:10% ;padding-bottom:10px">
            <div class="waku" style="padding-left:7%">
                <div class="cp_iptxt" style="margin-left:3%">
                    <form action="" method="post">
                        <h1 style="text-align:center;margin-top:5%">店舗情報読み取りページ</h1>
                        <h2 style="text-align:center;margin-top:5%">店舗ID</h2>
                        <?php if($_GET){ ?>
                        <input style="text-align:center;margin-top:5%;color:black" type="text" class="rightgreen" name="store_id" value= <?php echo $_GET["store_id"] ?> readonly><br>
                        <?php }else{ ?>
                        <input style="text-align:center;margin-top:5%;color:black" type="text" class="rightgreen" name="store_id" placeholder="現在、訪れている店舗のどこかに記載されている店舗IDを入力してください"><br>
                        <?php } ?>
                        <h2 style="text-align:center;margin-top:5%">店舗情報読み取りパスワード
                        <input style="text-align:center;margin-top:5%;color:black" type="text" class="rightgreen" name="password" placeholder="現在、訪れている店舗のどこかに記載されている店舗IDを入力してください"><br>
                        <input style="text-align:center;margin-top:5%" type="submit" class="btn btn--orange"name="submit">
                    </form>
                </div>
            </div>
        </div>
                    
        <?php require 'footer.php'; ?>
</body>