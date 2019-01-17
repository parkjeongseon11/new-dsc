<?php
	include_once("../common.php");
	include_once(G5_PATH."/admin/head.php");
	$mb_no=$_GET['mb_no'];
	if(!$mb_no){
		@alert('회원 번호가 없습니다.');
	}
	$mb=sql_fetch("select a.*,b.* from g5_member as a left join store_info as b on a.mb_id=b.mb_id where a.mb_no='{$mb_no}';");
?>
 <script src="<?php echo G5_JS_URL ?>/jquery.register_form.js"></script>
<!-- 본문 start -->
<div id="wrap">
	<section>
		<header id="admin-title">
			<h1>회원관리</h1>
			<hr />
		</header>
		<article>
			<div class="adm-table02">
				<form action="<?php echo G5_URL."/admin/member_update.php"; ?>" method="post" id="fregisterform" name="fregisterform" onsubmit="return fregisterform_submit(this);">
					<input type="hidden" name="mb_no" value="<?php echo $mb_no?>" />
					<table>
						<tr>
							<th>아이디</th>
							<td><input type="text" name="mb_id" value="<?php echo $mb['mb_id'] ?>" id="reg_mb_id"class="adm-input01 grid_100" minlength="3" readonly maxlength="20" placeholder="아이디를 입력하세요."></td>
						</tr>
						<tr>
							<th>이름</th>
							<td><input type="text" name="mb_name" value="<?php echo $mb['mb_name'] ?>" id="mb_name"class="adm-input01 grid_100" minlength="3" maxlength="20" placeholder="아이디를 입력하세요."></td>
						</tr>
						<tr>
							<th>비밀번호</th>
							<td><input type="password" name="mb_password" id="reg_mb_password" <?php echo $required ?> class="adm-input01 grid_100" minlength="3" maxlength="20" placeholder="비밀번호를 입력하세요. (8~20자)"></td>
						</tr>
						<tr>
							<th>주소</th>
							<td>		
							<input type="text" name="mb_addr1" id="sample3_postcode" required readonly class="adm-input01 grid_100 postcodify_postcode5"  value="<?php echo $mb['mb_addr1']; ?>" placeholder="우편번호"/>		<div id="wraps" style="display:none;border:1px solid;width:500px;height:300px;margin:5px 0;position:relative">
								<img src="//t1.daumcdn.net/localimg/localimages/07/postcode/320/close.png" id="btnFoldWrap" style="cursor:pointer;position:absolute;right:0px;top:-1px;z-index:1" onclick="foldDaumPostcode()" alt="접기 버튼">
							</div>					
							<input type="text" name="mb_addr2" id="sample3_address" required readonly class="adm-input01 grid_100 postcodify_address" value="<?php echo $mb['mb_addr2']; ?>" placeholder="주소"/>
							<input type="text" name="mb_addr3" id="sample3_address2" required class="adm-input01 grid_100 postcodify_details" value="<?php echo $mb['mb_addr3']; ?>" placeholder="상세주소"/>
							<input type="button" class="adm-btn01" id="postcodify_search_button" value="우편번호 찾기" style="background:#898989" onclick="sample3_execDaumPostcode()">

							<!-- <input type="text" name="mb_addr1" required readonly class="adm-input01 grid_100 postcodify_postcode5"  value="<?php echo $mb['mb_addr1']; ?>" placeholder="우편번호"/>										
							<input type="text" name="mb_addr2"  required readonly class="adm-input01 grid_100 postcodify_address" value="<?php echo $mb['mb_addr2']; ?>" placeholder="주소"/>
							<input type="text" name="mb_addr3" id="sample3_address2" required class="adm-input01 grid_100 postcodify_details" value="<?php echo $mb['mb_addr3']; ?>" placeholder="상세주소"/>
							<input type="button" class="adm-btn01" id="postcodify_search_button" value="우편번호 찾기" style="background:#898989"> --><br>
							</td>
						</tr>
						<tr>
							<th>이메일</th>
							<td><input type="email" name="mb_email" value="<?php echo $mb['mb_email'] ?>" id="reg_mb_email" <?php echo $required ?> class="adm-input01 grid_100" minlength="3" placeholder="이메일을 입력하세요"></td>
						</tr>
						<tr>
							<th>연락처</th>
							<td><input type="text" name="mb_hp" id="reg_mb_hp" value="<?php echo $mb['mb_hp']; ?>" class="adm-input01 grid_100" onkeyup="return number_only(this);" placeholder="휴대폰 번호는 '-'를 생략하고 작성해주세요" /></td>
						</tr>
						<tr>
							<th>포인트</th>
							<td><input type="text" name="mb_point" id="mb_point" value="<?php echo $mb['mb_point']; ?>" class="adm-input01 grid_100" onkeyup="return number_only(this);" /></td>
						</tr>
						
						<?php if($mb["st_name"]){?>
						<tr>
							<th>상호명</th>
							<td><input type="text" name="st_name" id="st_name" value="<?php echo $mb['st_name']; ?>" class="adm-input01 grid_100"  /></td>
						</tr>
						<tr>
						    <th>상호구분</th>
						    <td><input type="text" name="mb_10" id="mb_10" value="<?php echo $mb['mb_10']; ?>" class="adm-input01 grid_100"  /></td>
						</tr>
						<tr>
							<th>사업자구분</th>
							<td><input type="text" name="st_chk" id="st_chk" value="<?php echo $mb['st_chk']; ?>" class="adm-input01 grid_100"  /></td>
						</tr>
						<?php if($mb['st_chk']=='법인사업자'){?>
                        <tr>
							<th>법인등록번호</th>
							<td><input type="text" name="st_mb_name" id="st_mb_name" value="<?php echo $mb['st_mb_name']; ?>" class="adm-input01 grid_100"  /></td>
						</tr>   
                        <?php    }
                        ?>
						<tr>
							<th>대표자</th>
							<td><input type="text" name="st_mb_name" id="st_mb_name" value="<?php echo $mb['st_mb_name']; ?>" class="adm-input01 grid_100"  /></td>
						</tr>
						<tr>
							<th>종목-업태</th>
							<td><input type="text" name="st_mb_name" id="st_mb_name" value="<?php echo $mb['st_sector']." - ".$mb['st_business']; ?>" class="adm-input01 grid_100"  /></td>
						</tr>
						<tr>
							<th>사업장 소재지</th>
							<td><input type="text" name="st_addr" id="st_addr" value="<?php echo $mb['st_addr']; ?>" class="adm-input01 grid_100"  /></td>
						</tr>
						<tr>
                            <th>사업자등록증</th>
                            <td>                          
                                <img src="<?php echo G5_DATA_URL."/store/".$mb['registration']; ?>" alt="image" />                            
                            </td>
					    </tr>
					    <?php }?>
						<tr>
							<th>상태</th>
							<td>
							<?php if($mb['mb_leave_date']){ ?>
								탈퇴 (<?php echo date("Y년 m월 d일",strtotime($mb['mb_leave_date'])); ?>)
							<?php }else{ ?>
								<?php echo $mb['mb_intercept_date']?"정지 (".date("Y년 m월 d일",strtotime($mb['mb_intercept_date'])).")":"활성"; ?>
							<?php } ?>
								<a href="<?php echo G5_URL."/admin/member_stop.php?mb_no=".$mb_no; ?>" class="btn white bg_gray color_white font_size_12" style="padding:3px 7px;float:right">변경</a>
							</td>
						</tr>
						<tr>
						    <th>가맹신청현황</th>
                            <td>							
						    <?php if($is_admin){ ?>
								<a href="<?php echo G5_URL?>/admin/member_update_level.php?mb_no=<?=$mb_no?>" class="btn white bg_gray color_white font_size_12" style="padding:3px 7px;float:right;margin-left:10px;">가맹점취소</a>
								<a href="<?php echo G5_URL?>/admin/member_update_level.php?mb_no=<?=$mb_no?>&type=down" class="btn white bg_gray color_white font_size_12" style="padding:3px 7px;float:right">가맹점승인</a>
						    <?php }else if($mb['mb_1']=='1'){ ?>
								가맹신청 
								<a href="<?php echo G5_URL?>/admin/member_update_level.php?mb_no=<?=$mb_no?>" class="btn white bg_gray color_white font_size_12" style="padding:3px 7px;float:right">승인</a>
							<?php }else if($mb["mb_1"]==2||$mb["mb_level"]==4){ ?>
								가맹점
							<?php }else{ ?>
								미신청
							<?php }?>
				            </td>
						</tr>
						<tr>
							<th>가입일</th>
							<td>
							<?php echo date("Y.m.d H:i",strtotime($mb['mb_datetime'])); ?>
							</td>
						</tr>
						<tr>
							<th>최종접속일</th>
							<td>
							<?php echo date("Y.m.d H:i",strtotime($mb['mb_today_login'])); ?>
							</td>
						</tr>
					</table>
					<div class="grid_100 mt20 text-center">
						<a href="<?php echo G5_URL."/admin/member_list.php"; ?>" class="btn adm-btn01" style="background:#aaa;">취소</a>
						<input type="submit" value="수정" id="btn_submit" class="btn adm-btn01" accesskey="s">
					</div>
				</form>
			</div>
		</article>
	</section>
</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
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

<script type="text/javascript">
    $(function(){ 
    $("#postcodify_search_button").postcodifyPopUp(); 
});
	function fregisterform_submit(f){
		if (f.mb_password.value.length > 0) {
            if (f.mb_password.value.length < 8) {
                alert("비밀번호를 8글자 이상 입력하십시오.");
                f.mb_password.focus();
                return false;
            }
        }
		 // E-mail 검사
        if ((f.mb_email.defaultValue != f.mb_email.value)) {
            var msg = reg_mb_email_check();
            if (msg) {
                alert(msg);
                f.reg_mb_email.select();
                return false;
            }
        }
		
		if (f.mb_name.value.length < 1) {
			alert("이름을 입력하십시오.");
			f.mb_name.focus();
			return false;
		}
		// 휴대폰번호 체크
        //var msg = reg_mb_hp_check();
        //if (msg) {
        //    alert(msg);
        //    f.reg_mb_hp.select();
        //    return false;
        //}
	}
</script>
<?php
	include_once(G5_PATH."/admin/tail.php");
?>
