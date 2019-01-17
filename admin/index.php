<?php
	include_once("../common.php");
	include_once(G5_PATH."/admin/head.php");
	$sql="select * from `g5_member` order by `mb_no` desc limit 0,5";
	$query=sql_query($sql);
	$j=0;
	while($data=sql_fetch_array($query)){
		$member_list[$j]=$data;
		$member_list[$j]['num']=$j+1;
		$j++;
	}
	$sql="select *,m.name as model,r.id as id from `rutilo_reserve` as r left join `rutilo_product` as m on r.model=m.id order by r.`id` desc limit 0,5";
	$query=sql_query($sql);
	$j=0;
	while($data=sql_fetch_array($query)){
		$reserve_list[$j]=$data;
		$reserve_list[$j]['num']=$j+1;
		$j++;
	}

	$sql="select * from `g5_write_review` where wr_is_comment = 0 order by wr_datetime desc limit 0, 5 ";
	$query=sql_query($sql);
	$j=0;
	while($data=sql_fetch_array($query)){
		$review[$j]=$data;
		$review[$j]['num']=$j+1;
		$j++;
	}

	$sql="select * from `rutilo_franchisee` order by datetime desc limit 0, 5 ";
	$query=sql_query($sql);
	$j=0;
	while($data=sql_fetch_array($query)){
		$frenchisee[$j]=$data;
		$frenchisee[$j]['num']=$j+1;
		$j++;
	}

	$sql="select * from `g5_write_questions`  where wr_is_comment = 0 order by wr_datetime desc limit 0, 5 ";
	$query=sql_query($sql);
	$j=0;
	while($data=sql_fetch_array($query)){
		$questions[$j]=$data;
		$questions[$j]['num']=$j+1;
		$j++;
	}

	$sql="select * from `rutilo_warranty` order by `id` desc limit 0,5";
	$query=sql_query($sql);
	$j=0;
	while($data=sql_fetch_array($query)){
		$warranty[$j]=$data;
		$warranty[$j]['num']=$j+1;
		$j++;
	}
