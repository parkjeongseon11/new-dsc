<?php
	include_once("../common.php");
	$p=true;
	include_once(G5_PATH."/admin/head.php");
	if($id){
		$write=sql_fetch("select * from `dsc_slide_main` where id='".$id."'");
	}
?>
<!-- 본문 start -->
<div id="wrap">
	<section>
		<header id="admin-title">
			<h1>메인 슬라이드 이미지</h1>
			<hr />
		</header>
		<article>
			<form action="<?php echo G5_URL."/admin/slide_main_update.php"; ?>" method="post" enctype="multipart/form-data">
				<input type="hidden" name="id" value="<?php echo $write['id']; ?>" />
				<input type="hidden" name="type" value="image" />
				<input type="hidden" name="page" value="<?php echo $page; ?>" />
				<div class="adm-table02">
					<table>
						<tr>
							<th>이미지</th>
							<td>
							<?php if($id){?>
							<img src="<?php echo G5_DATA_URL."/slide/".$write['photo']; ?>" alt="슬라이드" />
							<?php }?>
							<input type="file" name="photo" id="photo" class="adm-input01" />
							<p>* 반드시 이미지 사이즈는 너비 1900px, 높이 0px로 등록 바랍니다.</p>
							</td>
						</tr>
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
