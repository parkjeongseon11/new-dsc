<?php 
include_once("../common.php");
include_once(G5_PATH."/admin/head.php");
if($wr_id){
	$w = "u";
}else{
	$w = "";
}

if($bo_table){
	$table = "g5_write_".$bo_table;
	set_session('ss_bo_table',$bo_table);
	set_session('ss_wr_id',$wr_id);
}
$view=sql_fetch("select * from `{$table}` where wr_id = ".$wr_id);

switch($bo_table){
	case "notice":
		$subject = "공지사항";
		break;
	case "review":
		$subject = "구매후기";
		$sql = "select * from `rutilo_product` ";
		$res = sql_query($sql);
		while($row = sql_fetch_array($res)){
			$opt[] = $row;
		}
		break;
	case "questions":
			$subject = "1:1문의";
			break;
	case "faq":
		$subject = "FAQ";
		break;
	case "qna":
		$subject = "QnA";
		break;
}
?>
<style type="text/css">
	#wr_1{width: 100%;height: 180px;border: 2px solid #ddd;box-sizing: border-box;}
</style>
<div id="wrap">
	<section>
		<header id="admin-title">
			<h1><?php echo $subject;?></h1>
			<hr />
		</header>
		<article>
			<form action="<?php echo G5_BBS_URL."/write_update.php"; ?>" method="post" enctype="multipart/form-data">
			<input type="hidden" name="uid" value="<?php echo get_uniqid(); ?>">
			<input type="hidden" name="w" value="<?php echo $w ?>">
			<input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
			<input type="hidden" name="wr_id" value="<?php echo $wr_id ?>">
			<input type="hidden" name="sca" value="<?php echo $sca ?>">
			<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
			<input type="hidden" name="stx" value="<?php echo $stx ?>">
			<input type="hidden" name="spt" value="<?php echo $spt ?>">
			<input type="hidden" name="sst" value="<?php echo $sst ?>">
			<input type="hidden" name="sod" value="<?php echo $sod ?>">
			<input type="hidden" name="page" value="<?php echo $page ?>">    
			<input type="hidden" name="chk" value="1" />
			<input type="hidden" name="mb_id" value="<?php echo $member['mb_id']; ?>"id="mb_id" >
				<div class="adm-table02">
					<table>			
						<tr>
							<th>제목</th>
							<td><input type="text" name="wr_subject" id="wr_subject" required class="adm-input01 grid_100" value="<?php echo $view['wr_subject']; ?>" ></td>
						</tr>
						<?php if($bo_table=="review"){?>
						<tr>
							<th>제품</th>
							<td> 
								<select name="ca_name" id="ca_name" required class="adm-input01 grid_100">
									<option value="">선택하세요</option>
									<?php for($i=0;$i<count($opt);$i++){?>
									<option value="<?php echo $opt[$i]["name"]?>" <?php if($view["ca_name"]==$opt[$i]["name"]){?>selected<?php }?>><?php echo $opt[$i]["name"]?></option>
									<?php }?>
								</select>
							</td>
						</tr>
						<?php }?>
						<?php if($bo_table=="faq"){?>
						<tr>
							<th>문의분류</th>
							<td>
							<select name="ca_name" id="ca_name" required class="adm-input01 grid_100">
								<option value="">선택하세요</option>
								<option value="배송">배송</option>
								<option value="반품/교환">반품교환</option>
								<option value="오프라인">오프라인</option>
								<option value="결제">결제</option>
								<option value="마일리지">마일리지</option>
								<option value="회원정보">회원정보</option>
							</select>
						</td>
						</tr>
						<?php }?>
					    <tr>
							<th>작성자</th>
							<td><input type="text" name="wr_name" id="wr_name" required class="adm-input01 grid_100" value="<?php echo ($view['wr_name'])?$view["wr_name"]:$member["mb_name"]; ?>" ></td>
						</tr>			
					    <tr>
							<th>내용</th>
							<td colspan="3"><textarea name="wr_content" id="wr_content" cols="30" rows="10" required class="adm-input01 grid_100"><?php echo $view['wr_content']; ?></textarea></td>
						</tr>	
						<?php if($bo_table=="faq"){?>
						<tr>
							<th>답변</th>
							<td colspan="3"><textarea name="wr_1" id="wr_1" cols="30" rows="10" required class="adm-input01 grid_100"><?php echo $view['wr_1']; ?></textarea></td>
						</tr>
						<?php }?>
					</table>
					<?php if($bo_table=="questions"  || $bo_table=="qna"){?>

					<?php }?>
				</div>
				<div class="text-center mt20" style="margin-bottom:20px;">
					<?php if($wr_id){?>
					<input type="submit" value="수정하기" class="adm-btn01" <?php if($bo_table!="faq"){?>onclick="return submitContents(this.form);"<?php }?>/>
					<?php }else{?>
					<input type="submit" value="등록하기" class="adm-btn01" <?php if($bo_table!="faq"){?>onclick="return submitContents(this.form);"<?php }?>/>
					<?php }?>
					<?php if($is_admin){ ?><a href="<?php echo G5_URL."/admin/board_list.php?page=".$page."&bo_table=".$bo_table; ?>" class="adm-btn01">목록으로</a><?php } ?>
				</div>
			</form>
		</article>
	</section>
</div>
<?php if($bo_table!="faq"){?>
<script type="text/javascript" src="<?php echo G5_PLUGIN_URL?>/editor/smarteditor2/js/HuskyEZCreator.js" charset="utf-8"></script>
<script type="text/javascript">
var oEditors = [];
nhn.husky.EZCreator.createInIFrame({
    oAppRef: oEditors,
    elPlaceHolder: "wr_content",
    sSkinURI: g5_url+"/plugin/editor/smarteditor2/SmartEditor2Skin.html",
    fCreator: "createSEditor2"
});


function submitContents(elClickedObj) {
    // 에디터의 내용이 textarea에 적용된다.
    oEditors.getById["wr_content"].exec("UPDATE_CONTENTS_FIELD", []);
    // 에디터의 내용에 대한 값 검증은 이곳에서
    // document.getElementById("ir1").value를 이용해서 처리한다.
		
    try {
        elClickedObj.submit();
    } catch(e) {
	
	}
}
</script>
<?php }?>
<?php
include_once(G5_PATH."/admin/tail.php");