<?php
	include_once("../common.php");
	$id=$_POST['id'];
	$model=sql_fetch("select * from `rutilo_product` where id='".$id."'");
	if(!$is_admin){
		alert("권한이 없습니다.");
	}
	$page=$_POST['page'];
    $code=$_POST['code'];
	$name=$_POST['name'];
    $price=$_POST['price'];
    $type=$_POST['type'];
    $imglink=$_POST['imglink'];
    $info=$_POST['info'];
    $photolink=$_POST['photolink'];
	$content=nl2br($_POST['content']);
	$sub_content=nl2br($_POST['sub_content']);
    $msds=nl2br($_POST['msds']);
    $volume = $_POST['volume'];
    $components = $_POST['components'];
	$dir=G5_DATA_PATH."/model";
	@mkdir($dir, G5_DIR_PERMISSION);
	@chmod($dir, G5_DIR_PERMISSION);
	$filename1=time()."_model.jpg";
    $filename2=time()."_content.jpg";
    $filename3=time()."_msds.jpg";
    $filename4=time()."_info.jpg";
	$path1=$dir."/".$filename1;
    $path2=$dir."/".$filename2;
    $path3=$dir."/".$filename3;
    $path4=$dir."/".$filename4;

	/*if($_FILES['photo']['tmp_name']){
		image_resize_update($_FILES['photo']['tmp_name'],$_FILES['photo']['name'], $path1, 1100);
		$photo=$filename1;
		$photo_sql=",`photo`='".$filename1."'";
		if($id){
			@unlink($dir."/".$model['photo']);
		}
	}
	if($_FILES['content1']['tmp_name']){
		image_resize_update($_FILES['content1']['tmp_name'],$_FILES['content1']['name'], $path2, 1100);
		$content1=$filename2;
		$content1_sql=",`content1`='".$filename2."'";
		if($id){
			@unlink($dir."/".$model['content1']);
		}
	}*/
	if($_FILES['msdsImg']['tmp_name']){
		image_resize_update($_FILES['msdsImg']['tmp_name'],$_FILES['msdsImg']['name'], $path3, 1100);
		$msdsImg=$filename3;
		$msdsImg_sql=",`msdsImg`='".$filename3."'";
		if($id){
			@unlink($dir."/".$model['msdsImg']);
		}
	}
	if($_FILES['infoImg']['tmp_name']){
		image_resize_update($_FILES['infoImg']['tmp_name'],$_FILES['infoImg']['name'], $path4, 1100);
		$infoImg=$filename4;
		$infoImg_sql=",`infoImg`='".$filename4."'";
		if($id){
			@unlink($dir."/".$model['infoImg']);
		}
	}
    
    $test =$_POST['test'];          
    for($m=0;$m<count($_FILES["image1"]["name"]);$m++){        
        $etc3 = $_FILES["image1"]["name"][$m];
        $ext = array_pop(explode(".",$etc3));
        $ext = strtolower($ext); 
        print_r($etc3);
        if($id){
            $str=explode(",",$model['photo']);  
            for($l=0;$l<count($str);$l++){
                if($test[$m]==$str[$l]){
                    $filename[$m] = $test[$m];                  
                }
            }
            if($filename[$m]){
            $filename1 = $filename[$m];
            }else{
                $filename1 = time() . "_model".$m."." . $ext;     
                @unlink($dir."/".$str[$m]);
            }
        }else{            
            $filename1 = time() . "_model".$m."." . $ext;     
        }
        $path1 = $dir . "/" . $filename1;
        if ($_FILES['image1']['tmp_name'][$m]) {
            move_uploaded_file($_FILES['image1']['tmp_name'][$m], $path1);		
        }
        if($m==0){
            $files1 .= $filename1;
        }else{
            $files1 .= ",".$filename1;
        }
        $photo_sql = ",`photo` = '{$files1}'";       
        
    }

    $test1 = $_POST['test2'];  
    for($i=0;$i<count($_FILES["mage"]["name"]);$i++){        
        $etc4 = $_FILES["mage"]["name"][$i];
        $ext1 = array_pop(explode(".",$etc4));
        $ext1 = strtolower($ext1); 
        print_r($etc4);
        if($id){
     $str2=explode(",",$model['content1']);  
            for($k=0;$k<count($str2);$k++){
                if($test1[$i]==$str2[$k]){
                    $filename5[$i] = $test1[$i];                  
                }
            }
            if($filename5[$i]){
            $filename6 = $filename5[$i];
            }else{
                $filename6 = time() . "_content".$i."." . $ext1;     
                @unlink($dir."/".$str2[$i]);
            }
        }else{            
           $filename6 = time() . "_content".$i."." . $ext1;     
        }
        $path2 = $dir . "/" . $filename6;
        if ($_FILES['mage']['tmp_name'][$i]) {
            move_uploaded_file($_FILES['mage']['tmp_name'][$i], $path2);		
        }
        if($i==0){
            $files2 .= $filename6;
        }else{
            $files2 .= ",".$filename6;
        }        
        $content1_sql = ",`content1` = '{$files2}'";               
        
    }

    
	if($id){        
		sql_query("update `rutilo_product` set `code`='{$code}',`name`='{$name}',`price`='{$price}',`content`='{$content}',`msds`='{$msds}', `sub_content`='{$sub_content}' {$msdsImg_sql},`info`='{$info}' {$infoImg_sql} {$content1_sql} {$photo_sql},`type`='{$type}',`volume`='{$volume}',`components`='{$components}',`imglink`='{$imglink}',`photolink`='{$photolink}' where `id`='{$id}'");
	}else{
        
		sql_query("insert into `rutilo_product` (`photo`,`code`,`name`,`price`,`content`,`content1`,`msds`,`msdsImg`,`info`,`infoImg`,`type`,`volume`,`components`,`imglink`,`photolink`,`sub_content`) values('{$files1}','{$code}','{$name}','{$price}','{$content}','{$files2}','{$msds}','{$msdsImg}','{$info}','{$infoImg}','{$type}','{$volume}','{$components}','{$imglink}','{$photolink}','{$sub_content}')");
	}
	alert('저장되었습니다.',G5_URL."/admin/model_list.php?page=".$page);