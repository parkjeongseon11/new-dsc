<?php
	include_once("../common.php");
	include_once(G5_PATH."/admin/head.php");
	if($sel!="" && $search!=""){
		$where="and {$sel} like '%{$search}%' ";
	}

	$total=sql_fetch("select count(*) as cnt from `g5_member` where  mb_1 != 1 {$where} order by `mb_no` desc");
	if(!$page)
		$page=1;
	$total=$total['cnt'];
	$rows=5;
	$start=($page-1)*$rows;
	$total_page=ceil($total/$rows);
    
    $totalS=sql_fetch("select count(*) as cnt from `g5_member` where mb_1 = 1 {$where} order by `mb_no` desc");
	if(!$pageS)
		$pageS=1;
	$totalS=$totalS['cnt'];
	$rowS=5;
	$startS=($pageS-1)*$rowS;
	$total_pageS=ceil($totalS/$rowS);

	$sql="select a.*,b.st_name from g5_member as a left join store_info as b on a.mb_id=b.mb_id where mb_1 != 1 {$where} order by `mb_no` desc limit {$start},{$rows}";
	$query=sql_query($sql);
	$j=0;
	while($data=sql_fetch_array($query)){
		$list[$j]=$data;
		$list[$j]['num']=$total-($start)-$j;
		$j++;
	}

	$sqlS="select a.*,b.st_name from g5_member as a left join store_info as b on a.mb_id=b.mb_id where  mb_1 = 1 {$where} order by `mb_no` desc limit {$startS},{$rowS}";
	$queryS=sql_query($sqlS);
	$k=0;
	while($dataS=sql_fetch_array($queryS)){
		$listS[$k]=$dataS;
		$listS[$k]['num']=$totalS-($startS)-$k;
		$k++;
	}
?>
<style type="text/css">
    .grid_15{width:15% !important;display:inline-block;float:left;box-sizing:border-box;}
	.grid_25{width:25% !important;display:inline-block;float:left;box-sizing:border-box;}
	.grid_60{width:60% !important;display:inline-block;float:left;box-sizing:border-box;}	
	.lh30{line-height:30px !important;}
