<?php
ini_set('display_errors', 'On'); // エラーを表示させるようにしてください
error_reporting(E_ALL); // 全てのレベルのエラーを表示してください
//1. POSTデータ取得
// $position = $_POST['currentPosi'];
$buildingName = $_POST['buildingName'];
$name = $_POST['name'];
$comment = $_POST['comment'];
$id   = $_POST["id"];   //idを取得

//2. DB接続します
include("funcs.php");  //funcs.phpを読み込む（関数群）
sschk();
$pdo = db_conn();      //DB接続関数


//３．データ登録SQL作成
$sql = "update gs_map_table set buildingName=:buildingName, name=:name, comment=:comment where id=:id";
$update = $pdo->prepare($sql);
// $stmt->bindValue(':currentPosi',  $position,   PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$update->bindValue(':buildingName', $buildingName,  PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$update->bindValue(':name',   $name,    PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$update->bindValue(':comment',$comment, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$update->bindValue(':id',$id,  PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $update->execute(); //実行


//４．データ登録処理後
if($status==false){
    sql_error($stmt);
}else{
    redirect("select.php");
}

?>