<?php
    require 'dbconnect.php';
    require 'login_check.php';
    $store_id=$_REQUEST['store_id'];
    $sql="SELECT * FROM store where store_id=:store_id";
    $stmt=$pdo->prepare($sql);
    $stmt->bindParam(':store_id',$store_id, PDO::PARAM_STR);
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
    <div class="main board2"style="padding-top:10% ;padding-bottom:10px;height:auto">
        <div class="waku"style="padding-left:7%">
            <div class="cp_iptxt">
                <h1 style="margin:0 auto;text-align:center;"><?php echo $results[0]['store_name']; ?></h1><br>
                <img style="width:100%;height:100%"src="../cover/<?php echo $results[0]['store_image']; ?>"><br>
                <h3 style="margin-top:2%">店舗ID</h3>
                <h2 style="margin-left:5%"><?php echo $results[0]['store_id']; ?></h2><br>
                <h3>店舗のメールアドレス</h3>
                <h2 style="margin-left:5%"><?php echo $results[0]['store_mail_address']; ?></h2><br>
                <h3>店の住所</h3>
                <h2 style="margin-left:5%"><?php echo $results[0]['store_address']; ?></h2><br>
                <h3>店のコメント</h3>
                <h2 style="margin-left:5%"><?php echo $results[0]['store_comment']; ?></h2><br>
                <h3>店舗情報読み取りパスワード</h3>
                <h2 style="margin-left:5%"><?php echo $results[0]['store_user_password']; ?></h2><br>
                <h3>画像ファイル名</h3>
                <h2 style="margin-left:5%"><?php echo $results[0]['store_image']; ?></h2><br>
                <?php if($_SESSION['kind']=="shop"){ ?>
                <button style="margin-top:5%;margin-left:30%;"class="btn btn--orange" onclick="location.href='store_information_edit.php?store_id=<?php echo $store_id; ?>'">店舗情報編集ページ</button>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php require 'footer.php'; ?>
</body>
</html>