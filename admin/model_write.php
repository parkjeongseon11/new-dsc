<?php
	include_once("../common.php");
	include_once(G5_PATH."/admin/head.php");
	if($id){
		$write=sql_fetch("select * from `rutilo_product` where id='".$id."'");
	}
	$short=sql_fetch("select * from best_short");
    

?>

<!-- 본문 start -->
<div id="wrap">
	<section>
		<header id="admin-title">
			<h1>제품관리</h1>
			<hr />
		</header>
		<article>
			<form action="<?php echo G5_URL."/admin/model_update.php"; ?>" name="branch_form" id="branch_form" method="post" enctype="multipart/form-data">
				<input type="hidden" name="id" value="<?php echo $id; ?>" />
				<input type="hidden" name="page" value="<?php echo $page; ?>" />
				<div class="adm-table02">
					<table>
						<tr>
							<th>제품사진 *</th>
							<td>
							<input type="button" value="+" class="btn adm-btn01" id="addbTn"/> <input type="button" value="-" class="btn adm-btn01" id="delbTn"/>
							<table class="fileTbl1">
						    <?php 
                                $str = explode(",",$write['photo']);
                                for($i=0;$i<count($str);$i++){
                            ?>							    
								<tr class="filetd<?php echo $i?>">
									<td id="<?php echo $i; ?>">
									<input type="text" name="test[]" value="<?php echo $str[$i];?>" id="filename<?php echo $i?>" />
									<label for="img<?php echo $i; ?>" style="padding:10px;background:#333;color:#FFF">
									<input type="file" class="files" name="image1[]" id="img<?php echo $i ?>" style="display:none" onChange="$(this).parent().prev().val(this.value)" />
									파일선택
									</label>
									</td>
								</tr>                        
				            <?php } ?>
							</table>
<!--
                                <input type="file" name="photo" id="photo" <?php echo $id?"":""; ?> />
                                <p><?php echo $write["photo"];?></p>
-->
                            </td>
						</tr>
						<tr>
							<th>제품사진 링크</th>
							<td><input type="text" name="photolink" id="photolink" class="adm-input01 grid_100" value="<?php echo $write['photolink']; ?>" /></td>
						</tr>
						<tr>
							<th>제품이름 *</th>
							<td><input type="text" name="name" id="name" required class="adm-input01 grid_100" value="<?php echo $write['name']; ?>" /></td>
						</tr>
						<tr>
                            <th>제품설명 *</th>
							<td><input type="text" name="content" id="content" required class="adm-input01 grid_100" value="<?php echo strip_tags($write['content']); ?>" /></td>
						</tr>
                        <tr>
                            <th>제품부가설명 *</th>
                            <td>
                                <input type="text" name="sub_content" id="sub_content" required class="adm-input01 grid_100" value="<?php echo $write['sub_content']; ?>" />
                            </td>
                        </tr>
						<tr>
						    <th>제품코드 *</th>
						    <td><input type="text" name="code" id="code" required class="adm-input01 grid_100" value="<?php echo $write['code']; ?>" /></td>
						</tr>
                       	<tr>
							<th>제품가격 *</th>
							<td><input type="text" name="price" id="price" required class="adm-input01 grid_100" value="<?php echo $write['price']; ?>" /></td>
						</tr>
                       <tr>
                           <th>용량(ml) *</th>
                           <td><input type="text" name="volume" id="volume" required class="adm-input01 grid_100" value="<?php echo $write['volume']; ?>"></td>
                       </tr>
                       
                       <tr>
                           <th>구성품 *</th>
                           <td><input type="text" name="components" id="components" required class="adm-input01 grid_100" value="<?php echo $write['components']; ?>"></td>
                       </tr>
                        <tr>
							<th>카테고리 *</th>
							<td>
                                <select name="type" id="type" class="adm-input01 grid_100" >
                                    <option value="">선택해세요</option>
                                    <option value="오너용" <?php if($write["type"]=="오너용"){?>selected<?php }?>>오너용</option>
                                    <option value="전문가용" <?php if($write["type"]=="전문가용"){?>selected<?php }?>>전문가용</option>
                                </select>
                                <!--<input type="text" name="type" id="type" required class="adm-input01 grid_100" value="<?php /*echo $write['type']; */?>" />-->
                            </td>
						</tr>
                        <tr>
							<th>제품상세보기 이미지</th>
							<td>
