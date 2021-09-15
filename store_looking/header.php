<header>
        <div class="main">
            <div class="right">
                <h1><a href="top.php">CSI</a></h1>
                <h2><a href="top.php">collect store infomation</a></h2>
            </div>
            <div class="left">
                <?php if ($_SESSION["kind"]=="person"){ ?>
                    <ul>
                        <li><h2><a class="btn btn--yellow btn--cubic" href="mypage.php">マイページ</a></h2></li>
                        <li><h2><a class="btn btn--yellow btn--cubic" href="store_memo.php">メモ</a></h2></li>
                        <li><h2><a class="btn btn--yellow btn--cubic" href="qr_reading.php">店舗情報読取</a></h2></li>
                        <li><h2><a class="btn btn--yellow btn--cubic" href="exchange.php">情報交換ページ</a></h2></li>
                        <li><h2><a class="btn btn--yellow btn--cubic" href="logout.php">ログアウト</a></h2></li>
                    </ul>
                <?php }else if($_SESSION["kind"]=="shop"){ ?>
                    <ul>
                        <li><h2><a class="btn btn--yellow btn--cubic" href="store_menu_edit.php">メニュー編集ページ</a><br></h2></li>
                        <li><h2><a class="btn btn--yellow btn--cubic" href="store.php?store_id=<?php echo $_SESSION["user_address"];?>">企業用ページ</a><br></h2></li>
                        <li><h2><a class="btn btn--yellow btn--cubic" href="logout.php">ログアウト</a><br></h2></li>
                    </ul>
                <?php }else{ ?>
                    <ul>
                        <li><h2><a class="btn btn--yellow btn--cubic" href="new_submit.php">新規登録</a><br></h2></li>
                    </ul>
                <?php } ?>
            </div>
        </div>
</header>