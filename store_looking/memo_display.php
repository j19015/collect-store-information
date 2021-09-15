<?php
    require 'dbconnect.php';
    require 'login_check.php';
    $sql="SELECT * FROM store_visit where user_address=:user_address and store_name=:store_name";
    $stmt=$pdo->prepare($sql);
    $stmt->bindParam(':user_address',$user_address, PDO::PARAM_STR);
    $stmt->bindParam(':store_name',$store_name, PDO::PARAM_STR);
    $user_address=$_SESSION['user_address'];
    $store_name=$_REQUEST['store_name'];
    $stmt->execute();
    $results=$stmt->fetchall();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="destyle.css">
    <link rel="stylesheet" href="stylesheet.css">
    <link href="https://fonts.googleapis.com/earlyaccess/hannari.css" rel="stylesheet">
    <title>ストア情報</title>
</head>

<body>
    <?php require 'header.php'; ?>
    <div class="main board2"style="padding-top:10% ;padding-bottom:10px;height:1500px">
        <div class="waku"style="padding-left:7%">
            <div class="cp_iptxt">
                <h1 style="margin:0 auto;text-align:center;"><?php echo $results[0]['store_name']; ?></h1><br>
                <h3 style="margin-top:2%">店舗の場所</h3>
                <h2 style="margin-left:5%"><?php echo $results[0]['store_place']; ?></h2><br>
                <h3>店舗に対するコメント</h3>
                <h2 style="margin-left:5%"><?php echo $results[0]['cook_comment']; ?></h2><br>
                <h3>店舗を訪れた日時</h3>
                <h2 style="margin-left:5%"><?php echo $results[0]['visit_time']; ?></h2><br>
                <h3>このメモの作成者</h3>
                <h2 style="margin-left:5%"><?php echo $results[0]['make_user']; ?></h2><br>
            </div>
        </div>
    </div>
    <?php require 'footer.php'; ?>
</body>
</html>