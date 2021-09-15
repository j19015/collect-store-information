<?php
    require 'login_check.php';
    error_reporting(0);
    session_start();
    if($_SESSION["complete"]=="exchange"){
        echo "<script>alert('情報交換が完了致しました');</script>";
        $_SESSION['complete']=null;
    }
    
    if($_SESSION["complete"]=="memo"){
        echo "<script>alert('店舗メモ登録が完了しました');</script>";
        $_SESSION['complete']=null;
    }
    if($_SESSION["edit"]=="complete"){
        echo "<script>alert('店舗情報変更が完了しました');</script>";
        $_SESSION['edit']=null;
    }
    if($_SESSION['qr']=="complete"){
         echo "<script>alert('店舗情報の読み取りが完了しました');</script>";
        $_SESSION['qr']=null;
    }
    if($_SESSION['kind']=="person"){
        $sql="SELECT * FROM user where user_address=:user_address";
        $stmt=$pdo->prepare($sql);
        $stmt->bindParam(':user_address',$_SESSION['user_address'], PDO::PARAM_STR);
        $stmt->execute();
        $results=$stmt->fetchall();
    }
    else{
        $sql="SELECT * FROM store where store_id=:user_address";
        $stmt=$pdo->prepare($sql);
        $stmt->bindParam(':user_address',$_SESSION['user_address'], PDO::PARAM_STR);
        $stmt->execute();
        $results=$stmt->fetchall();
    }
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>トップページ</title>
    <link rel="stylesheet" href="destyle.css">
    <link rel="stylesheet" href="stylesheet.css">
    <link href="https://fonts.googleapis.com/earlyaccess/hannari.css" rel="stylesheet">
</head>

<body>
    <?php require 'header.php'; ?>
    
    <div class="main board" style="height:1600px">
        <?php if($_SESSION['kind']=="person"){ ?>
        <div class="wrapper">
            <p class="box2">
                このWebサイトは自分が訪れた店を共有する目的で作られました。<br>
                1.「メモ」のタブから訪れた店舗に関するメモを入力します<br>
                2.メモはいつでもマイページから確認ができます<br>
                3.「情報交換」のタブから簡単にメモが知人へと共有できます<br>
                4.共有された情報もマイページから確認できます
            </p>
        </div>
        <?php }else{ ?>
        <div class="wrapper">
            <p class="box2">
                ここは店舗側のページになります<br>
                ・店舗に関する情報の編集<br>
                ・メニューの追加、削除<br>
                以上のことが行えます<br>
                詳しくはページの<a href="">使用方法</a>についてをお読みください。
            </p>
        </div>
        <?php } ?>
        <div class="wrapper">
            <p class="box2" style="margin-left:30%">
                1. Enter the store note you set from the "Memo" tab. <br>
                2. You can check the memo at any time from My Page. <br>
                3. You can share your memos with acquaintances from the "Information exchange" settings. <br>
                4. Shared information can also be shared from My Copy.
            </p>
        </div>
        
        <div class="wrapper">
            <p class="box2">
                <?php if($_SESSION['kind']=="person"){ ?>
                あなたのログイン情報について<br>
                ・メールアドレス:<span style="font-size:40px"><?php echo $results[0]['user_address']; ?></span>です<br>
                ・アカウント種別は<span style="font-size:40px">「個人」</span>です<br>
                ・アカウントのニックネームは:<span style="font-size:40px"><?php echo $results[0]['user_name']; ?></span>です<br>
                <?php }else{ ?>
                あなたのログイン情報について<br>
                ・アカウントID:<span style="font-size:40px"><?php echo $results[0]['store_id']; ?></span>です<br>
                ・アカウントの店舗ネームは:<span style="font-size:40px"><?php echo $results[0]['store_name']; ?></span>です<br>
                <?php } ?>
            </p>
        </div>
        
        <div class="wrapper">
            <p class="box2" style="margin-left:30%">
                ・推奨ブラウザ:Google Chrome<br>
                ・推奨ページ倍率:100% <br>
                ・推奨OS Windows10 <br>
                ※推奨環境以外での動作は補償いたしかねます
            </p>
        </div>

        


    </div>
    <!--
    <a href="mypage.php">マイページへ</a><br>
    <a href="store_only.php">企業用ページへ</a><br>
    <a href="new_submit.php">新規登録</a><br>
    <a href="login.php">ログインページへ</a><br>
    <a href="logout.php">ログアウトページへ</a><br>
    <a href="exchange.php">情報交換ページへ</a><br>
    -->
    
   <?php require 'footer.php'; ?>
</body>