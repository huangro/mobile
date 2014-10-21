<!DOCTYPE html>
<html>
<head>
    <title>中移（杭州）校园招聘</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link type="text/css" rel="stylesheet" href="css/index.css" />
    <script type="text/javascript" src="js/zepto.min.js"></script>
    <script type="text/javascript">
    $(function(){
        $('#clear_hit_btn').click(function(){
            $.getJSON('/chinahr/gateway.php?method=clear_hits', function(data){
                if (data.code == '1') {
                    alert('中奖数据已经重置');
                }
            });
        });
        $('#truncate_btn').click(function(){
            $.getJSON('/chinahr/gateway.php?method=clear_records', function(data){
                if (data.code == '1') {
                    alert('签到数据已经清空');
                }
            });
        });
    });
    </script>
</head>

<body class="bg2">
    <div class="container">
        <div class="clear_box" align="center">
            <input type="button" id="clear_hit_btn" value="重置中奖" />
            <input type="button" id="truncate_btn" value="清除数据" />
        </div>
    </div>
</body>

</html>

