<?php
	include_once("../common.php");
	$p=true;
	include_once(G5_PATH."/admin/head.php");
	if(!$wr_id){
		alert("잘못된 정보입니다.");
	}
	if($bo_table){
		$table = "g5_write_".$bo_table;
	}
	$view=sql_fetch("select * from `{$table}` where wr_id = ".$wr_id);
	switch($bo_table){
		case "notice":
			$subject = "공지사항";
			break;
		case "review":
			$subject = "구매후기";
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
	$cmt = sql_fetch("select * from `{$table}` where wr_parent = '{$wr_id}' and wr_is_comment = 1 and mb_id = 'admin'");
?>
<!-- 본문 start -->
<div id="wrap">
	<section>
		<header id="admin-title">
			<h1><?php echo $subject;?></h1>
			<hr />
		</header>
		<article>
			<form action="<?php echo G5_URL."/admin/center_update.php"; ?>" method="post" enctype="multipart/form-data">
				<div class="adm-table02">
					<table>			
						<tr>
							<th>제목</th>
							<td><?php echo $view['wr_subject']; ?></td>
							<th>조회수</th>
							<td><?php echo $view['wr_hit']; ?></td>
						</tr>
						<?php if($bo_table=="review" || $bo_table=="qna"){?>
						<tr>
							<th>분류</th>
							<td colspan="3"><?php echo $view["ca_name"]?></td>
						</tr>
						<?php }?>
					    <tr>
							<th>작성자</th>
							<td><?php echo $view['wr_name']; ?></td>
							<th>작성일</th>
							<td><?php echo $view['wr_datetime']; ?></td>
						</tr>
						
					    <tr>
							<th>내용</th>
							<td colspan="3"><?php echo $view['wr_content']; ?></td>
						</tr>	
						<?php if($bo_table=="faq"){?>
						 <tr>
							<th>답변</th>
							<td colspan="3"><?php echo ($view['wr_1'])?$view["wr_1"]:"미답변"; ?></td>
						</tr>
						<?php }?>
						<?php if($bo_table=="questions"|| $bo_table=="qna"){?>
						 <tr>
							<th>답변</th>
							<td colspan="3"><?php echo ($cmt['wr_content'])?$cmt["wr_content"]:"미답변"; ?></td>
						</tr>
						<?php }?>
					</table>
				</div>
				<div class="text-center mt20" style="margin-bottom:20px;">
					<a href="<?php echo G5_URL."/admin/board_write.php?wr_id=".$wr_id."&page=".$page."&bo_table=".$bo_table; ?>" class="adm-btn01">수정하기</a>
					<?php if($bo_table=="questions" || $bo_table=="qna"){?>
						<?php if($cmt["wr_content"]){?>
							<a href="<?php echo G5_URL."/admin/board_comment_write.php?c_id=".$cmt["wr_id"]."&wr_id=".$wr_id."&page=".$page."&bo_table=".$bo_table; ?>" class="adm-btn01">답변수정</a>
						<?php }else{?>
							<a href="<?php echo G5_URL."/admin/board_comment_write.php?wr_id=".$wr_id."&page=".$page."&bo_table=".$bo_table; ?>" class="adm-btn01">답변하기</a>
						<?php }?>
					<?php }?>
					<?php if($is_admin){ ?><a href="<?php echo G5_URL."/admin/board_list.php?page=".$page."&bo_table=".$bo_table; ?>" class="adm-btn01">목록으로</a><?php } ?>
				</div>
			</form>
		</article>
	</section>
</div>
<?php
	include_once(G5_PATH."/admin/tail.php");
?>