</style>
<!-- 본문 start -->
<div id="wrap">
	<section>
		<header id="admin-title">
			<h1>회원관리</h1>
			<hr />
		</header>
		<article>
			<div class="grid_100" style="margin-bottom:30px">
				<form action="" method="get">
					<div class="grid_25">
						<select name="sel" id="sel" class="grid_100 adm-input01">
							<option value="a.mb_id" <?php echo $sel=="a.mb_id"?"selected":""; ?>>아이디</option>
							<option value="a.mb_name" <?php echo $sel=="a.mb_name"?"selected":""; ?>>이름</option>
							<option value="a.mb_hp" <?php echo $sel=="a.mb_hp"?"selected":""; ?>>휴대폰번호</option>							
						</select>
					</div>
					<div class="grid_60 pl10"><input type="text" name="search" id="search" class="grid_100 adm-input01" value="<?php echo $search; ?>" /></div>
					<div class="grid_15 pl10"><input type="submit" class="grid_100 color_white lh30 btn" style="background:#666;border:none;" value="검색" /></div>
				</form>
			</div>
			<div class="adm-table01">
				<table>
					<thead>
						<tr>
							<th class="md_none">번호</th>
							<th>아이디</th>
							<th>이름</th>
							<th class="md_none">이메일</th>
							<th>휴대폰번호</th>
							<th>포인트</th>
							<th class="md_none">가입일</th>
							<th class="md_none">최종접속일</th>
							<th class="md_none">구분</th>
							<th>관리</th>
						</tr>
					</thead>
					<tbody>
					<?php
						for($i=0;$i<count($list);$i++){
					?>
						<tr>
							<td class="md_none" onclick="location.href='<?php echo G5_URL."/admin/member_view.php?mb_no=".$list[$i]['mb_no']; ?>';"><?php echo $list[$i]['num']; ?></td>
							<td onclick="location.href='<?php echo G5_URL."/admin/member_view.php?mb_no=".$list[$i]['mb_no']; ?>';"><?php echo $list[$i]['mb_id']; ?></td>
							<td onclick="location.href='<?php echo G5_URL."/admin/member_view.php?mb_no=".$list[$i]['mb_no']; ?>';"><?php echo $list[$i]['mb_name']; ?></td>
							<td class="md_none" onclick="location.href='<?php echo G5_URL."/admin/member_view.php?mb_no=".$list[$i]['mb_no']; ?>';"><?php echo $list[$i]['mb_email']; ?></td>
							<td onclick="location.href='<?php echo G5_URL."/admin/member_view.php?mb_no=".$list[$i]['mb_no']; ?>';"><?php echo $list[$i]['mb_hp']; ?></td>
							<td onclick="location.href='<?php echo G5_URL."/admin/member_view.php?mb_no=".$list[$i]['mb_no']; ?>';"><?php echo $list[$i]['mb_point']?number_format($list[$i]
                            ['mb_point']):0; ?></td>
							<td class="md_none" onclick="location.href='<?php echo G5_URL."/admin/member_view.php?mb_no=".$list[$i]['mb_no']; ?>';"><?php echo date("Y.m.d H:i",strtotime($list[$i]['mb_datetime'])); ?></td>
							<td class="md_none" onclick="location.href='<?php echo G5_URL."/admin/member_view.php?mb_no=".$list[$i]['mb_no']; ?>';"><?php echo date("Y.m.d H:i",strtotime($list[$i]['mb_today_login'])); ?></td>
							<td onclick="location.href='<?php echo G5_URL."/admin/member_view.php?mb_no=".$list[$i]['mb_no']; ?>';"><?php if($list[$i]['st_name']){echo "사업자";}else if($list[$i]["mb_1"]==1){echo "가맹점";}else{echo "일반회원";}  ?></td>
							<td>
								<a href="<?php echo G5_URL."/admin/member_stop.php?mb_no=".$list[$i]['mb_no']; ?>" class="btn01 btn" style="padding:5px 10px;"><?php echo $list[$i]['mb_intercept_date']||$list[$i]['mb_leave_date']?"활성":"정지"; ?></a>
								<a href="javascript:del_confirm('<?php echo G5_URL."/admin/member_delete.php?mb_no=".$list[$i]['mb_no']; ?>');" class="btn01 btn" style="padding:5px 10px;">삭제</a>
							</td>
						</tr>
					<?php
						}
						if(count($list)==0){
							echo "<tr><td colspan='9' class='text-center' style='padding:100px 0;'>목록이 없습니다</td></tr>";
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
            		<li class="prev"><a href="<?php echo G5_URL."/admin/member_list.php?page=".($page-1); ?>">&lt;</a></li>
            	<?php } ?>
            	<?php for($i=$start_page;$i<=$end_page;$i++){ ?>
            		<li class="<?php echo $page==$i?"active":""; ?>"><a href="<?php echo G5_URL."/admin/member_list.php?page=".$i; ?>"><?php echo $i; ?></a></li>
            	<?php } ?>
            	<?php if($page<$total_page){?>
            		<li class="next"><a href="<?php echo G5_URL."/admin/member_list.php?page=".($page+1); ?>">&gt;</a></li>
            	<?php } ?>
            	</ul>
			</div>
			<?php
			}
			?>
		</article>
	</section>
	
	<section>
		<header id="admin-title">
			<h1>가맹점신청목록</h1>
			<hr />
		</header>
		<article>		
			<div class="adm-table01">
				<table>
					<thead>
						<tr>
							<th class="md_none">번호</th>
							<th>아이디</th>
							<th>이름</th>
							<th class="md_none">이메일</th>
							<th>휴대폰번호</th>
							<th>포인트</th>
							<th class="md_none">가입일</th>
							<th class="md_none">최종접속일</th>
							<th class="md_none">상태</th>
							<th>관리</th>
						</tr>
					</thead>
					<tbody>
					<?php
						for($i=0;$i<count($listS);$i++){
					?>
						<tr>
							<td class="md_none" onclick="location.href='<?php echo G5_URL."/admin/member_view.php?mb_no=".$listS[$i]['mb_no']; ?>';"><?php echo $listS[$i]['num']; ?></td>
							<td onclick="location.href='<?php echo G5_URL."/admin/member_view.php?mb_no=".$listS[$i]['mb_no']; ?>';"><?php echo $listS[$i]['mb_id']; ?></td>
							<td onclick="location.href='<?php echo G5_URL."/admin/member_view.php?mb_no=".$listS[$i]['mb_no']; ?>';"><?php echo $listS[$i]['mb_name']; ?></td>
							<td class="md_none" onclick="location.href='<?php echo G5_URL."/admin/member_view.php?mb_no=".$listS[$i]['mb_no']; ?>';"><?php echo $listS[$i]['mb_email']; ?></td>
							<td onclick="location.href='<?php echo G5_URL."/admin/member_view.php?mb_no=".$listS[$i]['mb_no']; ?>';"><?php echo $listS[$i]['mb_hp']; ?></td>
							<td onclick="location.href='<?php echo G5_URL."/admin/member_view.php?mb_no=".$listS[$i]['mb_no']; ?>';"><?php echo $listS[$i]['mb_point']?number_format($listS[$i]
                            ['mb_point']):0; ?></td>
							<td class="md_none" onclick="location.href='<?php echo G5_URL."/admin/member_view.php?mb_no=".$listS[$i]['mb_no']; ?>';"><?php echo date("Y.m.d H:i",strtotime($listS[$i]['mb_datetime'])); ?></td>
							<td class="md_none" onclick="location.href='<?php echo G5_URL."/admin/member_view.php?mb_no=".$listS[$i]['mb_no']; ?>';"><?php echo date("Y.m.d H:i",strtotime($listS[$i]['mb_today_login'])); ?></td>
							<td onclick="location.href='<?php echo G5_URL."/admin/member_view.php?mb_no=".$listS[$i]['mb_no']; ?>';"><?php if($listS[$i]['mb_1']=='1'){echo "가맹신청";}else{echo "미신청";} ?></td>
							<td>
								<a href="<?php echo G5_URL."/admin/member_stop.php?mb_no=".$listS[$i]['mb_no']; ?>" class="btn01 btn" style="padding:5px 10px;"><?php echo $listS[$i]['mb_intercept_date']||$listS[$i]['mb_leave_date']?"활성":"정지"; ?></a>
								<a href="javascript:del_confirm('<?php echo G5_URL."/admin/member_delete.php?mb_no=".$listS[$i]['mb_no']; ?>');" class="btn01 btn" style="padding:5px 10px;">삭제</a>
							</td>
						</tr>
					<?php
						}
						if(count($listS)==0){
							echo "<tr><td colspan='9' class='text-center' style='padding:100px 0;'>목록이 없습니다</td></tr>";
						}
					?>
					</tbody>
				</table>
				<div class="text-right mt20">
                    <a href="<?php echo G5_URL."/admin/excel_member.php?sel=".$sel."&search=".$search; ?>" class="adm-btn01">엑셀저장</a>
