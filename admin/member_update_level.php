<?php 
include_once("../common.php");

$mb_no = $_REQUEST["mb_no"];
$type = $_REQUEST["type"];
if($type=="down"){
	$sql = "update `g5_member` set mb_level = 2, mb_1 = 2 where mb_no = {$mb_no}";
}else{
	$sql = "update `g5_member` set mb_level = 4, mb_1 = 2 where mb_no = {$mb_no}";
}


sql_query($sql);

alert("가맹신청이 승인 되었습니다.");
?>