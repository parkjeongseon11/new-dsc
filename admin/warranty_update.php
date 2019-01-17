<?php
include_once("../common.php");

$id = $_REQUEST["id"];
$car = $_REQUEST["car"];
$car_color = $_REQUEST["car_color"];
$car_number = $_REQUEST["car_number"];
$center_name = $_REQUEST["center_name"];
$manager = $_REQUEST["manager"];
$step = $_REQUEST["step"];
$price = $_REQUEST["price"];
$user_name = $_REQUEST["user_name"];
$user_email = $_REQUEST["user_email"];
$user_tel = $_REQUEST["user_tel"];
$user_zip = $_REQUEST["user_zip"];
$user_addr1 = $_REQUEST["user_addr1"];
$user_addr2 = $_REQUEST["user_addr2"];
$sign_date = $_REQUEST["sign_date"];

$sql = "update `rutilo_warranty` set car = '{$car}',car_color = '{$car_color}',car_number='{$car_number}',center_name='{$center_name}',manager='{$manager}',program='{$step}',price='{$price}',user_name='{$user_name}',user_email='{$user_email}',user_tel='{$user_tel}',user_zip='{$user_zip}',user_addr1='{$user_addr1}',user_addr2='{$user_addr2}', sign_date = '{$sign_date}' where id = '{$id}'";

if(sql_query($sql)){
	alert("수정되었습니다.");
}else{
	alert("수정오류입니다.");
}

?>