<!--                    <a href="<?php echo G5_URL."/admin/member_write.php"; ?>" class="adm-btn01">추가하기</a>                    -->
                </div>	
             
			</div>
			<?php
				if($total_pageS>1){
					$start_pageS=1;
					$end_pageS=$total_pageS;
					if($total_pageS>5){
						if($total_pageS<($page+2)){
							$start_pageS=$total_pageS-4;
							$end_pageS=$total_pageS;
						}else if($pageS>3){
							$start_pageS=$page-2;
							$end_pageS=$page+2;
						}else{
							$start_pageS=1;
							$end_pageS=5;
						}
					}
			?>
			<div class="num_list01">
            	<ul>            
            	<?php if($pageS!=1){?>
            		<li class="prev"><a href="<?php echo G5_URL."/admin/member_list.php?pageS=".($pageS-1); ?>">&lt;</a></li>
            	<?php } ?>
            	<?php for($i=$start_pageS;$i<=$end_pageS;$i++){ ?>
            		<li class="<?php echo $pageS==$i?"active":""; ?>"><a href="<?php echo G5_URL."/admin/member_list.php?pageS=".$i; ?>"><?php echo $i; ?></a></li>
            	<?php } ?>
            	<?php if($pageS<$total_pageS){?>
            		<li class="next"><a href="<?php echo G5_URL."/admin/member_list.php?pageS=".($pageS+1); ?>">&gt;</a></li>
            	<?php } ?>
            	</ul>
			</div>
			<?php
			}
			?>
		</article>
	</section>
</div>
<script type="text/javascript">
	function del_confirm(url){
		if(confirm('삭제시 회원정보는 돌릴 수 없습니다.\n 삭제하시겠습니까?')){
			location.href=url;
		}else{
			return false;
		}
	}
</script>
<?php
	include_once(G5_PATH."/admin/tail.php");
?>
