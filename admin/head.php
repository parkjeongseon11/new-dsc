<?php
if(!$is_admin){
	alert("관리자만 접속 가능합니다.",G5_URL);
}
?>
<!doctype html>
<html lang="en">
	<head>
		<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=0,maximum-scale=1.0,user-scalable=yes">
		<meta http-equiv="X-UA-Compatible" content="IE=10,chrome=1">
		<link rel="apple-touch-icon" sizes="57x57" href="<?php echo G5_IMG_URL?>/apple-icon-57x57.png">
		<link rel="apple-touch-icon" sizes="60x60" href="<?php echo G5_IMG_URL?>/apple-icon-60x60.png">
		<link rel="apple-touch-icon" sizes="72x72" href="<?php echo G5_IMG_URL?>/apple-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="76x76" href="<?php echo G5_IMG_URL?>/apple-icon-76x76.png">
		<link rel="apple-touch-icon" sizes="114x114" href="<?php echo G5_IMG_URL?>/apple-icon-114x114.png">
		<link rel="apple-touch-icon" sizes="120x120" href="<?php echo G5_IMG_URL?>/apple-icon-120x120.png">
		<link rel="apple-touch-icon" sizes="144x144" href="<?php echo G5_IMG_URL?>/apple-icon-144x144.png">
		<link rel="apple-touch-icon" sizes="152x152" href="<?php echo G5_IMG_URL?>/apple-icon-152x152.png">
		<link rel="apple-touch-icon" sizes="180x180" href="<?php echo G5_IMG_URL?>/apple-icon-180x180.png">
		<link rel="icon" type="image/png" sizes="192x192"  href="<?php echo G5_IMG_URL?>/android-icon-192x192.png">
		<link rel="icon" type="image/png" sizes="32x32" href="<?php echo G5_IMG_URL?>/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="96x96" href="<?php echo G5_IMG_URL?>/favicon-96x96.png">
		<link rel="icon" type="image/png" sizes="16x16" href="<?php echo G5_IMG_URL?>/favicon-16x16.png">
		<title>관리자페이지</title>
		<link href="<?php echo G5_CSS_URL; ?>/owl.carousel.css" type="text/css" rel="stylesheet" />
		<link href="<?php echo G5_CSS_URL; ?>/style.css" type="text/css" rel="stylesheet" />
		<link href="<?php echo G5_CSS_URL; ?>/admin.css" type="text/css" rel="stylesheet" />
		<!-- 웹폰트 -->
		<link href='http://fonts.googleapis.com/earlyaccess/nanumgothic.css' rel='stylesheet' type='text/css'>
		<!--[if lt IE 9]>
			<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="<?php echo G5_JS_URL ?>/common.js"></script>
		<script src="<?php echo G5_JS_URL ?>/wrest.js"></script>
		<!-- <script src="<?php echo G5_JS_URL ?>/webtoolkit.base64.js"></script> -->
		<script src="<?php echo G5_JS_URL ?>/script.js"></script>
		<script src="<?php echo G5_JS_URL ?>/owl.carousel.js"></script>
		<style type="text/css">
		@charset "utf-8";
		/* SIR 지운아빠 */

		/* 방문자 집계 */
		#visit {border-bottom:1px dotted #666;border-top:1px dotted #666;background:#434343;}
		#visit div {margin:0 auto;width:202px;zoom:1}
		#visit div:after {display:block;visibility:hidden;clear:both;content:""}
		#visit dl {float:left;margin:0 0 0 10px;padding:0}
		#visit dt {float:left;margin:0;padding:10px 0 10px;font-size:12px;}
		#visit dd {float:left;margin:0 30px 0 0;padding:10px;font-size:12px;}
		#visit a {display:inline-block;padding:10px;text-decoration:none}
		#visit a:focus, #visit a:hover {}
		#visit br (display:block;)

		.tbl_head01 {padding:10px;}
		.tbl_head01 .current_connect_tbl{width:100}
		.tbl_head01 .current_connect_tbl td{padding:10px;}
		</style>
		<script>
		// 자바스크립트에서 사용하는 전역변수 선언
		var g5_url       = "<?php echo G5_URL ?>";
		var g5_bbs_url   = "<?php echo G5_BBS_URL ?>";
		var g5_is_member = "<?php echo isset($is_member)?$is_member:''; ?>";
		var g5_is_admin  = "<?php echo isset($is_admin)?$is_admin:''; ?>";
		var g5_is_mobile = "<?php echo G5_IS_MOBILE ?>";
		var g5_bo_table  = "<?php echo isset($bo_table)?$bo_table:''; ?>";
		var g5_sca       = "<?php echo isset($sca)?$sca:''; ?>";
		var g5_editor    = "<?php echo ($config['cf_editor'] && $board['bo_use_dhtml_editor'])?$config['cf_editor']:''; ?>";
		var g5_cookie_domain = "<?php echo G5_COOKIE_DOMAIN ?>";
		<?php
		if ($is_admin) {
			echo 'var g5_admin_url = "'.G5_ADMIN_URL.'";'.PHP_EOL;
		}
		?>
		</script>
		<style type="text/css">
			.adm-table02 table th{width:160px;}
			@media all and (max-width: 1120px){
				body{background:none;}
				aside{width:100%;height:106px;padding:0;background:#434343;position:relative;}
				header{margin-bottom:0;padding:20px 0;}
				header > a{margin:0 auto;position:relative;}
				header > div{text-align:right;position:absolute;right:20px;top:20px;}
				#copy{display:none;}
				#admin-menu{width:100%;height:48px;margin-top:5px;}
				#admin-menu li{width:16.6%;float:left;text-align:center;}
				.list-title{font-size:14px;}
				#visit{display:none;}
				.list-item{background:#434343;}
				.list-item div{text-align:center;text-indent:0;}
				#wrap > section{margin:0;padding:20px;}
			}
			@media all and (max-width: 900px){
				.md_none{display:none !important;}
				#admin-menu{height:96px;}
				#admin-menu li{width:33.33%;}
				aside{height:210px;}
				.list-item{position:absolute;width:33.33%;}
				#admin-title h1{font-size:24px;}
				#admin-title{margin-bottom:0;padding-top:0;}
				.adm-btn01{line-height:30px;height:30px;font-size:14px;}
			}
			@media all and (max-width: 480px){
				header{padding-top:30px;}
				header > div{top:10px;right:10px;font-size:11px;}
				aside{height:216px;}
				.list-title{font-size:13px;}
				#wrap > section{padding:10px;}
				.adm-table02 table th{width:30%;padding:10px;font-size:12px;}
				.adm-table02 table td{padding:7px;font-size:11px;}
				#admin-title{padding:10px 0;margin-bottom:0;}
				#admin-title hr{margin:0;padding:0;}
				#admin-title h1{font-size:20px;}
				.adm-table01 table th{font-size:12px;height:35px;}
				.adm-table01 table td{font-size:11px;height:30px;}
				.adm-btn01{line-height:25px;height:25px;font-size:12px;}
			}
		</style>
	</head>
	<?
	include_once(G5_LIB_PATH.'/visit.lib.php');
	include_once(G5_LIB_PATH.'/connect.lib.php');
	?>
	<body>
		<div class="modal"></div>
		<div class="small_modal"></div>
		<div class="msg"></div>
		<!-- 메뉴 start -->
		<aside>
			<header>
				<a href="<?php echo G5_URL; ?>/admin/index.php">관리자페이지</a>
				<div><a href="<?php echo G5_URL; ?>">홈페이지</a><span>|</span><a href="<?php echo G5_BBS_URL."/logout.php"; ?>">로그아웃</a></div>
			</header>
			<ul data-accordion-group id="admin-menu">
				 <li class="accordion" data-accordion>
					<div data-control class="list-title">메인/서브페이지 관리</div>
					<div data-content class="list-item">
						<div><a href="<?php echo G5_URL."/admin/slide_main.php"; ?>">메인페이지</a></div>
						<div><a href="<?php echo G5_URL."/admin/slide_list.php"; ?>">서브페이지</a></div>
						<div><a href="<?php echo G5_URL."/admin/promotion_list.php"; ?>">홍보영상</a></div>
					</div>
				</li>
				<li class="accordion" data-accordion>
					<div data-control class="list-title">제품페이지</div>
					<div data-content class="list-item">
<!--						<div><a href="<?php echo G5_URL."/admin/long.php"; ?>">가격관리</a></div>-->
						<div><a href="<?php echo G5_URL."/admin/model_list.php"; ?>">제품관리</a></div>
						<div><a href="<?php echo G5_URL."/admin/reserve_list.php"; ?>">주문관리</a></div>
<!--						<div><a href="<?php echo G5_URL."/admin/car_list.php"; ?>">차량관리</a></div>-->
					</div>
				</li>
				<li class="accordion" data-accordion>
					<div class="list-title" style="background:none;"><a href="<?php echo G5_URL."/admin/construction_list.php"; ?>">시공방법관리</a></div>
				</li>
				<li class="accordion" data-accordion>
					<div data-control class="list-title">가맹점 및 센터 관리</div>
					<div data-content class="list-item">
						<div><a href="<?php echo G5_URL."/admin/partner_list.php"; ?>">디테일링서비스</a></div>
						<div><a href="<?php echo G5_URL."/admin/center_list.php"; ?>">트레이닝센터</a></div>
						<div><a href="<?php echo G5_URL."/admin/franchisee_list.php"; ?>">가맹점문의</a></div>
					</div>
				</li>
				<li class="accordion" data-accordion>
					<div data-control class="list-title">게시판관리</div>
					<div data-content class="list-item">
						<div><a href="<?php echo G5_URL."/admin/board_list.php?bo_table=notice"; ?>">공지사항</a></div>
						<div><a href="<?php echo G5_URL."/admin/board_list.php?bo_table=review"; ?>">구매후기</a></div>
					</div>
				</li>
				<li class="accordion" data-accordion>
					<div data-control class="list-title">문의사항관리</div>
					<div data-content class="list-item">
						<div><a href="<?php echo G5_URL."/admin/board_list.php?bo_table=qna"; ?>">QnA</a></div>
						<div><a href="<?php echo G5_URL."/admin/board_list.php?bo_table=questions"; ?>">1:1문의</a></div>
						<div><a href="<?php echo G5_URL."/admin/board_list.php?bo_table=faq"; ?>">FAQ</a></div>
					</div>
				</li>
                <!-- <li class="accordion" data-accordion>
					<div class="list-title" style="background:none;"><a href="<?php echo G5_URL."/admin/center_list.php"; ?>">트레이닝 센터</a></div>
					<!-- <div data-content class="list-item">
						<!-- <div><a href="<?php echo G5_URL."/admin/trainer_list.php"; ?>">트레이너</a></div>			
						<div><a href="<?php echo G5_URL."/admin/center_list.php"; ?>">트레이닝 센터</a></div>
					</div> 
				</li> -->
				<!-- <li class="accordion" data-accordion>
					<div class="list-title" style="background:none;"><a href="<?php echo G5_URL."/admin/construction_list.php"; ?>">홍보영상</a></div>
				</li> -->
				
				<li class="accordion" data-accordion>
					<div class="list-title" style="background:none;"><a href="<?php echo G5_URL."/admin/warranty_list.php"; ?>">전자보증서</a></div>
				</li>
				<li class="accordion" data-accordion>
					<div class="list-title" style="background:none;"><a href="<?php echo G5_URL."/admin/member_list.php"; ?>">회원관리</a></div>
				</li>
			
<!--
				<li class="accordion" data-accordion>
					<div class="list-title" style="background:none;"><a href="<?php echo G5_URL."/admin/reserve_list.php"; ?>">예약관리</a></div>
				</li>
				<li class="accordion" data-accordion>
					<div class="list-title" style="background:none;"><a href="<?php echo G5_URL."/admin/push.php"; ?>">이벤트 푸시 보내기</a></div>
				</li>
-->
				<li class="accordion last-item" data-accordion>
					<div><?=visit("basic")?></div>
					<div><?=connect("basic")?></div>
				</li>
			
			</ul>
			<div id="copy">&copy; 루틸로 All Rights Reserved.</div>
		</aside>
		<!-- 메뉴 end -->