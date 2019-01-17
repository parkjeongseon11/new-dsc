<?php
	include_once("../common.php");
	include_once(G5_PATH."/admin/head.php");
	if($id){
		$write=sql_fetch("select * from `g5_member` where id='".$id."'");
	}
?>
<!-- 본문 start -->
<div id="wrap">
	<section>
		<header id="admin-title">
			<h1>가맹점등록</h1>
			<hr />
		</header>
		<article id="admin_academy_write">
			<form action="<?php echo G5_URL."/admin/member_update.php"; ?>" name="branch_form" id="branch_form" method="post" enctype="multipart/form-data">
				<input type="hidden" name="id" value="<?php echo $id; ?>" />
				<input type="hidden" name="page" value="<?php echo $page; ?>" />
				<input type="hidden" name="search" value="<?php echo $search; ?>" />
				<div class="adm-table02">
					<table>
						<tr>
							<th>상호 *</th>
							<td><input type="text" name="name" id="name" required class="adm-input01 grid_100" value="<?php echo $write['cate']; ?>" /></td>
						</tr>
						<tr>
							<th>구분 *</th>
							<td><input type="text" name="cate" id="cate" required class="adm-input01 grid_100" value="<?php echo $write['cate']; ?>" /></td>
						</tr>
				        <tr>
							<th>주소</th>
							<td>
							<input type="hidden" name="jibun" id="jibunaddress" />
							<input type="hidden" name="lat" id="lat" />
							<input type="hidden" name="lng" id="lng" />
							<input type="text" name="addr" id="sample3_postcode" required readonly class="adm-input01 grid_100 postcodify_postcode5"  value="<?php echo $write['zipcode']; ?>" placeholder="우편번호"/>		<div id="wraps" style="display:none;border:1px solid;width:500px;height:300px;margin:5px 0;position:relative">
								<img src="//t1.daumcdn.net/localimg/localimages/07/postcode/320/close.png" id="btnFoldWrap" style="cursor:pointer;position:absolute;right:0px;top:-1px;z-index:1" onclick="foldDaumPostcode()" alt="접기 버튼">
							</div>					
							<input type="text" name="addr2" id="sample3_address" required readonly class="adm-input01 grid_100 postcodify_address" value="<?php echo $write['addr']; ?>" placeholder="주소"/>
							<input type="text" name="addr3" id="sample3_address2" required class="adm-input01 grid_100 postcodify_details" value="<?php echo $write['addr2']; ?>" placeholder="상세주소"/>
							<input type="button" class="adm-btn01" id="postcodify_search_button" value="우편번호 찾기" style="background:#898989" onclick="sample3_execDaumPostcode()">


							<!-- <input type="text" name="addr" id="sample3_postcode" required readonly class="adm-input01 grid_100 postcodify_postcode5"  value="<?php echo $write['zipcode']; ?>" placeholder="우편번호"/>		<div id="wraps" style="display:none;border:1px solid;width:500px;height:300px;margin:5px 0;position:relative">
								<img src="//t1.daumcdn.net/localimg/localimages/07/postcode/320/close.png" id="btnFoldWrap" style="cursor:pointer;position:absolute;right:0px;top:-1px;z-index:1" onclick="foldDaumPostcode()" alt="접기 버튼">
							</div>					
							<input type="text" name="addr2" id="sample3_address" required readonly class="adm-input01 grid_100 postcodify_address" value="<?php echo $write['addr']; ?>" placeholder="주소"/>
							<input type="text" name="addr3" id="sample3_address2" required class="adm-input01 grid_100 postcodify_details" value="<?php echo $write['addr2']; ?>" placeholder="상세주소"/>
							<input type="button" class="adm-btn01" id="postcodify_search_button" value="우편번호 찾기" style="background:#898989" onclick="sample3_execDaumPostcode()"> --><br>
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
