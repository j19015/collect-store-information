<?php
    error_reporting(0);
    session_start();
    echo $_SESSION['error'];
    if($_SESSION['error']=="blank"){
        echo $_SESSION['error'];
        $alert = "<script type='text/javascript'>alert('入力内容に誤りがありました。訂正してください。');</script>";
        $_SESSION['error']=null;
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
        <title>パスワード登録</title>
    </title>

    <body>
        <?php require 'header.php'; ?>
            <div class="main board2" style="padding-top:10% ;padding-bottom:10px;height:3000px">
                <div class="waku" style="padding-left:7%">
                    <div class="cp_iptxt" style="margin-left:3%">
                        <form action="new_ok.php" method="post" enctype="multipart/form-data">
                            <?php if($_REQUEST['kind']=="person"){ ?>
                            <h1 style="text-align:center;">ユーザ情報の登録</h1>
                            <input type="hidden" name="user_address" value=<?php echo $_REQUEST['id'] ?> ><br>
                            <input type="hidden" name="kind" value=<?php echo $_REQUEST['kind'] ?> ><br>
                            <h2 style="margin-top:10%;text-align:center;color:black">ユーザネーム</h2>
                            <input class="rightgreen" style="margin-top:10%;text-align:center;color:black" type="text" name="user_name" placeholder="ユーザーネームの入力をお願いします"><br>
                            <h2 style="margin-top:10%;text-align:center;color:black">パスワード</h2>
                            <input class="rightgreen" style="margin-top:10%;text-align:center;color:black" type="text" name="user_password" placeholder="パスワードの入力をお願いします"><br>
                            <input style="margin-left:40%;margin-top:10%;text-align:center;color:black" class="btn btn--orange"type="submit" name="submit"><br>
                            
                            <?php }else{ ?>
                            <h1 style="text-align:center;">　店舗情報の登録</h1>
                            <input type="hidden" name="user_address" value=<?php echo $_REQUEST['id'] ?> ><br>
                            <input type="hidden" name="kind" value=<?php echo $_REQUEST['kind'] ?> ><br>
                            <h2 style="margin-top:10%;text-align:center;color:black">店舗ID</h2>
                            <input class="rightgreen" style="margin-top:3%;color:black" type="text" name="store_id" placeholder="店舗IDの入力をお願いします"><br>
                            <h2 style="margin-top:10%;text-align:center;color:black">店舗名</h2>
                            <input class="rightgreen" style="margin-top:3%;color:black"type="text" name="store_name" placeholder="店舗名の入力をお願いします"><br>
                            <h2 style="margin-top:10%;text-align:center;color:black">店舗パスワード</h2>
                            <input class="rightgreen" style="margin-top:3%;color:black"type="text" name="store_password" placeholder="店舗パスワードの入力をお願いします"><br>
                            <h2 style="margin-top:10%;text-align:center;color:black" >店舗メールアドレス</h2>
                            <input class="rightgreen" style="margin-top:3%;color:black"type="text" name="store_mail_address" value="<?php if($_REQUEST)echo $_REQUEST['id']; ?>" placeholder="店舗メールアドレスの入力をお願いします" readonly><br>
                            <h2 style="margin-top:10%;text-align:center;color:black">店舗住所</h2>
                            <input class="rightgreen" style="margin-top:3%;color:black"type="text" name="store_address" placeholder="店舗住所の入力をお願いします"><br>
                            <h2 style="margin-top:10%;text-align:center;color:black">店舗コメント</h2>
                            <input class="rightgreen" style="margin-top:3%;color:black"type="text" name="store_comment" placeholder="店舗コメントの入力をお願いします"><br>
                            <h2 style="margin-top:10%;text-align:center;color:black">店舗ユーザ用パスワード</h2>
                            <input class="rightgreen" style="margin-top:3%;color:black"type="text" name="store_user_password" placeholder="店舗ユーザ用パスワードの入力をお願いします"><br>
                            <h2 style="margin-top:10%;text-align:center;color:black">TOPページに使う画像</h2>
                            <label><input style="margin-left:30%;margin-top:10%;text-align:center;color:black" type="file" name="cover" required></label><br>
                            <input style="margin-left:40%;margin-top:10%;text-align:center;color:black" class="btn btn--orange"type="submit" name="submit"><br>
                            <?php } ?>
                        </form>
                    </div>
                </div>
            </div>

        <?php require 'footer.php'; ?>
    </body>
 </html>