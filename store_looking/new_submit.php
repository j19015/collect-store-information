<?php
    error_reporting(0);
    session_start();
    if($_SESSION['error']=='new'){
        echo '<script>alert("入力内容に誤りがありました。");</script>';
        $_SESSION['error']=null;
    }
    
     if($_SESSION['error']=='already'){
        echo '<script>alert("このユーザは既に存在します。");</script>';
        $_SESSION['error']=null;
    }
?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="destyle.css">
        <link rel="stylesheet" href="stylesheet.css">
        <link href="https://fonts.googleapis.com/earlyaccess/hannari.css" rel="stylesheet">
    </head>

    <body>
        <?php require 'header.php'; ?>
        <div class="main board2" style="padding-top:10% ;padding-bottom:10px">
            <div class="waku" style="padding-left:7%">
                <div class="cp_iptxt" style="margin-left:3%">
                    <form action="new_mail.php" method="post">
                        <h1 style="text-align:center;">新規登録</h1>
                        <h2 style="text-align:center;margin-top:10%;">メールアドレス</h2>
                        <input style="margin-top:3%;color:black" class="rightgreen" type="text" name="e-mail" placeholder="メールアドレスを入力してください">
                        <h2 style="text-align:center;margin-top:10%">アカウントの種類</h2>
                        <select style="margin-top:3%;;width:100%; text-align:center;"class="rightgreen" name="kind">
                            <option value="shop">店舗アカウント</option>
                            <option value="person">個人アカウント</option>
                        </select>
                        <input type="submit" style="margin-top:15%;margin-left:40%;text-align:center" name="submit" class="btn btn--orange">
                    </form>
                </div>
            </div>
        </div>


        <?php require 'footer.php'; ?>
    </body>
</html>

<?php
    
?>