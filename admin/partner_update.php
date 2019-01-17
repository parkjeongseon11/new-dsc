<?php
	include_once("../common.php");
	$id=$_POST['id'];
	$partner=sql_fetch("select * from `franch_status` where id='".$id."'");
	if(!$is_admin && $partner['mb_id']!=$member['mb_id']){
		alert("권한이 없습니다.");
	}
	$page=$_POST['page'];
	$name=$_POST['name'];
    $title=$_POST['title'];
	$tel= hyphen_hp_number($_POST['tel']);
    $fax=hyphen_hp_number($_POST['fax']);
    $opening=$_POST['opening'];
    $etc=$_POST['etc'];
	$addr=$_POST['addr'];
    $addr2=$_POST['addr2'];
	$addr3=$_POST['addr3'];
	$lat=$_POST["lat"];
	$lng=$_POST["lng"];
		
	if($_POST["jibun"]){
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

		$longitude = $geometry['location']['lat'];
		$latitude = $geometry['location']['lng'];

		$array = array(
			'latitude' => $geometry['location']['lat'],
			'longitude' => $geometry['location']['lng'],
			'location_type' => $geometry['location_type'],
		);
		$geocodeU = " , `lat`='{$array['latitude']}',`lng`='{$array['longitude']}' ";
	} 

	$dir=G5_DATA_PATH."/partner";
	@mkdir($dir, G5_DIR_PERMISSION);
	@chmod($dir, G5_DIR_PERMISSION);
	$filename1=time()."_partner_banner.jpg";	
	$path1=$dir."/".$filename1;
	
	if($_FILES['banner']['tmp_name']){
		image_resize_update($_FILES['banner']['tmp_name'],$_FILES['banner']['name'], $path1, 1100);
		$banner=$filename1;
		$banner_sql=",`banner`='".$filename1."'";
		@unlink($dir."/".$partner['banner']);
	}
	
	if($is_admin){
		$admin_sql=",`mb_id`='{$mb_id}' ,`show`='{$show}'";
	}
	if($id){
		sql_query("update `franch_status` set `title`='{$title}',`name`='{$name}',`tel`='{$tel}',`fax`='{$fax}',`zipcode`='{$addr}',`addr`='{$addr2}',`addr2`='{$addr3}',`opening`='{$opening}',`etc`='{$etc}' ,`lat` = '{$lat}', `lng`= '{$lng}' {$banner_sql} where `id`='{$id}';");
	}else{
		sql_query("insert into `franch_status` (`title`,`name`,`tel`,`zipcode`,`addr`,`addr2`,`fax`,`opening`,`etc`,`photo`,`lat`,`lng`) values('{$title}','{$name}','{$tel}','{$addr}','{$addr2}','{$addr3}','{$fax}','{$opening}','{$etc}','{$banner}','{$lat}','{$lng}');");
	}
    
	alert('저장되었습니다.',G5_URL."/admin/partner_list.php?page=".$page);