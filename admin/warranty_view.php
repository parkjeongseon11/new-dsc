<?php
	include_once("../common.php");
	$p=true;
	include_once(G5_PATH."/admin/head.php");
	if(!$id){
		alert("잘못된 정보입니다.");
	}
	$view=sql_fetch("select * from `rutilo_warranty` where id='".$id."'");
	$program = explode(",",$view['program']);
?>
<!-- 본문 start -->
<div id="wrap">
	<section>
		<header id="admin-title">
			<h1>전자보증서</h1>
			<hr />
		</header>
		<article>
				<div class="adm-table02">
					<h3>시공정보</h3>
					<table>
						<tr>
							<th>차종</th>
							<td><?php echo $view["car"]; ?></td>
						</tr>					
						<tr>
							<th>색상</th>
							<td><?php echo $view['car_color']; ?></td>
						</tr>
					   <tr>
							<th>차랑번호</th>
							<td><?php echo $view['car_number']; ?></td>
						</tr>
                       	<tr>
							<th>시공점</th>
							<td><?php echo $view['center_name']; ?></td>
						</tr>	
						<tr>
							<th>시공일자</th>
							<td><?php echo $view['sign_date']; ?></td>
						</tr>	
					    <tr>
							<th>시공점 연락처</th>
							<td><?php echo $view['manager']; ?></td>
						</tr>							
					</table>
					<h3>시공 서비스</h3>
					<table>
						<tr>
							<th>서비스</th>
							<td><?php for($j=0;$j<count($program);$j++){ if($j+1==count($program)){echo "G".$program[$j];}else{echo "G".$program[$j].", ";} }?></td>
						</tr>	
						<tr>
							<th>시공 비용</th>
							<td><?php echo number_format($view["price"])?>원</td>
						</tr>	
						<tr>
						    <th>인증 번호</th>
						    <td><?php echo $view['serial']; ?></td>
						</tr>
					</table>
					<h3>고객정보</h3>
					<table>
						<tr>
							<th>성명</th>
							<td><?php echo $view['user_name']; ?></td>
						</tr>
					   <tr>
							<th>연락처</th>
							<td><?php echo $view['user_tel']; ?></td>
						</tr>
                       	<tr>
							<th>이메일</th>
							<td><?php echo $view['user_email']; ?></td>
						</tr>	
						<tr>
							<th>주소</th>
							<td><?php echo "[".$view['user_zip']."]".$view["user_addr1"]." ".$view["user_addr2"]; ?></td>
						</tr>							
					</table>
				</div>
				<div class="text-center mt20" style="margin-bottom:20px;">
					<?php if($view["status"]=="1"){?>
					<a href="#" onclick="fnOpen('<?php echo $id?>','<?php echo $page?>')" class="adm-btn01">인쇄</a>
					<?php }?>
					<a href="#" onclick="location.href='<?php echo G5_URL?>/admin/warranty_write.php?id=<?php echo $id;?>'" class="adm-btn01">수정</a>
					<a href="<?php echo G5_URL."/admin/warranty_status_update.php?id=".$id."&page=".$page."&status=1"; ?>" class="adm-btn01">승인</a>
					<a href="<?php echo G5_URL."/admin/warranty_status_update.php?id=".$id."&page=".$page."&status=2"; ?>" class="adm-btn01">취소</a>
					<?php if($is_admin){ ?><a href="<?php echo G5_URL."/admin/warranty_list.php?page=".$page; ?>" class="adm-btn01">목록으로</a><?php } ?>
				</div>
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
