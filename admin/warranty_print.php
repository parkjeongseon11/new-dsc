<?php 
include_once("../common.php");

include_once("../head.sub.php");

$ua = getBrowser();
if ($ua['name'] == 'Internet Explorer') { $browser = true; }

$sql = "select * from `rutilo_warranty` where id = {$id}";

$view = sql_fetch($sql);

switch($view["program"]){
	case "1":
		$program = "G1";
		break;
	case "2":
		$program = "G2";
		break;
	case "3":
		$program = "G3";
		break;
	/*case "4":
		$program = "Step4";
		break;
	case "5":
		$program = "Step5";
		break;*/
	case "6":
		$program = "G6";
		break;
	/*case "7":
		$program = "Step7";
		break;*/
}

?>
<style type="text/css">
	#print_area{position:relative;font-family:"malgun gothic","Nanum Gothic",sans-serif;}
	.one {width:100%;/*margin:10px 0 0 0*/}
	.one td.img{text-align:center;padding:80px 0;}
	.one td.img img{margin-bottom:10px;width:400px}
	.one td.img h3{font-size:30px;letter-spacing:5px;padding:20px 0;}
	.one td.img div{width:50%;border-top:4px double #000;margin:0 auto;padding: 10px 0 0 0;}
	.one td.img div p{letter-spacing:8px;margin-top:-15px;}
	.one td.line{border-bottom:3px solid #fe1e1e}
	#print_area .print_con{padding:60px 50px 10px 50px;}
	#print_area .print_con p{color:#444;font-size:10px;padding:2px 0}
	.program{width:100%;margin-bottom:30px;}
	.program td h3{font-weight: normal;color:#fe1e1e;}
	.program td ul{margin:10px 0 30px 0}
	.program td li{border-bottom:1px dashed #ccc;padding:5px 0;font-size:13px;letter-spacing:-0.8px}
	.program td li span{font-weight:bold;color:#fe1e1e}
	.info{width:100%;border:4px double #fe1e1e}
	.info th{width:120px;padding:5px 0;color:#000;margin:10px;border-bottom:1px solid #ddd;border-right:1px solid #ddd;border-left:1px solid #ddd;font-weight:500;font-size:14px}
	.info tr.top{border-top:4px double #fe1e1e}
	.info td{padding:5px 10px;color:#000;border-bottom:1px solid #ddd;letter-spacing:-0.5px;font-size:14px}
	.info td.title{width:20px;color:#000;text-align:center}
	.info td.sec{background:none;}
	.print_con h3{font-weight: normal;color:#fe1e1e;padding:0 0 10px 0}
	.print_con img{position:absolute;top:50%;left:50%;margin-top:40px;margin-left:-250px;width:500px;opacity: 0.1;filter: alpha(opacity=10);}

	#non-printable{text-align:center;padding:20px 0;}
	#non-printable input{width:120px;padding:5px 0;background:#fe1e1e; color:#fff;border:none;}
	@media print {
		@page {
			size:auto;
			margin-top:0cm;
			margin-right:0cm;
			margin-bottom:0cm;
			margin-left:0cm;
		}
		#print_area{position:relative;font-family:"malgun gothic","Nanum Gothic",sans-serif;}
		.one {width:100%;/*margin:10px 0 0 0*/}
		.one td.img{text-align:center;padding:80px 0;}
		.one td.img img{margin-bottom:10px;width:400px}
		.one td.img h3{font-size:30px;letter-spacing:5px;padding:20px 0;}
		.one td.img div{width:50%;border-top:4px double #000;margin:0 auto;padding: 10px 0 0 0;}
		.one td.img div p{letter-spacing:8px;margin-top:-15px;}
		.one td.line{border-bottom:3px solid #fe1e1e}
		#print_area .print_con{padding:60px 50px 10px 50px;}
		#print_area .print_con p{color:#444;font-size:10px;padding:2px 0}
		.program{width:100%;margin-bottom:30px;}
		.program td h3{font-weight: normal;color:#fe1e1e;}
		.program td ul{margin:10px 0 30px 0}
		.program td li{border-bottom:1px dashed #ccc;padding:5px 0;font-size:13px;letter-spacing:-0.8px}
		.program td li span{font-weight:bold;color:#fe1e1e}
		.info{width:100%;border:4px double #fe1e1e}
		.info th{width:120px;padding:5px 0;color:#000;margin:10px;border-bottom:1px solid #ddd;border-right:1px solid #ddd;border-left:1px solid #ddd;font-weight:500;font-size:14px}
		.info tr.top{border-top:4px double #fe1e1e}
		.info td{padding:5px 10px;color:#000;border-bottom:1px solid #ddd;letter-spacing:-0.5px;font-size:14px}
		.info td.title{width:20px;color:#000;text-align:center}
		.info td.sec{background:none;}
		.print_con h3{font-weight: normal;color:#fe1e1e;padding:0 0 10px 0}
		.print_con img{position:absolute;top:50%;left:50%;margin-top:40px;margin-left:-250px;width:500px;opacity: 0.1;filter: alpha(opacity=10);}

		#non-printable{text-align:center;padding:20px 0;}
		#non-printable input{width:120px;padding:5px 0;background:#fe1e1e; color:#fff;border:none;}
	}
</style>
<div id="print_area">
	<table class="one">
		<tr>
			<td class="img" colspan="4">
				<img src="<?php echo G5_IMG_URL?>/print_logo.png" alt="" />
				<div>
					<h3>루틸로 전자보증서</h3>
					<p>WARRANTY BOOKLET</p>
				</div>
			</td>
		</tr>
		<tr>
			<td class="line" colspan="4">			
			</td>
		</tr>
	</table>
	<div class="print_con">
		<table class="program">
			<tr>
				<td>
					<h3>· 루틸로 시공 서비스 안내</h3>
				</td>
			</tr>
			<tr>
				<td>
					<ul>
						<li><span>G1</span>&nbsp;&nbsp;G1(나노세라믹 베이스)</li>
						<li><span>G2</span>&nbsp;&nbsp;G2(나노세라믹 탑코드)</li>
						<li><span>G3</span>&nbsp;&nbsp;G3(프리미엄 슈퍼하이드로포빅)</li>
						<li><span>G6</span>&nbsp;&nbsp;G6(하이퍼하이드로포빅)</li>
						<!-- <li><span>Step5</span>&nbsp;&nbsp;G1(나노세라믹 베이스) + G3(슈퍼 하이드로 포빅) + 세라믹 코트 401</li>
						<li><span>Step6</span>&nbsp;&nbsp;(G4-G5)본드 + G1(나노세라믹 베이스) + G2(하이드로 포빅) + 세라믹 코트 401</li>
						<li><span>Step7</span>&nbsp;&nbsp;(G4-G5)본드 + G1(나노세라믹 베이스) + G3(슈퍼 하이드로 포빅) + 세라믹 코트 401</li> -->
					</ul>
				</td>
			</tr>
		</table>
		<h3>· 고객정보 <span style="color:#000;float:right;font-size:18px">No. <?php echo $view['serial']; ?> </span></h3>
		<div style="clear:both"></div>
		<table class="info">
			<colgroup>
				<col style="width:20px"/>
				<col style="width:120px"/>
				<col style="width:240px"/>
				<col style="width:120px"/>
				<col style="width:160px"/>
			</colgroup>
			<tr>
				<td rowspan="8" class="title">고객용</td>
			</tr>
			<tr class="top">
				<th>차종</th>
				<td ><?=$view["car"]?></td>
				<th>시공점</th>
				<td class="sec"><?=$view["center_name"]?></td>
			</tr>
			<tr>
				<th>색상</th>
				<td ><?=$view["car_color"]?></td>
				<th>시공일자</th>
				<td class="sec"><input type="text" value="<?=$view["sign_date"]?>" style="border:none"/></td>
			</tr>
			<tr>
				<th>차량번호</th>
				<td ><?=$view["car_number"]?></td>
				<th>시공점 연락처</th>
				<td class="sec"><?=$view["manager"]?></td>
			</tr>
			<tr>
				<th>시공 서비스</th>
				<td class="sec"><?=$program?></td>
				<th>시공 비용</th>
				<td class="sec">￦<input type="text" style="border:none;letter-spacing:-0.3px;width:130px;vertical-align:top;" class="input" value="<?php echo $view["price"]?>" placeholder="가격입력" onkeyup="number_only(this);"/> </td>
			</tr>
			<tr>
				<th>고객명</th>
				<td ><?=$view["user_name"]?></td>
				<th>연락처</th>
				<td class="sec"><?=hyphen_hp_number($view["user_tel"])?></td>
			</tr>
			<tr>
				<th>이메일</th>
				<td class="sec" colspan="3"><?=$view["user_email"]?></td>
			</tr>
			<tr>
				<th>주소</th>
				<td class="sec" colspan="3"><?php echo "(".$view["user_zip"].")".$view["user_addr1"]." ".$view["user_addr2"];?></td>
			</tr>
		</table>
		<br>
		<p style="letter-spacing:-0.2px"><span>대표 문의 :</span> TEL 1577-6074 / WEB www.rutilo.co.kr</p>
		<p style="letter-spacing:-0.2px">* 본 보증서를 소유하지 않을 경우에는 서비스를 받으실 수 없으므로 보관에 유의하시기 바랍니다.</p>
		<img src="<?php echo G5_IMG_URL?>/print_logo_2.png" alt="" />
	</div>
	<div id="non-printable">
		<input type="button" value="인쇄" onclick="printPage();" />
	</div>
</div>
<object id="factory" viewastext style="display:none"
   classid="clsid:1663ed61-23eb-11d2-b92f-008048fdd814"
   codebase="http://rutilo.co.kr/smsx.cab#Version=8,0,0,56">
</object>
<script type="text/javascript">

function printPage(){
	hidden();
	var initBody;
	window.onbeforeprint = function(){
		initBody = document.body.innerHTML;
		document.body.innerHTML =  document.getElementById('printable').innerHTML;
	};
	window.onafterprint = function(){
		document.body.innerHTML = initBody;
	};
	
	window.print();
	view();
	return false;
}
function hidden(){
	$("#non-printable").css("display","none");
}
function view(){
	$("#non-printable").css("display","block");
}
function printPageIe(){ 
	hidden();
	factory.printing.header = "";  //머릿말 설정 
	factory.printing.footer = "";    //꼬릿말 설정 
	factory.printing.portrait = true;  //출력방향 설정: true-가로, false-세로 
	factory.printing.leftMargin = 0;  //왼쪽 여백 설정 
	factory.printing.topMargin = 0;  //위쪽 여백 설정 
	factory.printing.rightMargin = 0;  //오른쪽 여백 설정 
	factory.printing.bottomMargin = 0;  //아래쪽 여백 설정 
	a = factory.printing.Print(true);  //출력하기 

	view();
}
</script>

