<?php
    //var_dump($_POST);
    error_reporting(0);
    require 'dbconnect.php';
    require 'login_check.php';
    if($_POST['edit']){
        $fileName1 = $_FILES['cover']['name'];
        if(!empty($fileName1)){
        //substr = 文字列から一部を切り取る（-3は後ろから3文字）
            $ext = substr($fileName1, -3);
            $ext2 = substr($fileName1, -3);
            if($ext != 'jpg' && $ext != 'png' &&$ext2!='jpeg'){
                $error['cover'] = 'type1';
            }
        }
        var_dump($_POST);
        if($_POST['store_user_password']==""||$_POST['store_id']==""||$_POST['store_name']==""||$_POST['store_password']==""||$_POST['store_mail_address']==""&&$_POST['store_address']==""&&$_POST['store_comment']==""){
            $error['cover']="blank";
        }
        var_dump($error);
        if(empty($error)){
            $cover = $_FILES['cover']['name'];
      		move_uploaded_file($_FILES['cover']['tmp_name'], '../cover/'.$cover);
            $sql="UPDATE store SET store_name=:store_name,store_password=:store_password,store_mail_address=:store_mail_address,
            store_address=:store_address,store_comment=:store_comment,store_image=:store_image,store_user_password=:store_user_password where store_id=:store_id";
            $stmt=$pdo->prepare($sql);
            $stmt->bindParam(':store_name', $store_name, PDO::PARAM_STR);
            $stmt->bindParam(':store_password', $store_password, PDO::PARAM_STR);
            $stmt->bindParam(':store_user_password', $store_user_password, PDO::PARAM_STR);
            $stmt->bindParam(':store_mail_address', $store_mail_address, PDO::PARAM_STR);
            $stmt->bindParam(':store_address', $store_address, PDO::PARAM_STR);
            $stmt->bindParam(':store_comment', $store_comment, PDO::PARAM_STR);
            $stmt->bindParam(':store_name', $store_name, PDO::PARAM_STR);
            $stmt->bindParam(':store_image', $store_image, PDO::PARAM_STR);
            $stmt->bindParam(':store_id', $store_id, PDO::PARAM_STR);
            $store_name=$_POST['store_name'];
            $store_password=$_POST['store_password'];
            $store_user_password=$_POST['store_user_password'];
            $store_mail_address=$_POST['store_mail_address'];
            $store_address=$_POST['store_address'];
            $store_comment=$_POST['store_comment'];
            $store_name=$_POST['store_name'];
            $store_image=$cover;
            $store_id=$_POST['store_id'];
            $stmt->execute();
            $_SESSION['edit']="complete";
            header('Location: top.php');
            exit();
            
        }
        else{
            echo '<script>alert("入力内容に誤りがありました。訂正をお願いいたします。");</script>';
            //header('Location: ' . $_SERVER['HTTP_REFERER']);
            //header('Location: store_information_edit.php?store_id='.$_REQUEST['store_id']);
            //echo '<script>alert("入力内容に誤りがありました。訂正をお願いいたします。");</script>';
        }

    }
    
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
    <div class="main board2"  style="padding-top:10% ;padding-bottom:10px">
        <div class="waku" style="padding-left:10%">
            <div class="cp_iptxt">
                <form action="" method="post" enctype="multipart/form-data"> 
                    <h1 style="text-align:center;">ストア情報編集</h1>
                    <input type="hidden" style="margin-top:3%;margin-left:30% ;width:27%;color:black" name="store_id" value=<?php echo $results[0]['store_id']; ?> ></h3><br>
                    <h3 style="margin-top:2%">店名　　　　　　　　　
                    <input type="text" style="margin-top:3%;margin-left:30% ;width:27%;color:black" name="store_name" value=<?php echo $results[0]['store_name']; ?> ></h3><br>
                    <h3 style="margin-top:2%">アカウントパスワード　
                    <input type="text" style="margin-top:3%;margin-left:30% ;width:27%;color:black" name="store_password" value=<?php echo $results[0]['store_password']; ?> ></h3><br>
                    <h3 style="margin-top:2%">メールアドレス　　　　
                    <input type="text" style="margin-top:3%;margin-left:30%;width:27%;color:black" name="store_mail_address" value=<?php echo $results[0]['store_mail_address']; ?> ></h3><br>
                    <h3 style="margin-top:2%">店の住所　　　　　　　
                    <input type="text" style="margin-top:3%;margin-left:30% ;width:27%;color:black" name="store_address" value=<?php echo $results[0]['store_address']; ?> ></h3><br>
                    <h3 style="margin-top:2%">店のコメント　　　　　
                    <input type="text" style="margin-top:3%;margin-left:30% ;width:27%;color:black" name="store_comment" value=<?php echo $results[0]['store_comment']; ?> ></h3><br>
                    <h3 style="margin-top:2%">店舗読み取りパスワード
                    <input type="text" style="margin-top:3%;margin-left:30% ;width:27%;color:black" name="store_user_password" value=<?php echo $results[0]['store_user_password']; ?> ><br>
                    <h3 style="margin-top:4%">画像ファイル　　　　　
                    <input type="file" name="cover" required><br></h3>
                    
                    <input style="margin-left:45%;margin-top:10%"type="submit" name='edit' class="btn btn--orange">
                </form>
            </div>
        </div>
    </div>
    <?php require 'footer.php'; ?>
</body>
</html>