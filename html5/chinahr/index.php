<!DOCTYPE html>
<html>
<head>
    <title>中移（杭州）校园招聘</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width,target-densitydpi=high-dpi,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <link type="text/css" rel="stylesheet" href="css/ui-dialog.css" />
    <link type="text/css" rel="stylesheet" href="css/index.css" />
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
                    <div class="label">姓名</div>
                    <div class="input">
                        <input type="text" name="name" id="name" value="" placeholder="请输入您的姓名" />
                    </div>
                    <em>*</em>
                </div>
                <div class="item">
                    <div class="label">手机</div>
                    <div class="input">
                        <input type="text" name="mobile" id="mobile" value="" placeholder="请输入您的手机号码" />
                    </div>
                    <em>*</em>
                </div>
                <div class="item">
                    <div class="label">学校</div>
                    <div class="input">
                        <input type="text" name="school" value="" placeholder="请输入学校名称" />
                    </div>
                </div>
                <div class="item">
                    <div class="label">专业</div>
                    <div class="input">
                        <input type="text" name="major" value="" placeholder="请输入您的专业" />
                    </div>
                </div>
                <div class="item">
                    <div class="label">学历</div>
                    <div class="input">
                        <select name="education">
                            <option value="本科">本科</option>
                            <option value="硕士">硕士</option>
                            <option value="博士">博士</option>
                            <option value="其他">其他</option>
                        </select>
                    </div>
                </div>
                <div class="action">
                    <input type="button" id="sign_btn" value="点击签到" />
                </div>
                <div class="hook left"></div>
                <div class="hook right"></div>
            </form>
        </div>
    </div>
<?php
    include_once "config.php";
    $post = $_POST;
    if ($post) {
        $dsn = "mysql:host=".$chinahr_db['host'].";dbname=".$chinahr_db['database'];
        $db = new PDO($dsn, $chinahr_db['username'], $chinahr_db['password']);
        $db->exec("set names utf8");
        $sql = "select * from resume where mobile='".$post['mobile']."'";
        $rs = $db->query($sql);
        $record = $rs->fetch();
        if ($record) {
            echo 'show_msg("您已经签到");';
        }
        else {
            $sql = "insert into resume(name, mobile, school, major, education, created_at) values('".$post['name']."','".$post['mobile']."','".$post['school']."','".$post['major']."','".$post['education']."', now())";
            $db->exec($sql);
            echo '<script type="text/javascript">show_msg("签到成功！");</script>';
        }
    }
?>
</body>

</html>

