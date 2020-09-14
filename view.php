<?php
include("lib.php");
include("db.php");

if(!isset($_SESSION['user'])){
    msgGo('로그인 후 이용가능합니다.','login.php');
    exit;
}
if(!isset($_GET['id'])){
    msgGo('접근 오류','board.php');
    exit;
}

$user = $_SESSION['user'];
$id = $_GET['id'];
$sql = "SELECT * FROM boards WHERE id = ?";
$board = fetch($db,$sql,[$id]);
$readCnt = $board->readCnt;
$readCnt+=1;
$sql = "UPDATE boards SET `readCnt` =? WHERE id=?";
$checkSQL = execute($db,$sql,[$readCnt,$id]);

if(!$checkSQL){
    msgBack('SQL문 실행오류');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title> 
</head>
<body>
    <ul>
        <h2>제목 : <?=$board->title?></h2>
        <p>내용 : <?=$board->content?></p>
    </ul>
</body>
</html>