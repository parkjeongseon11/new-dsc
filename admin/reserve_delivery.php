<?php
include_once("../common.php");
include_once(G5_PATH."/admin/head.php");

$id = $_REQUEST["id"];
$sql = "select * from `rutilo_delivery` where id = '{$id}'";
$deli = sql_fetch($sql);
?>
<!-- 본문 start -->
<div id="wrap">
	<section>
		<header id="admin-title">
			<h1>배송처리</h1>
			<hr />
		</header>
		<article>
			<form action="<?php echo G5_URL."/admin/reserve_delivery_update.php"; ?>" name="branch_form" id="branch_form" method="post" enctype="multipart/form-data">
				<input type="hidden" name="id" value="<?php echo $id; ?>" />
				<input type="hidden" name="page" value="<?php echo $page; ?>" />
				<div class="adm-table02">
					<table>
						<colgroup>
							<col width="160px" />
							<col width="*" />
						</colgroup>
						<tr>
							<th>상태</th>
							<td>
								<select name="status" id="status" class="adm-input01 grid_50" required>
									<option value="">선택</option>
									<option value="1" <?php if($deli["status"]==1){?>selected<?php }?>>배송중</option>
									<option value="2" <?php if($deli["status"]==2){?>selected<?php }?>>배송완료</option>									
								</select>
							</td>
						</tr>
						<tr>
							<th>택배사</th>
							<td>
								<select name="delivery_company" id="delivery_company" class="adm-input01 grid_50">
									<option value="01" <?php echo ($deli["delivery_company"]=="01")?"selected":"";?>>우체국택배</option>
									<option value="04" <?php echo ($deli["delivery_company"]=="04")?"selected":"";?>>CJ대한통운</option>
									<option value="05" <?php echo ($deli["delivery_company"]=="05")?"selected":"";?>>한진택배</option>
									<option value="06" <?php echo ($deli["delivery_company"]=="06")?"selected":"";?>>로젠택배</option>
									<option value="08" <?php echo ($deli["delivery_company"]=="08")?"selected":"";?>>롯데택배(현대택배)</option>
									<option value="10" <?php echo ($deli["delivery_company"]=="10")?"selected":"";?>>KGB택배</option>
									<option value="11" <?php echo ($deli["delivery_company"]=="11")?"selected":"";?>>일양로지스</option>
									<option value="12" <?php echo ($deli["delivery_company"]=="12")?"selected":"";?>>EMS</option>
									<option value="13" <?php echo ($deli["delivery_company"]=="13")?"selected":"";?>>DHL</option>
									<option value="14" <?php echo ($deli["delivery_company"]=="14")?"selected":"";?>>UPS</option>
									<option value="15" <?php echo ($deli["delivery_company"]=="15")?"selected":"";?>>GTX로지스</option>
									<option value="16" <?php echo ($deli["delivery_company"]=="16")?"selected":"";?>>한의사랑택배</option>
									<option value="17" <?php echo ($deli["delivery_company"]=="17")?"selected":"";?>>천일택배</option>
									<option value="18" <?php echo ($deli["delivery_company"]=="18")?"selected":"";?>>건영택배</option>
									<option value="21" <?php echo ($deli["delivery_company"]=="21")?"selected":"";?>>Fedex</option>
									<option value="22" <?php echo ($deli["delivery_company"]=="22")?"selected":"";?>>대신택배</option>
									<option value="23" <?php echo ($deli["delivery_company"]=="23")?"selected":"";?>>경동택배</option>
									<option value="24" <?php echo ($deli["delivery_company"]=="24")?"selected":"";?>>CVSnet 편의점택배</option>
									<option value="25" <?php echo ($deli["delivery_company"]=="25")?"selected":"";?>>TNT Express</option>
									<option value="26" <?php echo ($deli["delivery_company"]=="26")?"selected":"";?>>USPS</option>
									<option value="28" <?php echo ($deli["delivery_company"]=="28")?"selected":"";?>>GSMNtoN</option>
									<option value="29" <?php echo ($deli["delivery_company"]=="29")?"selected":"";?>>에어보이익스프레스</option>
									<option value="32" <?php echo ($deli["delivery_company"]=="32")?"selected":"";?>>합동택배</option>
									<option value="33" <?php echo ($deli["delivery_company"]=="33")?"selected":"";?>>DHL Global Mail</option>
									<option value="34" <?php echo ($deli["delivery_company"]=="34")?"selected":"";?>>i-Parcel</option>
									<option value="37" <?php echo ($deli["delivery_company"]=="37")?"selected":"";?>>범한판토스</option>
									<option value="38" <?php echo ($deli["delivery_company"]=="38")?"selected":"";?>>APEX(ECMS Express)</option>
									<option value="39" <?php echo ($deli["delivery_company"]=="39")?"selected":"";?>>KG로지스택배</option>
									<option value="40" <?php echo ($deli["delivery_company"]=="40")?"selected":"";?>>굿투럭</option>
								</select>
							</td>
						</tr>
						<tr>
							<th>송장번호</th>
							<td>
								<input name="delivery_num" id="delivery_num" class="adm-input01 grid_50" value="<?php echo $deli["delivery_num"];?>" onkeyup="number_only(this);"/>
							</td>
						</tr>

					</table>
				</div>
				<div class="text-center mt20">
					<input type="submit" value="확인" class="adm-btn01" />
					<input type="button" value="목록" class="adm-btn01" onclick="location.href=g5_url+'/admin/reserve_list.php?page=<?php echo $page;?>'"/>
				</div>
			</form>
		</article>
	</section>
</div>
<?php
include_once(G5_PATH."/admin/tail.php");
?>