<!--
							    <input type="file" name="content1" id="content1" <?php echo $id?"":""; ?> />
                                <p><?php echo $write["content1"];?></p>
-->
                            <input type="button" value="+" class="btn adm-btn01" id="addBtn"/> <input type="button" value="-" class="btn adm-btn01" id="delBtn"/>
                            <table class="fileTbl">
							<?php 
                                $str2 = explode(",",$write['content1']);
                                for($i=0;$i<count($str2);$i++){
                            ?>	
								<tr class="detail<?php echo $i?>">
									<td>
										<input type="text" name="test2[]" value="<?php echo $str2[$i];?>" id="filenames<?php echo $i?>" />
										<label for="imgs<?php echo $i; ?>" style="padding:10px;background:#333;color:#FFF">
										<input type="file" class="files" name="mage[]" id="imgs<?php echo $i ?>" style="display:none" onChange="$(this).parent().prev().val(this.value)" />
										파일선택
										</label>
									<!-- 
									<input type="file" class="files" name="image[]" id="img" /> -->
									</td>
								</tr>
								<?php
								}
								?>
							</table>
							</td>
						</tr>
                        <tr>
							<th>MSDS</th>
							<td>
							    <textarea name="msds" id="msds" cols="30" rows="10" class="adm-input01 grid_100" style="height:100px;"><?php echo strip_tags($write['msds']); ?></textarea>
							    <input type="file" name="msdsImg" id="msdsImg" <?php echo $id?"":""; ?> />
                                <p><?php echo $write["msdsImg"];?></p>
							</td>
						</tr>
                        <tr>
							<th>지원정보</th>
							<td>
							    <textarea name="info" id="info" cols="30" rows="10" class="adm-input01 grid_100" style="height:100px;"><?php echo strip_tags($write['info']); ?></textarea>
							    <input type="file" name="infoImg" id="infoImg" <?php echo $id?"":""; ?> />
                                <p><?php echo $write["infoImg"];?></p>
							</td>
						</tr>
                        <tr>
							<th>이미지 링크</th>
							<td><input type="text" name="imglink" id="imglink" class="adm-input01 grid_100" value="<?php echo $write['imglink']; ?>" /></td>
						</tr>
<!--
                         
						<tr>
							<th>상세정보</th>
							<td>
								<?php echo $editor_html; ?>
							</td>
						</tr>             
-->
					</table>
				</div>
				<div class="adm-table02 mt20">
