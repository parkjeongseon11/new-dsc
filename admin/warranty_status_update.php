<?php 
include_once("../common.php");

$id = $_REQUEST["id"];
$status = $_REQUEST["status"];

$sql = "update `rutilo_warranty` set status = {$status} where id = {$id}";

sql_query($sql);

alert("처리되었습니다.");