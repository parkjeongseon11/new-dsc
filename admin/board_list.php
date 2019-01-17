<?php
	include_once("../common.php");
	include_once(G5_PATH."/admin/head.php");
	$token = get_session('ss_delete_token');
	if($bo_table){
		$table = "g5_write_".$bo_table;
	}
	
	$total=sql_fetch("select count(*) as cnt from `{$table}`");
	if(!$page)
		$page=1;
	$total=$total['cnt'];
	$rows=10;
	$start=($page-1)*$rows;
	$total_page=ceil($total/$rows);
	$sql="select * from `{$table}` where `wr_is_comment` = 0 limit {$start},{$rows}";
	$query=sql_query($sql);
	$j=0;
	while($data=sql_fetch_array($query)){
		$list[$j]=$data;
		$list[$j]['num']=$total-($start)-$j;
		$j++;
	}
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
	}
?>
<!-- 본문 start -->
<div id="wrap">
	<section>
		<header id="admin-title">
			<h1><?php echo $subject?></h1>
			<hr />
		</header>
		<article>
			<div class="adm-table01">
				<table>
					<thead>
						<tr>
							<th class="md_none">번호</th>							
							<th>제목</th>							
                            <th>작성자</th>
							<th>등록일</th>
							<th><?php if($bo_table=="questions"){?>답변상태<?php }else{?>조회수<?php }?></th>
							<th>관리</th>
						</tr>
					</thead>
					<tbody>
					<?php
						for($i=0;$i<count($list);$i++){
							if($list[$i]["wr_comment"]>0){
								$status = "답변완료";
							}else{
								$status = "미답변";
							}
					?>
						<tr>
							<td class="md_none" onclick="location.href='<?php echo G5_URL."/admin/board_view.php?wr_id=".$list[$i]['wr_id']."&page=".$page."&bo_table=".$bo_table; ?>'"><?php echo $list[$i]['num']; ?></td>						
							<td onclick="location.href='<?php echo G5_URL."/admin/board_view.php?wr_id=".$list[$i]['wr_id']."&page=".$page."&bo_table=".$bo_table; ?>'"><?php echo $list[$i]['wr_subject']; ?></td>
                            <td onclick="location.href='<?php echo G5_URL."/admin/board_view.php?wr_id=".$list[$i]['wr_id']."&page=".$page."&bo_table=".$bo_table; ?>'"><?php echo $list[$i]["wr_name"]; ?></td>                           
							<td onclick="location.href='<?php echo G5_URL."/admin/board_view.php?wr_id=".$list[$i]['wr_id']."&page=".$page."&bo_table=".$bo_table; ?>'"><?php echo $list[$i]["wr_datetime"]; ?></td> 
							<?php if($bo_table!="questions"){?>
							<td onclick="location.href='<?php echo G5_URL."/admin/board_view.php?wr_id=".$list[$i]['wr_id']."&page=".$page."&bo_table=".$bo_table; ?>'"><?php echo $list[$i]["wr_hit"]; ?></td> 
							<?php }else{?>
							<td onclick="location.href='<?php echo G5_URL."/admin/board_view.php?wr_id=".$list[$i]['wr_id']."&page=".$page."&bo_table=".$bo_table; ?>'"><?php echo $status; ?></td> 
							<?php }?>
							<td><a href="<?php echo G5_URL."/admin/board_write.php?wr_id=".$list[$i]['wr_id']."&page=".$page."&bo_table=".$bo_table; ?>" class="btn01 btn" style="padding:5px 10px;">수정</a> <?php if($bo_table=="questions" && $list[$i]["wr_comment"]==0){?><a href="<?php echo G5_URL."/admin/board_comment_write.php?wr_id=".$list[$i]['wr_id']."&page=".$page."&bo_table=".$bo_table; ?>" class="btn01 btn" style="padding:5px 10px;">답변</a><?php }?> <a href="<?php echo G5_BBS_URL."/delete.php?chk=1&wr_id=".$list[$i]['wr_id']."&page=".$page."&bo_table=".$bo_table."&token=".$token; ?>" class="btn01 btn" style="padding:5px 10px;">삭제</a></td>
						</tr>
					<?php
						}
						if(count($list)==0){
					?>
						<tr>
							<td colspan="6" class="text-center" style="padding:50px 0;">등록된 게시물이 없습니다.</td>
						</tr>
					<?php
						}
					?>
					</tbody>
				</table>
			</div>
			<?php
				if($total_page>1){
					$start_page=1;
					$end_page=$total_page;
					if($total_page>5){
						if($total_page<($page+2)){
							$start_page=$total_page-4;
							$end_page=$total_page;
						}else if($page>3){
							$start_page=$page-2;
							$end_page=$page+2;
						}else{
							$start_page=1;
							$end_page=5;
						}
					}
			?>
			<div class="num_list01">
				<ul>
				<?php if($page!=1){?>
					<li class="prev"><a href="<?php echo G5_URL."/admin/board_list.php?bo_table=".$bo_table."&page=".($page-1); ?>">&lt;</a></li>
				<?php } ?>
				<?php for($i=$start_page;$i<=$end_page;$i++){ ?>
					<li class="<?php echo $page==$i?"active":""; ?>"><a href="<?php echo G5_URL."/admin/board_list.php?bo_table=".$bo_table."&page=".$i; ?>"><?php echo $i; ?></a></li>
				<?php } ?>
				<?php if($page<$total_page){?>
					<li class="next"><a href="<?php echo G5_URL."/admin/board_list.php?bo_table=".$bo_table."&page=".($page+1); ?>">&gt;</a></li>
				<?php } ?>
				</ul>
			</div>
			<?php
			}
			?>
			<div class="text-right mt20">
				<a href="<?php echo G5_URL."/admin/board_write.php?bo_table=".$bo_table; ?>" class="adm-btn01">글쓰기</a>
			</div>
		</article>
	</section>
</div>
<?php
	include_once(G5_PATH."/admin/tail.php");
?>