<!--
					<table>
						<tr>
							<th>차량 유형 *</th>
							<td>
							<select name="type" class="adm-input01 grid_100" required id="type">
								<option value="">차량 유형 선택</option>
								<option value="소형" <?php echo $write['type']=="소형"?"selected":""; ?> data-price="<?php echo $short['s1'] ; ?>" data-price3="<?php echo $short['s3'] ; ?>" data-price5="<?php echo $short['s5'] ; ?>" data-price7="<?php echo $short['s7'] ; ?>" data-hour="<?php echo $short['sh'] ; ?>">소형</option>
								<option value="중형" <?php echo $write['type']=="중형"?"selected":""; ?> data-price="<?php echo $short['m1'] ; ?>" data-price3="<?php echo $short['m3'] ; ?>" data-price5="<?php echo $short['m5'] ; ?>" data-price7="<?php echo $short['m7'] ; ?>" data-hour="<?php echo $short['mh'] ; ?>">중형</option>
								<option value="대형" <?php echo $write['type']=="대형"?"selected":""; ?> data-price="<?php echo $short['b1'] ; ?>" data-price3="<?php echo $short['b3'] ; ?>" data-price5="<?php echo $short['b5'] ; ?>" data-price7="<?php echo $short['b7'] ; ?>" data-hour="<?php echo $short['bh'] ; ?>">대형</option>
								<option value="승합" <?php echo $write['type']=="승합"?"selected":""; ?> data-price="<?php echo $short['v1'] ; ?>" data-price3="<?php echo $short['v3'] ; ?>" data-price5="<?php echo $short['v5'] ; ?>" data-price7="<?php echo $short['v7'] ; ?>" data-hour="<?php echo $short['vh'] ; ?>">승합</option>
								<option value="수입" <?php echo $write['type']=="수입"?"selected":""; ?> data-price="<?php echo $short['i1'] ; ?>" data-price3="<?php echo $short['i3'] ; ?>" data-price5="<?php echo $short['i5'] ; ?>" data-price7="<?php echo $short['i7'] ; ?>" data-hour="<?php echo $short['ih'] ; ?>">수입</option>
								<option value="SUV/RV" <?php echo $write['type']=="SUV/RV"?"selected":""; ?> data-price="<?php echo $short['r1'] ; ?>" data-price3="<?php echo $short['r3'] ; ?>" data-price5="<?php echo $short['r5'] ; ?>" data-price7="<?php echo $short['r7'] ; ?>" data-hour="<?php echo $short['ih'] ; ?>">SUV/RV</option>
							</select>
							</td>
						</tr>
						<tr>
							<th>1~2일 *</th>
							<td><input type="text" name="day_pay" class="adm-input01 grid_100" id="day_pay" onkeyup="return number_only(this);" value="<?php echo $write['day_pay']; ?>" required /></td>
						</tr>
						<tr>
							<th>3~4일 *</th>
							<td><input type="text" name="day_pay3" class="adm-input01 grid_100" id="day_pay3" onkeyup="return number_only(this);" value="<?php echo $write['day_pay3']; ?>" required /></td>
						</tr>
						<tr>
							<th>5~6일 *</th>
							<td><input type="text" name="day_pay5" class="adm-input01 grid_100" id="day_pay5" onkeyup="return number_only(this);" value="<?php echo $write['day_pay5']; ?>" required /></td>
						</tr>
						<tr>
							<th>7일~ *</th>
							<td><input type="text" name="day_pay7" class="adm-input01 grid_100" id="day_pay7" onkeyup="return number_only(this);" value="<?php echo $write['day_pay7']; ?>" required /></td>
						</tr>
						<tr>
							<th>시간당 *</th>
							<td><input type="text" name="hour_pay" id="hour_pay" required class="adm-input01 grid_100" value="<?php echo $write['hour_pay']; ?>" /></td>
						</tr>
						<tr>
							<th>픽업서비스 *</th>
							<td><input type="text" name="pick_pay" id="pick_pay" required class="adm-input01 grid_100" value="<?php echo $write['pick_pay']; ?>" /></td>
						</tr>
					</table>
				</div>
