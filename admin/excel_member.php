<?php 
include_once("../common.php");
 header( "Content-type: application/vnd.ms-excel; charset=utf-8" ); 
 header( "Content-Disposition: attachment; filename=회원관리.xls" ); 
 header( "Content-Description: PHP4 Generated Data" ); 
 print("<meta http-equiv=\"Content-Type\" content=\"application/vnd.ms-excel; charset=utf-8\">");
    if($sel!="" && $search!=""){
		$where="and `{$sel}` like '%{$search}%' ";
    }
    
    $total=sql_fetch("select count(*) as cnt from `g5_member` where mb_1 = 0 {$where} order by `mb_no` desc");
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

	
	if(!$page)
		$page=1;
	$total=$total['cnt'];    
	$rows=10;
	$start=($page-1)*$rows;
	$total_page=ceil($total/$rows);

	$sql="select a.*,b.st_name from g5_member as a left join store_info as b on a.mb_id=b.mb_id where  mb_1 = 0 {$where} order by `mb_no` desc ";
	$query=sql_query($sql);
	$j=0;
	while($data=sql_fetch_array($query)){
		$list[$j]=$data;
		$list[$j]['num']=$total-($start)-$j;
		$j++;
	}

	$sqlS="select a.*,b.st_name from g5_member as a left join store_info as b on a.mb_id=b.mb_id where  mb_1 = 1 {$where} order by `mb_no` desc ";
	$queryS=sql_query($sqlS);
	$k=0;
	while($dataS=sql_fetch_array($queryS)){
		$listS[$k]=$dataS;
		$listS[$k]['num']=$totalS-($startS)-$k;
		$k++;
	}
?>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr"> 
<table border="1" cellpadding="3" cellspacing="0"> 
<tr><td colspan="8"><b>회원관리</b></td></tr>
<tr><td><b>번호</b></td><td><b>아이디</b></td><td><b>이름</b></td><td><b>이메일</b></td><td><b>주소</b></td><td><b>휴대폰번호</b></td><td><b>가입일</b></td><td><b>사업자(상호명)</b></td></tr> 
<?php 
for($i = 0; $i < count($list); $i++){ ?>
<tr><td><?php echo $list[$i]['mb_no'];?></td><td><?php echo $list[$i]['mb_id']; ?></td><td><?php echo $list[$i]['mb_name'];?></td><td><?php echo $list[$i]['mb_email']; ?></td><td><?php echo "(".$list[$i]['mb_addr1'].")".$list[$i]['mb_addr2']." ".$list[$i]['mb_addr3']; ?></td><td><?php echo $list[$i]['mb_hp']; ?></td><td><?php echo date("Y.m.d H:i",strtotime($list[$i]['mb_datetime'])); ?></td><td><?php if($list[$i]['st_name']){echo $list[$i]['st_name']; }else{ echo "일반회원";} ?></td></tr> 
<?php } ?> 
</table>
<br><br><br>
<table border="1" cellpadding="3" cellspacing="0"> 
<tr><td colspan="8"><b>가맹점관리</b></td></tr>
<tr><td><b>번호</b></td><td><b>아이디</b></td><td><b>이름</b></td><td><b>이메일</b></td><td><b>주소</b></td><td><b>휴대폰번호</b></td><td><b>가입일</b></td><td><b>사업자(상호명)</b></td></tr>
<?php 
for($k = 0; $k < count($listS); $k++){ ?>
<tr><td><?php echo $listS[$k]['mb_no'];?></td><td><?php echo $listS[$k]['mb_id']; ?></td><td><?php echo $listS[$k]['mb_name'];?></td><td><?php echo $listS[$k]['mb_email']; ?></td><td><?php echo "(".$listS[$k]['mb_addr1'].")".$listS[$k]['mb_addr2']." ".$listS[$k]['mb_addr3']; ?></td><td><?php echo $listS[$k]['mb_hp']; ?></td><td><?php echo date("Y.m.d H:i",strtotime($listS[$k]['mb_datetime'])); ?></td><td><?php if($listS[$k]['st_name']){echo $listS[$k]['st_name']; }else{ echo "가맹신청";} ?></td></tr> 
<?php } ?> 
</table>