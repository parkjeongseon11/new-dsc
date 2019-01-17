<?php
	include_once("../common.php");
	if(!$is_admin){
		alert("권한이 없습니다.");
	}
	$mb_no=$_POST['mb_no'];
    $mb_addr1 = $_POST['mb_addr1'];
    $mb_addr2 = $_POST['mb_addr2'];
    $mb_addr3 = $_POST['mb_addr3'];
    $mb_10=$_POST['mb_10'];
	$mb_name=$_POST['mb_name'];
	$mb_password=$_POST['mb_password'];
	$mb_email=$_POST['mb_email'];
	$mb_hp=hyphen_hp_number($_POST['mb_hp']);
	$mb_point=$_POST['mb_point'];
	if($mb_password){
		$mb_password_sql=", `mb_password`=password('".$mb_password."')";
	}
	$sql="update `g5_member` set `mb_name`='{$mb_name}',`mb_email`='{$mb_email}',`mb_addr1`='{$mb_addr1}',`mb_addr2`='{$mb_addr2}',`mb_addr3`='{$mb_addr3}',`mb_hp`='{$mb_hp}',`mb_point`='{$mb_point}',`mb_10`='{$mb_10}'   {$mb_password_sql} where `mb_no`='{$mb_no}'";
	sql_query($sql);
	alert("수정 되었습니다.");