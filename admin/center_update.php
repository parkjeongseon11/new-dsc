<?php
	include_once("../common.php");
	$id=$_POST['id'];
	$trainer=sql_fetch("select * from `rutilo_center` where id='".$id."'");
	if(!$is_admin && $trainer['mb_id']!=$member['mb_id']){
		alert("권한이 없습니다.");
	}
	$page=$_POST['page'];
	$name=$_POST['name'];
    $addr=$_POST['addr'];
    $addr2=$_POST['addr2'];
	$addr3=$_POST['addr3'];
    $tel=$_POST['tel'];

	$lat=$_POST["lat"];
	$lng=$_POST["lng"];

    /*if($_POST["jibun"]){
		$string = str_replace (" ", "+", urlencode($_POST['jibun']));
		$details_url = "https://maps.googleapis.com/maps/api/geocode/json?address=".$string."&sensor=false&key=AIzaSyD-KJPVwwVsaitTZOw4BFjCzypSp6FvGoE";

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $details_url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$response = json_decode(curl_exec($ch), true);

		// If Status Code is ZERO_RESULTS, OVER_QUERY_LIMIT, REQUEST_DENIED or INVALID_REQUEST
		if ($response['status'] != 'OK') {
			return null;
		}

		$geometry = $response['results'][0]['geometry'];
		$longitude = $geometry['location']['lng'];
		$latitude = $geometry['location']['lat'];

		$array = array(
			'latitude' => $geometry['location']['lat'],
			'longitude' => $geometry['location']['lng'],
			'location_type' => $geometry['location_type'],
		);
		$geocodeU = " , `lat`='{$array['latitude']}',`lng`='{$array['longitude']}' ";
	}*/
    
	$dir=G5_DATA_PATH."/center";
	@mkdir($dir, G5_DIR_PERMISSION);
	@chmod($dir, G5_DIR_PERMISSION);
	$filename1=time()."_center_photo.jpg";	
	$path1=$dir."/".$filename1;
	
	if($_FILES['photo']['tmp_name']){
		image_resize_update($_FILES['photo']['tmp_name'],$_FILES['photo']['name'], $path1, 1100);
		$photo=$filename1;
		$photo_sql=",`photo`='".$filename1."'";
		@unlink($dir."/".$trainer['photo']);
	}

	if($is_admin){
		$admin_sql=",`mb_id`='{$mb_id}' ,`show`='{$show}'";
	}
	if($id){
		sql_query("update `rutilo_center` set `name`='{$name}',`zipcode`='{$addr}',`addr`='{$addr2}',`addr2`='{$addr3}' {$geocodeU} ,`tel`='{$tel}'{$photo_sql} where `id`='{$id}';");
	}else{
		sql_query("insert into `rutilo_center` (`name`,`zipcode`,`addr`,`addr2`,`lat`,`lng`,`photo`,`tel`) values('{$name}','{$addr}','{$addr2}','{$addr3}','{$array['latitude']}','{$array['longitude']}','{$photo}','{$tel}');");
	}
	alert('저장되었습니다.',G5_URL."/admin/center_list.php?page=".$page);