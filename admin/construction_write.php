<?php
	include_once("../common.php");
	$p=true;
	include_once(G5_PATH."/admin/head.php");
	if($id){
		$write=sql_fetch("select * from `rutilo_construction` where id='".$id."'");
	}

	$sql = "select * from `rutilo_product` ";
	$res = sql_query($sql);
	while($row = sql_fetch_array($res)){
		$opt[] = $row;
	}
	$step = explode(",",$write["step"]);
?>
<!-- 본문 start -->
<div id="wrap">
	<section>
		<header id="admin-title">
			<h1>시공방법관리</h1>
			<hr />
		</header>
		<article>
			<form action="<?php echo G5_URL."/admin/construction_update.php"; ?>" method="post" enctype="multipart/form-data">
				<input type="hidden" name="id" value="<?php echo $write['id']; ?>" />
				<input type="hidden" name="page" value="<?php echo $page; ?>" />
				<div class="adm-table02">
					<table>									
						<tr>
							<th>동영상 제목</th>
							<td><input type="text" name="title" id="title" required class="adm-input01 grid_100" value="<?php echo $write['title']; ?>" /></td>
						</tr>
						<tr>
							<th>분류</th>
							<td>
							<select name="etc" id="etc" required class="adm-input01 grid_100">
								<option value="">선택하세요</option>
								<?php for($i=0;$i<count($opt);$i++){?>
								<option value="<?php echo $opt[$i]["name"]?>" <?php if($write["etc"]==$opt[$i]["name"]){?>selected<?php }?>><?php echo $opt[$i]["name"]?></option>
								<?php }?>
							</select>
							<!-- <input type="text" name="etc" id="etc" required class="adm-input01 grid_100"  value="<?php echo $write['content']; ?>" placeholder="동일 카테고리시 입력시 이전 카테고리명과 동일하게 입력"/> --></td>
						</tr>
                        <tr>
							<th>내용</th>
							<td><input type="text" name="content" id="content" required class="adm-input01 grid_100"  value="<?php echo $write['content']; ?>" /></td>
						</tr>
						<tr>
							<th rowspan="10">시공단계<br>(최소 10단계,<br>없을 시 입력 X)</th>
							<td>1단계<br><input type="text" name="step[]" class="adm-input01 grid_100" value="<?php echo $step[0]?>"/></td>
						</tr>
						<tr>
							<td>2단계<br><input type="text" name="step[]" class="adm-input01 grid_100" value="<?php echo $step[1]?>"/></td>
						</tr>
						<tr>
							<td>3단계<br><input type="text" name="step[]" class="adm-input01 grid_100" value="<?php echo $step[2]?>"/></td>
						</tr>
						<tr>
							<td>4단계<br><input type="text" name="step[]" class="adm-input01 grid_100" value="<?php echo $step[3]?>"/></td>
						</tr>
						<tr>
							<td>5단계<br><input type="text" name="step[]" class="adm-input01 grid_100" value="<?php echo $step[4]?>"/></td>
						</tr>
						<tr>
							<td>6단계<br><input type="text" name="step[]" class="adm-input01 grid_100" value="<?php echo $step[5]?>"/></td>
						</tr>
						<tr>
							<td>7단계<br><input type="text" name="step[]" class="adm-input01 grid_100" value="<?php echo $step[6]?>"/></td>
						</tr>
						<tr>
							<td>8단계<br><input type="text" name="step[]" class="adm-input01 grid_100" value="<?php echo $step[7]?>"/></td>
						</tr>
						<tr>
							<td>9단계<br><input type="text" name="step[]" class="adm-input01 grid_100" value="<?php echo $step[8]?>"/></td>
						</tr>
						<tr>
							<td>10단계<br><input type="text" name="step[]" class="adm-input01 grid_100" value="<?php echo $step[9]?>"/></td>
						</tr>
                        <tr>
							<th>썸네일</th>
							<td><input type="file" name="photo" id="photo" class="adm-input01" /></td>
						</tr>	
                        <tr>
							<th>동영상 링크</th>
							<td><input type="text" name="videolink" id="videolink" required class="adm-input01 grid_100" value="<?php echo $write['videolink']; ?>" /></td>
						</tr> 				
                        <!-- <tr>
							<th>etc</th>
							<td><input type="text" name="etc" id="etc" required class="adm-input01 grid_100" value="<?php echo $write['etc']; ?>" /></td>
						</tr>  -->
					</table>
				</div>
				<div class="text-center mt20">
					<input type="submit" value="확인" class="adm-btn01" />
				</div>
			</form>
		</article>
	</section>
</div>
<script>

</script>
<?php
	include_once(G5_PATH."/admin/tail.php");
?>
