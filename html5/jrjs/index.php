<!DOCTYPE html>
<html>
<head>
    <!--<meta name="viewport" content="width=device-width,target-densitydpi=high-dpi,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>-->
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1.0, minimum-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <title>同业业务机构信息登记表 --- 金融加速</title>
    <link type="text/css" rel="stylesheet" href="css/ui-dialog.css" />
    <link type="text/css" rel="stylesheet" href="css/style.css" />
    <script type="text/javascript" src="js/jquery-1.10.2.js"></script>
    <script type="text/javascript" src="js/dialog-min.js"></script>
    <script type="text/javascript" src="js/index.js"></script>
</head>

<body>
    <div class="container">
        <div class="logo"></div>
        <div class="formbox">
            <form name="register" class="register" id="register" action="" method="post">
                <div class="item">
                    <div class="label">银行名称</div>
                    <div class="input">
                        <input type="text" name="name" id="name" value="" placeholder="请输入银行名称" />
                    </div>
                    <em>*</em>
                </div>
                <div class="item">
                    <div class="label">机构通信地址</div>
                    <div class="input">
                        <input type="text" name="address" id="address" value="" placeholder="请输入机构通信地址" />
                    </div>
                    <em>*</em>
                </div>
                <div class="item">
                    <div class="label">电话</div>
                    <div class="input">
                        <input type="text" name="tel" id="tel" value="" placeholder="请输入电话号码" />
                    </div>
                    <em>*</em>
                </div>
                <div class="item">
                    <div class="label">QQ</div>
                    <div class="input">
                        <input type="text" name="qq" id="qq" value="" placeholder="请输入QQ号码" />
                    </div>
                    <em>*</em>
                </div>
                <div class="item">
                    <div class="label">业务范围</div>
                    <div class="input">
                        <input type="text" name="business" id="business" value="" placeholder="请输入业务范围" />
                    </div>
                    <em>*</em>
                </div>
                <div class="action">
                    <input type="button" id="sign_btn" value="点击登记" />
                </div>
            </form>
        </div>
    </div>
<?php
    include_once "config.php";
    $post = $_POST;
    if ($post) {
        $dsn = "mysql:host=".$mdb['host'].";dbname=".$mdb['database'];
        $db = new PDO($dsn, $mdb['username'], $mdb['password']);
        $db->exec("set names utf8");
        $sql = "select * from bank where tel='".$post['tel']."'";
        $rs = $db->query($sql);
        $record = $rs->fetch();
        if ($record) {
            echo '<script type="text/javascript">show_msg("您之前已经登记！");</script>';
        }
        else {
            $sql = "insert into bank(name, address, tel, qq, business, created_at) values('".$post['name']."','".$post['address']."','".$post['tel']."','".$post['qq']."','".$post['business']."', now())";
            $db->exec($sql);
            echo '<script type="text/javascript">show_msg("登记成功！");</script>';
        }
    }
?>
</body>
</html>
