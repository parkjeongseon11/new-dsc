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
			<form action="<?php echo G5_URL."/admin/warranty_update.php"; ?>" method="post" name="warranty_form">
				<input type="hidden" name="id" value="<?php echo $id;?>" />
				<div class="adm-table02">
					<h3>시공정보</h3>
					<table>
						<tr>
							<th>차종</th>
							<td><input type="text" name="car" class="adm-input01 grid_100" value="<?php echo $view["car"]; ?>" /></td>
						</tr>					
						<tr>
							<th>색상</th>
							<td><input type="text" name="car_color" class="adm-input01 grid_100" value="<?php echo $view['car_color']; ?>" /></td>
						</tr>
					   <tr>
							<th>차랑번호</th>
							<td><input type="text" name="car_number" class="adm-input01 grid_100" value="<?php echo $view['car_number']; ?>" /></td>
						</tr>
                       	<tr>
							<th>시공점</th>
							<td><input type="text" name="center_name" class="adm-input01 grid_100"  value="<?php echo $view['center_name']; ?>" /></td>
						</tr>	
						<tr>
							<th>시공일자</th>
							<td><input type="text" name="sign_date" class="adm-input01 grid_100" value="<?php echo $view['sign_date']; ?>" /></td>
						</tr>	
					    <tr>
							<th>시공점 연락처</th>
							<td><input type="text" name="manager" class="adm-input01 grid_100" value="<?php echo $view['manager']; ?>" /></td>
						</tr>							
					</table>
					<h3>시공 서비스</h3>
					<table>
						<tr>
							<th>서비스</th>
							<td>
								<select name="step" id="step" class="adm-input01 grid_100">
									<option value="1" <?php if($program=="1"){?>selected<?php }?>>G1</option>
									<option value="2" <?php if($program=="2"){?>selected<?php }?>>G2</option>
									<option value="3" <?php if($program=="3"){?>selected<?php }?>>G3</option>
									<!-- <option value="4" <?php if($program=="4"){?>selected<?php }?>>Step4</option>
									<option value="5" <?php if($program=="5"){?>selected<?php }?>>Step5</option> -->
									<option value="6" <?php if($program=="6"){?>selected<?php }?>>G6</option>
									<!-- <option value="7" <?php if($program=="7"){?>selected<?php }?>>Step7</option> -->
								</select>
							<!-- <input type="text" name="step" class="adm-input01 grid_100" value="<?php for($j=0;$j<count($program);$j++){ if($j+1==count($program)){echo "Step".$program[$j];}else{echo "Step".$program[$j].", ";} }?>"/></td> -->
						</tr>	
						<tr>
							<th>시공 비용</th>
							<td><input type="text" name="price" class="adm-input01 grid_100" value="<?php echo $view["price"]?>"/></td>
						</tr>	
					</table>
					<h3>고객정보</h3>
					<table>
						<tr>
							<th>성명</th>
							<td><input type="text" name="user_name" class="adm-input01 grid_100" value="<?php echo $view['user_name']; ?>"/></td>
						</tr>
					   <tr>
							<th>연락처</th>
							<td><input type="text" name="user_tel" class="adm-input01 grid_100" value="<?php echo $view['user_tel']; ?>"/></td>
						</tr>
                       	<tr>
							<th>이메일</th>
							<td><input type="text" name="user_email" class="adm-input01 grid_100" value="<?php echo $view['user_email']; ?>"/></td>
						</tr>	
						<tr>
							<th>주소</th>
							<td>
							<input type="text" name="user_zip" id="sample3_postcode" required readonly class="adm-input01 grid_100 postcodify_postcode5"  value="<?php echo $view['user_zip']; ?>" placeholder="우편번호"/>		<div id="wraps" style="display:none;border:1px solid;width:500px;height:300px;margin:5px 0;position:relative">
								<img src="//t1.daumcdn.net/localimg/localimages/07/postcode/320/close.png" id="btnFoldWrap" style="cursor:pointer;position:absolute;right:0px;top:-1px;z-index:1" onclick="foldDaumPostcode()" alt="접기 버튼">
							</div>					
							<input type="text" name="user_addr1" id="sample3_address" required readonly class="adm-input01 grid_100 postcodify_address" value="<?php echo $view['user_addr1']; ?>" placeholder="주소"/>
							<input type="text" name="user_addr2" id="sample3_address2" required class="adm-input01 grid_100 postcodify_details" value="<?php echo $view['user_addr2']; ?>" placeholder="상세주소"/>
							<input type="button" class="adm-btn01" id="postcodify_search_button" value="우편번호 찾기" style="background:#898989" onclick="sample3_execDaumPostcode()">
							</td>
						</tr>							
					</table>
				</div>
				<div class="text-center mt20" style="margin-bottom:20px;">
					<a href="#" onclick="fnSubmit()" class="adm-btn01">수정</a>
					<a href="<?php echo G5_URL."/admin/warranty_list.php?page=".$page; ?>" class="adm-btn01">목록으로</a>
				</div>
			</form>
		</article>
	</section>
</div>
<script type="text/javascript">
function fnSubmit(){
	document.warranty_form.submit();
}
</script>

<script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
<script>
    // 우편번호 찾기 찾기 화면을 넣을 element
    var element_wrap = document.getElementById('wraps');

    function foldDaumPostcode() {
        // iframe을 넣은 element를 안보이게 한다.
        element_wrap.style.display = 'none';
    }

    function sample3_execDaumPostcode() {
        // 현재 scroll 위치를 저장해놓는다.
        var currentScroll = Math.max(document.body.scrollTop, document.documentElement.scrollTop);
        new daum.Postcode({
            oncomplete: function(data) {
                // 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

                // 각 주소의 노출 규칙에 따라 주소를 조합한다.
                // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
                var fullAddr = data.address; // 최종 주소 변수
                var extraAddr = ''; // 조합형 주소 변수

                // 기본 주소가 도로명 타입일때 조합한다.
                if(data.addressType === 'R'){
                    //법정동명이 있을 경우 추가한다.
                    if(data.bname !== ''){
                        extraAddr += data.bname;
                    }
                    // 건물명이 있을 경우 추가한다.
                    if(data.buildingName !== ''){
                        extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                    }
                    // 조합형주소의 유무에 따라 양쪽에 괄호를 추가하여 최종 주소를 만든다.
                    fullAddr += (extraAddr !== '' ? ' ('+ extraAddr +')' : '');
                }

                // 우편번호와 주소 정보를 해당 필드에 넣는다.
				//console.log(data);

                document.getElementById('sample3_postcode').value = data.zonecode; //5자리 새우편번호 사용
                document.getElementById('sample3_address').value = fullAddr;
                // iframe을 넣은 element를 안보이게 한다.
                // (autoClose:false 기능을 이용한다면, 아래 코드를 제거해야 화면에서 사라지지 않는다.)
                element_wrap.style.display = 'none';

                // 우편번호 찾기 화면이 보이기 이전으로 scroll 위치를 되돌린다.
                document.body.scrollTop = currentScroll;
            },
            // 우편번호 찾기 화면 크기가 조정되었을때 실행할 코드를 작성하는 부분. iframe을 넣은 element의 높이값을 조정한다.
            onresize : function(size) {
                element_wrap.style.height = size.height+'px';
            },
            width : '100%',
            height : '100%'
        }).embed(element_wrap);

        // iframe을 넣은 element를 보이게 한다.
        element_wrap.style.display = 'block';
    }
</script>
<?php
	include_once(G5_PATH."/admin/tail.php");
?>
