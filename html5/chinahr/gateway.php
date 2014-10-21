<?php
include_once "config.php";
header("Content-Type:application/json; Charset=utf-8");

$total = 10;
$method = $_GET['method'];

$dsn = "mysql:host=".$chinahr_db['host'].";dbname=".$chinahr_db['database'];
$db = new PDO($dsn, $chinahr_db['username'], $chinahr_db['password']);
$db->exec("set names utf8");
if ($method == 'get_resumes')
{
    $sql = "select * from resume";
    $rs = $db->query($sql);
    $records = $rs->fetchAll();
    echo json_encode($records);
}
elseif ($method == 'get_hits')
{
    $sql = "select * from resume where hit=1";
    $rs = $db->query($sql);
    $records = $rs->fetchAll();
    echo json_encode($records);
}
elseif ($method == 'get_unhits')
{
    $sql = "select * from resume where hit=0";
    $rs = $db->query($sql);
    $records = $rs->fetchAll();
    echo json_encode($records);
}
elseif ($method == 'draw')
{
    $sql = "select count(*) as total from resume where hit=1";
    $rs = $db->query($sql);
    $result = $rs->fetch();
    $num = $result[0];
    if ($num >= $total) {
        $result = array('code'=>'-1', 'msg'=>'max', 'num'=>$num);
        echo json_encode($result);
        exit(0);
    }
    $sql = "select id from resume where hit=0";
    $rs = $db->query($sql);
    $records = $rs->fetchAll();
    $count = count($records);
    if ($count == 0) {
        $result = array('code'=>'-1', 'msg'=>'null');
        echo json_encode($result);
        exit(0);
    }
    $index = rand(0, $count-1);
    $id = $records[$index]['id'];
    $sql = "update resume set hit=1 where id=$id";
    $db->exec($sql);
    $sql = "select * from resume where id=$id";
    $rs = $db->query($sql);
    $record = $rs->fetch();
    echo json_encode($record);
}
elseif ($method == 'check_mobile') {
    $mobile = $_GET['mobile'];
    $sql = "select * from resume where mobile='$mobile'";
    $rs = $db->query($sql);
    $record = $rs->fetch();
    if ($record) {
        $result = array('code'=>'1', 'exist'=>'true');
    }
    else {
        $result = array('code'=>'-1', 'exist'=>'false');
    }
    echo json_encode($result);
}
elseif ($method == 'clear_hits')
{
    $sql = "update resume set hit=0";
    $db->exec($sql);
    $result = array('code'=>'1', 'msg'=>'success');
    echo json_encode($result);
}
elseif ($method == 'clear_records') 
{
    $sql = "truncate resume";
    $db->exec($sql);
    $result = array('code'=>'1', 'msg'=>'success');
    echo json_encode($result);
}
?>
