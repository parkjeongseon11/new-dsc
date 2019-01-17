<?php 
include_once("../common.php");

$id=$_POST['id'];
$trainer=sql_fetch("select * from `dsc_slide` where id='".$id."'");
if(!$is_admin && $trainer['mb_id']!=$member['mb_id']){
	alert("권한이 없습니다.");
}

$link = $_REQUEST["link"];
$type = $_REQUEST["type"];

if($type=="video"){
	sql_query("update `dsc_slide_main` set link = '{$link}' where id = 1");
	alert("수정하였습니다.");
}else if($type=="image"){
	$page=$_REQUEST['page'];	

	$dir=G5_DATA_PATH."/slide";
	@mkdir($dir, G5_DIR_PERMISSION);
	@chmod($dir, G5_DIR_PERMISSION);
	$filename1=time()."_slide_main_photo.jpg";	
	$path1=$dir."/".$filename1;
	
	if($_FILES['photo']['tmp_name']){
		image_resize_update($_FILES['photo']['tmp_name'],$_FILES['photo']['name'], $path1, 1900);
		$photo=$filename1;
		$photo_sql="`photo`='".$filename1."'";
		@unlink($dir."/".$trainer['photo']);
	}
	
	if($id){
		sql_query("update `dsc_slide_main` set {$photo_sql} where `id`='{$id}';");
	}else{
		sql_query("insert into `dsc_slide_main` (`photo`) values('{$photo}');");
	}
//    print_r("insert into `dsc_slide_main` (`photo`) values('{$photo}');");
	alert('저장되었습니다.',G5_URL."/admin/slide_main.php?page=".$page);
}