?>
<!-- 본문 start -->
<div id="wrap">
	<section>
		<header id="admin-title">
			<h1>관리자페이지</h1>
			<hr />
		</header>
		<article>
			<h1 style="font-size:24px;margin-bottom:20px;font-weight:normal">주문관리 <a href="<?php echo G5_URL."/admin/reserve_list.php"; ?>" style="float:right;font-size:14px;vertical-align:bottom;margin-top:12px">더보기</a></h1>
			<div class="adm-table01 mb20">
				<table>
					<thead>
						<tr>
							<th>번호</th>
							<th class="md_none">일시</th>							
							<th class="md_none">제품이름</th>
							<th>주문자</th>
							<th>연락처</th>
							<th>배송주소</th>
						</tr>
					</thead>
					<tbody>
					<?php
						for($i=0;$i<count($reserve_list);$i++){
					?>
						<tr>
							<td class="md_none" onclick="location.href='<?php echo G5_URL."/admin/reserve_view.php?id=".$reserve_list[$i]['id']; ?>'"><?php echo $reserve_list[$i]['num']; ?></td>
							<td class="md_none" onclick="location.href='<?php echo G5_URL."/admin/reserve_view.php?id=".$reserve_list[$i]['id']; ?>'"><?php echo date("Y-m-d",strtotime($reserve_list[$i]['datetime'])); ?><br /><?php echo date("H:i:s",strtotime($reserve_list[$i]['datetime'])); ?></td>						
							<td class="md_none" onclick="location.href='<?php echo G5_URL."/admin/reserve_view.php?id=".$reserve_list[$i]['id']; ?>'"><?php echo $reserve_list[$i]['model']; if($count>0) {echo " 외 ".$count."개";} ?></td>
							<td onclick="location.href='<?php echo G5_URL."/admin/reserve_view.php?id=".$reserve_list[$i]['id']; ?>'"><?php echo $reserve_list[$i]['mb_name']; ?><?php echo $reserve_list[$i]['mb_id']?"<br />(".$reserve_list[$i]['mb_id'].")":""; ?></td>
							<td onclick="location.href='<?php echo G5_URL."/admin/reserve_view.php?id=".$reserve_list[$i]['id']; ?>'"><?php echo hyphen_hp_number($reserve_list[$i]['mb_phone']); ?></td>
                           	<td onclick="location.href='<?php echo G5_URL."/admin/reserve_view.php?id=".$reserve_list[$i]['id']; ?>'"><?php echo  $reserve_list[$i]['mb_addr']; ?></td>					
							<td onclick="location.href='<?php echo G5_URL."/admin/reserve_view.php?id=".$reserve_list[$i]['id']; ?>'"><?php echo $status; ?></td>
						</tr>
					<?php
						}
						if(count($member_list)==0){
							echo "<tr><td colspan='9' class='text-center' style='padding:100px 0;'>목록이 없습니다</td></tr>";
						}
					?>
					</tbody>
				</table>
			</div>
			<h1 style="font-size:24px;margin-bottom:20px;font-weight:normal">회원관리 <a href="<?php echo G5_URL."/admin/member_list.php"; ?>" style="float:right;font-size:14px;vertical-align:bottom;margin-top:12px">더보기</a></h1>
			<div class="adm-table01 mb20">
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
							<th class="md_none">가맹신청현황</th>
							<!-- <th>관리</th> -->
						</tr>
					</thead>
					<tbody>
					<?php
						for($i=0;$i<count($member_list);$i++){
					?>
						<tr>
							<td class="md_none" onclick="location.href='<?php echo G5_URL."/admin/member_view.php?mb_no=".$member_list[$i]['mb_no']; ?>';"><?php echo $member_list[$i]['num']; ?></td>
							<td onclick="location.href='<?php echo G5_URL."/admin/member_view.php?mb_no=".$member_list[$i]['mb_no']; ?>';"><?php echo $member_list[$i]['mb_id']; ?></td>
							<td onclick="location.href='<?php echo G5_URL."/admin/member_view.php?mb_no=".$member_list[$i]['mb_no']; ?>';"><?php echo $member_list[$i]['mb_name']; ?></td>
							<td class="md_none" onclick="location.href='<?php echo G5_URL."/admin/member_view.php?mb_no=".$member_list[$i]['mb_no']; ?>';"><?php echo $member_list[$i]['mb_email']; ?></td>
							<td onclick="location.href='<?php echo G5_URL."/admin/member_view.php?mb_no=".$member_list[$i]['mb_no']; ?>';"><?php echo $member_list[$i]['mb_hp']; ?></td>
							<td onclick="location.href='<?php echo G5_URL."/admin/member_view.php?mb_no=".$member_list[$i]['mb_no']; ?>';"><?php echo $member_list[$i]['mb_point']?number_format($member_list[$i]['mb_point']):0; ?></td>
							<td class="md_none" onclick="location.href='<?php echo G5_URL."/admin/member_view.php?mb_no=".$member_list[$i]['mb_no']; ?>';"><?php echo date("Y.m.d H:i",strtotime($member_list[$i]['mb_datetime'])); ?></td>
							<td class="md_none" onclick="location.href='<?php echo G5_URL."/admin/member_view.php?mb_no=".$member_list[$i]['mb_no']; ?>';"><?php echo date("Y.m.d H:i",strtotime($member_list[$i]['mb_today_login'])); ?></td>
							<td onclick="location.href='<?php echo G5_URL."/admin/member_view.php?mb_no=".$member_list[$i]['mb_no']; ?>';"><?php echo $member_list[$i]['mb_1']==1?"가맹신청":"미신청"; ?></td>
							<!-- <td><a href="<?php echo G5_URL."/admin/member_stop.php?mb_no=".$member_list[$i]['mb_no']; ?>"><?php echo $member_list[$i]['mb_intercept_date']?"활성":"정지"; ?></a></td> -->
						</tr>
					<?php
						}
						if(count($member_list)==0){
							echo "<tr><td colspan='9' class='text-center' style='padding:100px 0;'>목록이 없습니다</td></tr>";
						}
					?>
					</tbody>
				</table>
			</div>
			<h1 style="font-size:24px;margin-bottom:20px;font-weight:normal">리뷰관리 <a href="<?php echo G5_URL."/admin/board_list.php?bo_table=review"; ?>" style="float:right;font-size:14px;vertical-align:bottom;margin-top:12px">더보기</a></h1>
			<div class="adm-table01 mb20">
				<table>
					<thead>
						<tr>
							<th>번호</th>
							<th class="md_none">제목</th>							
							<th class="md_none">작성자</th>
							<th>등록일</th>
							<th>조회</th>
						</tr>
					</thead>
					<tbody>
					<?php
						for($i=0;$i<count($review);$i++){
					?>
						<tr>
							<td class="md_none" onclick="location.href='<?php echo G5_URL."/admin/board_view.php?wr_id=".$review[$i]['wr_id']."&bo_table=review"; ?>'"><?php echo $review[$i]['num']; ?></td>
							<td class="md_none" onclick="location.href='<?php echo G5_URL."/admin/board_view.php?wr_id=".$review[$i]['wr_id']."&bo_table=review"; ?>'"><?php echo $review[$i]['wr_subject']; ?></td>
							<td class="md_none" onclick="location.href='<?php echo G5_URL."/admin/board_view.php?wr_id=".$review[$i]['wr_id']."&bo_table=review"; ?>'"><?php echo $review[$i]['wr_name']; ?></td>
							<td onclick="location.href='<?php echo G5_URL."/admin/board_view.php?wr_id=".$review[$i]['wr_id']."&bo_table=review"; ?>'"><?php echo $review[$i]['wr_datetime']; ?></td>
							<td onclick="location.href='<?php echo G5_URL."/admin/board_view.php?wr_id=".$review[$i]['wr_id']."&bo_table=review"; ?>'"><?php echo $review[$i]['wr_hit']; ?></td>
						</tr>
					<?php
						}
						if(count($member_list)==0){
							echo "<tr><td colspan='9' class='text-center' style='padding:100px 0;'>목록이 없습니다</td></tr>";
						}
					?>
					</tbody>
				</table>
			</div>
			<h1 style="font-size:24px;margin-bottom:20px;font-weight:normal">가맹점문의 <a href="<?php echo G5_URL."/admin/franchisee_list.php"; ?>" style="float:right;font-size:14px;vertical-align:bottom;margin-top:12px">더보기</a></h1>
			<div class="adm-table01 mb20">
				<table>
					<thead>
						<tr>
							<th>번호</th>
							<th class="md_none">이름</th>							
							<th class="md_none">지역</th>
							<th>전화번호</th>
							<th>등록일</th>
						</tr>
					</thead>
					<tbody>
					<?php
						for($i=0;$i<count($frenchisee);$i++){
					?>
						<tr>
							<td class="md_none" onclick="location.href='<?php echo G5_URL."/admin/franchisee_view.php?id=".$frenchisee[$i]['id']."&bo_table=review"; ?>'"><?php echo $frenchisee[$i]['num']; ?></td>
							<td class="md_none" onclick="location.href='<?php echo G5_URL."/admin/franchisee_view.php?id=".$frenchisee[$i]['id']."&bo_table=review"; ?>'"><?php echo $frenchisee[$i]['mb_name']; ?></td>
							<td class="md_none" onclick="location.href='<?php echo G5_URL."/admin/franchisee_view.php?id=".$frenchisee[$i]['id']."&bo_table=review"; ?>'"><?php echo $frenchisee[$i]['mb_location']; ?></td>
							<td class="md_none" onclick="location.href='<?php echo G5_URL."/admin/franchisee_view.php?id=".$frenchisee[$i]['id']."&bo_table=review"; ?>'"><?php echo $frenchisee[$i]['mb_hp']; ?></td>
							<td onclick="location.href='<?php echo G5_URL."/admin/franchisee_view.php?id=".$frenchisee[$i]['id']."&bo_table=review"; ?>'"><?php echo $frenchisee[$i]['datetime']; ?></td>
						</tr>
					<?php
						}
						if(count($member_list)==0){
							echo "<tr><td colspan='9' class='text-center' style='padding:100px 0;'>목록이 없습니다</td></tr>";
						}
					?>
					</tbody>
				</table>
			</div>
			<h1 style="font-size:24px;margin-bottom:20px;font-weight:normal">1:1문의 <a href="<?php echo G5_URL."/admin/board_list.php?bo_table=questions"; ?>" style="float:right;font-size:14px;vertical-align:bottom;margin-top:12px">더보기</a></h1>
			<div class="adm-table01 mb20">
				<table>
					<thead>
						<tr>
							<th>번호</th>
							<th class="md_none">제목</th>							
							<th class="md_none">작성자</th>
							<th>등록일</th>
							<th>조회</th>
						</tr>
					</thead>
					<tbody>
					<?php
						for($i=0;$i<count($questions);$i++){
					?>
						<tr>
							<td class="md_none" onclick="location.href='<?php echo G5_URL."/admin/board_view.php?wr_id=".$questions[$i]['wr_id']."&bo_table=questions"; ?>'"><?php echo $questions[$i]['num']; ?></td>
							<td class="md_none" onclick="location.href='<?php echo G5_URL."/admin/board_view.php?wr_id=".$questions[$i]['wr_id']."&bo_table=questions"; ?>'"><?php echo $questions[$i]['wr_subject']; ?></td>
							<td class="md_none" onclick="location.href='<?php echo G5_URL."/admin/board_view.php?wr_id=".$questions[$i]['wr_id']."&bo_table=questions"; ?>'"><?php echo $questions[$i]['wr_name']; ?></td>
							<td onclick="location.href='<?php echo G5_URL."/admin/board_view.php?wr_id=".$questions[$i]['wr_id']."&bo_table=questions"; ?>'"><?php echo $questions[$i]['wr_datetime']; ?></td>
							<td onclick="location.href='<?php echo G5_URL."/admin/board_view.php?wr_id=".$questions[$i]['wr_id']."&bo_table=questions"; ?>'"><?php echo $questions[$i]['wr_hit']; ?></td>
						</tr>
					<?php
						}
						if(count($member_list)==0){
							echo "<tr><td colspan='9' class='text-center' style='padding:100px 0;'>목록이 없습니다</td></tr>";
						}
					?>
					</tbody>
				</table>
			</div>
			<h1 style="font-size:24px;margin-bottom:20px;font-weight:normal">전자보증서관리 <a href="<?php echo G5_URL."/admin/warranty_list.php"; ?>" style="float:right;font-size:14px;vertical-align:bottom;margin-top:12px">더보기</a></h1>
			<div class="adm-table01 mb20">
				<table>
					<thead>
						<tr>
							<th>번호</th>
							<th class="md_none">시공점</th>							
							<th class="md_none">차종</th>
							<th>시공서비스</th>
							<th>시공점연락처</th>
							<th>상태</th>
						</tr>
					</thead>
					<tbody>
					<?php
						for($i=0;$i<count($warranty);$i++){
							$status = "";
							switch($warranty[$i]["status"]){
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
							$program = "";
							switch($warranty[$i]["program"]){
								case "1":
									$program = "Step1";
									break;
								case "2":
									$program = "Step2";
									break;
								case "3":
									$program = "Step3";
									break;
								case "4":
									$program = "Step4";
									break;
								case "5":
									$program = "Step5";
									break;
								case "6":
									$program = "Step6";
									break;
								case "7":
									$program = "Step7";
									break;

							}
					?>
						<tr>
							<td class="md_none" onclick="location.href='<?php echo G5_URL."/admin/warranty_view.php?id=".$warranty[$i]['id']; ?>'"><?php echo $warranty[$i]['num']; ?></td>
							<td class="md_none" onclick="location.href='<?php echo G5_URL."/admin/warranty_view.php?id=".$warranty[$i]['id']; ?>'"><?php echo $warranty[$i]['center_name']; ?></td>
							<td class="md_none" onclick="location.href='<?php echo G5_URL."/admin/warranty_view.php?id=".$warranty[$i]['id']; ?>'"><?php echo $warranty[$i]['car']; ?></td>
							<td class="md_none" onclick="location.href='<?php echo G5_URL."/admin/warranty_view.php?id=".$warranty[$i]['id']; ?>'"><?php echo $program; ?></td>
							<td onclick="location.href='<?php echo G5_URL."/admin/warranty_view.php?id=".$warranty[$i]['id']; ?>'"><?php echo $warranty[$i]['manager']; ?></td>
							<td onclick="location.href='<?php echo G5_URL."/admin/warranty_view.php?id=".$warranty[$i]['id']; ?>'"><?php echo $status; ?></td>
						</tr>
					<?php
						}
						if(count($member_list)==0){
							echo "<tr><td colspan='9' class='text-center' style='padding:100px 0;'>목록이 없습니다</td></tr>";
						}
					?>
					</tbody>
				</table>
			</div>
		</article>
	</section>
</div>
<?php
	include_once(G5_PATH."/admin/tail.php");
?>
