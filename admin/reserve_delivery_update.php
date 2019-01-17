<?php 
include_once("../common.php");
$id = $_REQUEST["id"];
$status = $_REQUEST["status"];
$delivery_company = $_REQUEST["delivery_company"];
$delivery_num = $_REQUEST["delivery_num"];

if(!$id){
	alert("잘못된 요청입니다.");
}

$sql = "update `rutilo_delivery` set status = '{$status}', `delivery_company` = '{$delivery_company}', `delivery_num` = '{$delivery_num}' where id = '{$id}'";
sql_query($sql);

alert("처리되었습니다.");
?>
