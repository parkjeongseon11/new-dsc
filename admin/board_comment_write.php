<?php 
include_once("../common.php");
include_once(G5_PATH."/admin/head.php");
if($wr_id){
	$w = "c";
}else{
	$w = "";
}

if($c_id){
	$w = "cu";
}
if($bo_table){
	$table = "g5_write_".$bo_table;
	set_session('ss_bo_table',$bo_table);
	set_session('ss_wr_id',$wr_id);
}

$cmt = sql_fetch("select * from `{$table}` where wr_id = {$c_id}");

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
			<form action="<?php echo G5_BBS_URL."/write_comment_update.php"; ?>" method="post" enctype="multipart/form-data" >
			<input type="hidden" name="w" value="<?php echo $w ?>" id="w">
			<input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
			<input type="hidden" name="wr_id" value="<?php echo $wr_id ?>">
			<input type="hidden" name="comment_id" value="<?php echo $c_id ?>" id="comment_id">
			<input type="hidden" name="sca" value="<?php echo $sca ?>">
			<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
			<input type="hidden" name="stx" value="<?php echo $stx ?>">
			<input type="hidden" name="spt" value="<?php echo $spt ?>">
			<input type="hidden" name="page" value="<?php echo $page ?>">
			<input type="hidden" name="is_good" value="">
			<input type="hidden" name="chk" value="1" />
			<input type="hidden" name="mb_id" value="<?php echo $member['mb_id']; ?>"id="mb_id" class="input01" size="50" maxlength="20">
				<div class="adm-table02">
					<table>			
					    <tr>
							<th>작성자</th>
							<td><input type="text" name="wr_name" id="wr_name" required class="adm-input01 grid_100" value="<?php echo ($cmt['wr_name'])?$cmt["wr_name"]:$member["mb_name"]; ?>" ></td>
						</tr>			
					    <tr>
							<th>답변내용</th>
							<td colspan="3"><textarea name="wr_content" id="wr_content" cols="30" rows="10" required class="adm-input01 grid_100"><?php echo $cmt['wr_content']; ?><br><br>제품/배송/교환/반품문의 : 1577-6074 / 점심 12:00~13:00 / 평일 09:00~17:00 / ※ 공휴일 제외  </textarea></td>
						</tr>	
					</table>
					<?php if($bo_table=="questions"){?>

					<?php }?>
				</div>
				<div class="text-center mt20" style="margin-bottom:20px;">
					<?php if($c_id){?>
					<input type="submit" value="수정하기" class="adm-btn01" onclick="return submitContents(this.form);" />
					<?php }else{?>
					<input type="submit" value="등록하기" class="adm-btn01" onclick="return submitContents(this.form);"/>
					<?php }?>
					<?php if($is_admin){ ?><a href="<?php echo G5_URL."/admin/board_list.php?page=".$page."&bo_table=".$bo_table; ?>" class="adm-btn01">목록으로</a><?php } ?>
				</div>
			</form>
		</article>
	</section>
</div>
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
<?php
include_once(G5_PATH."/admin/tail.php");