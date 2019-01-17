<?php
	include_once("../common.php");
	include_once(G5_PATH."/admin/head.php");
	$total=sql_fetch("select count(*) as cnt from `rutilo_warranty`");
	if(!$page)
		$page=1;
	$total=$total['cnt'];
	$rows=10;
	$start=($page-1)*$rows;
	$total_page=ceil($total/$rows);
	$sql="select * from `rutilo_warranty` order by `id` desc limit {$start},{$rows}";
	$query=sql_query($sql);
	$j=0;
	while($data=sql_fetch_array($query)){
		$list[$j]=$data;
		$list[$j]['num']=$total-($start)-$j;
		$j++;
	}
?>
<!-- 본문 start -->
<div id="wrap">
	<section>
		<header id="admin-title">
			<h1>전자보증서</h1>
			<hr />
		</header>
		<article>
			<div class="adm-table01">
				<table>
					<thead>
						<tr>
							<th class="md_none">번호</th>							
							<th>시공점</th>							
                            <th>차종</th>
                            <th>시공서비스</th>
                            <th>시공점 연락처</th>
							<th>상태</th>
							<th>관리</th>
						</tr>
					</thead>
					<tbody>
					<?php
						for($i=0;$i<count($list);$i++){
							$status = "";
							switch($list[$i]["status"]){
								case "0":
									$status = "접수";
									break;
								case "1":
									$status = "승인";
									break;
								case "2":
									$status = "취소";
									break;
							}
							$program = explode(",",$list[$i]['program']);
					?>
						<tr>
							<td class="md_none" onclick="location.href='<?php echo G5_URL."/admin/warranty_view.php?id=".$list[$i]['id']."&page=".$page; ?>'"><?php echo $list[$i]['num']; ?></td>
							
							<td onclick="location.href='<?php echo G5_URL."/admin/warranty_view.php?id=".$list[$i]['id']."&page=".$page; ?>'"><?php echo $list[$i]['center_name']; ?></td>
                            <td onclick="location.href='<?php echo G5_URL."/admin/warranty_view.php?id=".$list[$i]['id']."&page=".$page; ?>'"><?php echo $list[$i]['car']; ?></td>
                            <td onclick="location.href='<?php echo G5_URL."/admin/warranty_view.php?id=".$list[$i]['id']."&page=".$page; ?>'"><?php for($j=0;$j<count($program);$j++){ if($j+1==count($program)){echo "G".$program[$j];}else{echo "G".$program[$j].", ";} } ?></td>
							<td onclick="location.href='<?php echo G5_URL."/admin/warranty_view.php?id=".$list[$i]['id']."&page=".$page; ?>'"><?php echo $list[$i]['manager']; ?></td>
							<td onclick="location.href='<?php echo G5_URL."/admin/warranty_view.php?id=".$list[$i]['id']."&page=".$page; ?>'"><?php echo $status; ?></td>
							<td><a href="<?php echo G5_URL."/admin/warranty_status_update.php?id=".$list[$i]['id']."&page=".$page."&status=1"; ?>" class="btn01 btn" style="padding:5px 10px;">승인</a> <a href="<?php echo G5_URL."/admin/warranty_status_update.php?id=".$list[$i]['id']."&page=".$page."&status=2"; ?>" class="btn01 btn" style="padding:5px 10px;">취소</a> <a href="<?php echo G5_URL."/admin/warranty_delete.php?id=".$list[$i]['id']."&page=".$page; ?>" class="btn01 btn" style="padding:5px 10px;">삭제</a></td>
						</tr>
					<?php
						}
						if(count($list)==0){
					?>
						<tr>
							<td colspan="6" class="text-center" style="padding:50px 0;">등록된 전자보증서 목록이 없습니다.</td>
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
					<li class="prev"><a href="<?php echo G5_URL."/admin/warranty_list.php?page=".($page-1); ?>">&lt;</a></li>
				<?php } ?>
				<?php for($i=$start_page;$i<=$end_page;$i++){ ?>
					<li class="<?php echo $page==$i?"active":""; ?>"><a href="<?php echo G5_URL."/admin/warranty_list.php?page=".$i; ?>"><?php echo $i; ?></a></li>
				<?php } ?>
				<?php if($page<$total_page){?>
					<li class="next"><a href="<?php echo G5_URL."/admin/warranty_list.php?page=".($page+1); ?>">&gt;</a></li>
				<?php } ?>
				</ul>
			</div>
			<?php
			}
			?>
			<!-- <div class="text-right mt20">
				<a href="<?php echo G5_URL."/admin/trainer_write.php"; ?>" class="adm-btn01">추가</a>
			</div> -->
		</article>
	</section>
</div>
<script type="text/javascript">
function fnOpen(id,page){
	window.open(g5_url+'/admin/warranty_print.php?id='+id+'&page='+page, '_blank',"width=833px,height=1150,top=0,scrollbars=yes,menubar=no");
}
</script>
<?php
	include_once(G5_PATH."/admin/tail.php");
?>