-->
<!--
				<div class="adm-table02 mt20">
					<table>
						<tr>
							<th>연료 *</th>
							<td><input type="text" name="fuel" class="adm-input01 grid_100" required id="fuel" value="<?php echo $write['fuel']; ?>" /></td>
						</tr>
						<tr>
							<th>연비</th>
							<td><input type="text" name="mileage" id="mileage" class="adm-input01 grid_100" value="<?php echo $write['mileage']; ?>" /></td>
						</tr>
						<tr>
							<th>인원 *</th>
							<td><input type="text" name="seater" required id="seater" class="adm-input01 grid_100" value="<?php echo $write['seater']; ?>" /></td>
						</tr>
						<tr>
							<th>변속기 *</th>
							<td><input type="text" name="gear" id="gear" required class="adm-input01 grid_100" value="<?php echo $write['gear']; ?>" /></td>
						</tr>
						<tr>
							<th>연식 *</th>
							<td><input type="text" name="year" id="year" required class="adm-input01 grid_100" value="<?php echo $write['year']; ?>" /></td>
						</tr>
						<tr>
							<th>배기량</th>
							<td><input type="text" name="displacement" id="displacement" class="adm-input01 grid_100" value="<?php echo $write['displacement']; ?>" /></td>
						</tr>
						<tr>
							<th>색상</th>
							<td><input type="text" name="color" id="color" class="adm-input01 grid_100" value="<?php echo $write['color']; ?>" /></td>
						</tr>
						<tr>
							<th>옵션</th>
							<td><input type="text" name="option" id="option" class="adm-input01 grid_100" value="<?php echo $write['option']; ?>" /></td>
						</tr>
						<tr>
							<th>설명</th>
							<td><textarea name="content" id="content" cols="30" rows="10" class="adm-input01 grid_100" style="height:100px;"><?php echo strip_tags($write['content']); ?></textarea></td>
						</tr>
					</table>
				</div>
-->
				<div class="text-center mt20">
					<input type="submit" value="확인" class="adm-btn01" />
				</div>
			</form>
		</article>
	</section>
</div>
<script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
<script type="text/javascript">    
$(document).ready(function(){
    var cnt=$(".fileTbl tr").length;
    $("#addBtn").click(function(){
        var test1 =$(".detail0");
        test1.children().children('label').attr("for","imgs"+(cnt));
        test1.children().children('label').children('input').attr("id","imgs"+(cnt));
        var item = test1.clone();
        
        $(".fileTbl tr").each(function(e){
            cnt= e+1;
            $(this).children().children('label').attr("for","imgs"+(cnt-1));
            $(this).children().children('label').children('input').attr("id","imgs"+(cnt-1));
        })
        
        item.removeClass();
        item.addClass("detail"+cnt);
        item.appendTo($(".fileTbl"));
        cnt++;
    });
    $("#delBtn").click(function(){
        $("tr[class^=detail]").each(function(e){
            if(cnt-1 == e && cnt!=1){
                $(".detail"+e).remove();
                cnt--;
            }
        });
    });
    
    var cct=$(".fileTbl1 tr").length;
    $("#addbTn").click(function(){    
        console.log(cct);
        var test =$(".filetd0");
        test.children().children('label').attr("for","img"+(cct));
        test.children().children('label').children('input').attr("id","img"+(cct));
        var item1 = test.clone();
        
        $(".fileTbl1 tr").each(function(e){
            cct= e+1;
            $(this).children().children('label').attr("for","img"+(cct-1));
            $(this).children().children('label').children('input').attr("id","img"+(cct-1));
        })
        
//        alert(item1);
        item1.removeClass();
        item1.addClass("filetd"+cct);
        item1.appendTo($(".fileTbl1"));
        cct++;
        /*$("input[id^=filename]").each(function(e){
            $(this).attr('id','filename'+e);
            $(this).siblings().children().attr("onchange");
        });*/
    });
    $("#delbTn").click(function(){
        $("tr[class^=filetd]").each(function(e){
            if(cct-1 == e && cct!=1){
                $(".filetd"+e).remove();
                cct--;
            }
        });
    });
});
$(function(){
    $("#type").change(function(){
        var day_pay=$("#type option:selected").attr("data-price");
        var day_pay3=$("#type option:selected").attr("data-price3");
        var day_pay5=$("#type option:selected").attr("data-price5");
        var day_pay7=$("#type option:selected").attr("data-price7");
        var hour_pay=$("#type option:selected").attr("data-hour");
        /*$("#day_pay").val(day_pay);
        $("#day_pay3").val(day_pay3);
        $("#day_pay5").val(day_pay5);
        $("#day_pay7").val(day_pay7);*/
        $("#hour_pay").val(hour_pay);
    });
});
</script>
<?php
	include_once(G5_PATH."/admin/tail.php");
?>
