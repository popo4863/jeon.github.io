<?php
	session_start();	
	include_once("../config.php");
?>	
<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="euc-kr" />
	<!-- <meta name="viewport" content="width=device, initial-scale=1.0" /> -->
	<meta http-equiv="X-UA-Compatible" content="ie-edge" />
	<meta name="robots" content="noindex, nofollow" />
	<meta name="googlebot" content="noindex, nofollow" />
	
	<title>에이델</title>
	
	<link href="css/market.css" , rel="stylesheet" , type="text/css" />
	<link href="../css/reset/reset.css" , rel="stylesheet" , type="text/css" />
	
	<!-- 슬라이드 JavaScript -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.1/js/swiper.min.js"></script>	
	<!-- 슬라이드 스크립트 -->		
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.1/css/swiper.min.css">
	<link rel="stylesheet" href="../css/slide/slide.css">	
</head>
<body>
	<header>
		<nav class="menu">
			<ul>
			<a href="/"><img src="../image/logo/Aidel.png" class="logo" alt="로고"/></a>			
				<li>
					<a href="/notice.php">에이델소식</a>
					<ul>
						<li><a href="/notice.php">공지사항</a></li>
						<li><a href="/update.php">업데이트</a></li>
						<li><a href="/event.php">이벤트</a></li>
						<li><a href="/developed.php">개발예정사항</a></li>
					</ul>					
				</li>
				<li>
					<a href="/guide.php">가이드북</a>						
				</li>
				<li>
					<a href="/ranking_slayer.php">종족순위</a>
					<ul>
						<li><a href="/ranking_slayer.php">슬레이어</a></li>
						<li><a href="/ranking_vampire.php">뱀파이어</a></li>
						<li><a href="/ranking_ousters.php">아우스터즈</a></li>
					</ul>					
				</li>
				<li>
					<a href="/market/market.php">에이델상점</a>		
					<ul>
						
					</ul>										
				</li>
				<li>
					<a href="/download.php">다운로드</a>
				</li>
				<li>
					<a href="/faq.php">고객센터</a>			
				</li>
			</ul>
		</nav>
	</header>
	
	<section>
		<article>	
			<div id="section1">
				<div class="swiper-container">
					<div class="swiper-wrapper">
						<!-- 첫 번째 이미지 -->
						<div class="swiper-slide">
							<!-- 이미지 -->
							<a href=""><img src="../image/marketslide/3.jpg" class="logo" width="737px" alt="로고"/></a>
						</div>	
						<!-- 두 번째 이미지 -->
						<div class="swiper-slide">
							<a href=""><img src="../image/marketslide/1.jpg" class="logo" width="737px" alt="로고"/></a>	
						</div>
						<!-- 세 번째 이미지 -->
						<div class="swiper-slide">
							<a href=""><img src="../image/marketslide/2.jpg" class="logo" width="737px" alt="로고"/></a>	
						</div>						
					</div>
					<!-- 페이징 -->
					<div class="swiper-pagination"></div>
					<div class="swiper-button-next"></div>
					<div class="swiper-button-prev"></div>
				</div>
				
				<div class="download">
					<a href="https://drive.google.com/file/d/1cIE2emn1zsXh6zzVTyfERUMCq208dLwB/view?usp=sharing" target="_blank"><img src="../image/download/download1.png" onmouseover="this.src='../image/download/download2.png'" onmouseout="this.src='../image/download/download1.png'" alt="다운로드"/></a>
				</div>

				<div class="login-box">				
					<?php
					// Connect to the database
					$link = @mysql_connect($HOST, $USER, $PASSWORD);
					if (!$link) 
					{
						$error = "Error!";
						$error .= mysql_errno() . ": " . mysql_error();
						die($error);
					}
					// Select the database
					$db = @mysql_select_db($DBNAME);
					if (!$db) 
					{
						$error = "Error!";
						$error .= mysql_errno() . ": " . mysql_error();
						die($error);
					}
					//************************
					$user_id = $_SESSION['user_id'];
					$Player = mysql_query("SELECT * FROM `Player` WHERE `PlayerID` = '$user_id'");
					
					$row = mysql_fetch_array( $Player );
					
					if($_SESSION['user_id'])
					{
					?>
					<p class="user"><img src="../image/name.png" class="name_img"><?php echo $_SESSION['user_id']; ?>님 반갑습니다</p>
					<p class="point">내 포인트　<?php echo $row['point']; ?></p>		
					<img src="../image/login/logout.png" class="logout" title="로그아웃" onclick="return doLogout();">
					<script>
					function doLogout() {
						{
							self.location = '/logout.php';
						}
					}
					</script>
					<?
					}
					else
					{
					?>
					<script> 
						function login_submit(f) {
							if (!f.mb_id.value) {
								alert("아이디를 입력해주세요");
								f.mb_id.focus();
								return false;
							}
							if (!f.mb_password.value) {
								alert("비밀번호를 입력해주세요");
								f.mb_password.focus();
								return false;
							}
							f.userid.value = f.mb_id.value;
							f.userpw.value = f.mb_password.value;
							f.action = '../login.php';
						}
					</script> 	
					<div class="login-box-input">
						<h1> LOGIN </h1>
						<form name="login_start" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" onsubmit="return login_submit(document.login_start);" autocomplete="off" enctype="multipart/form-data">
							<input type="hidden" name="userid" value="">
							<input type="hidden" name="userpw" value="">
							
							<input type="text" name="mb_id" class="user-id" onclick="javascript:this.value='';" onfocus="javascript:this.value='';" value="" placeholder=" 아이디"/ onfocus="javascript:this.value='';" tabindex="1" onclick="javascript:this.value='';" class="back">
							<input type="password" name="mb_password" class="user-pw" onclick="javascript:this.value='';" onfocus="javascript:this.value='';" value="" placeholder=" 비밀번호"/>	

							<input type="image" src="../image/login/loginbut.png"/ class="login_btn">
						</form>
						
						<a href="../register.php"><span class="register">Create Your Account →</span></a>
					</div>
					<?php
					}
					?>
				</div>	
			</div>
		</article>
	</section>
	<section>	
		<article>
			<div id="section2">
				<a href="#"><img src="../image/marketslide/sub1.jpg" class="event1" alt="이벤트"></a>	
			</div>
		</article>
	</section>
	<section>
		<article class="board">
			<div id="section3">
				<div class="market_menu_set">
					<a href="market.php"><span class="market_menu">슬레이어</span></a>
					<a href="vampire_market.php"><span class="market_menu"style="font-weight:900;">뱀파이어</span></a>
					<a href="ousters_market.php"><span class="market_menu">아우스터즈</span></a>					
					<a href="market_common.php"><span class="market_menu">공용</span></a>
				</div>
				
				<div class="market_item">
					<div class="item_image">
						<a href="vampire/v_market_corezap1.php"><img src="item/core.png" width="160px" alt="도슬레이어"/></a>
						<p class="item_text"><a href="vampire/v_market_corezap1.php">날카로운 티포쥬 조각</a></p>
						<p class="item_price"><a href="vampire/v_market_corezap1.php">12 , 900원</a></p>
					</div>
					<div class="item_image">
						<a href="vampire/v_market_corezap2.php"><img src="item/core.png" width="160px" alt="검슬레이어"/></a>
						<p class="item_text"><a href="vampire/v_market_corezap2.php">얼음의 영혼이 깃든 조각</a></p>
						<p class="item_price"><a href="vampire/v_market_corezap2.php">12 , 900원</a></p>
					</div>
					<div class="item_image">
						<a href="vampire/v_market_do1.php"><img src="item/coin.png" width="160px" alt="도슬레이어"/></a>
						<p class="item_text"><a href="vampire/v_market_do1.php">바토리의 천 돈</a></p>
						<p class="item_price"><a href="vampire/v_market_do1.php">￦2 , 000원</a></p>
					</div>
					<div class="item_image">
						<a href="vampire/v_market_do2.php"><img src="item/coin.png" width="160px" alt="검슬레이어"/></a>
						<p class="item_text"><a href="vampire/v_market_do2.php">바토리의 오천 돈</a></p>
						<p class="item_price"><a href="vampire/v_market_do2.php">5 , 000원</a></p>
					</div>
					<div class="item_image">
						<a href="vampire/v_market_do3.php"><img src="item/coin.png" width="160px" alt="총슬레이어"/></a>
						<p class="item_text"><a href="vampire/v_market_do3.php">바토리의 만 돈</a></p>
						<p class="item_price"><a href="vampire/v_market_do3.php">￦10 , 000원</a></p>
					</div>
					<div class="item_image">
						<a href="market_loading.php"><img src="item/vampire1.png" width="160px" alt="총슬레이어"/></a>
						<p class="item_text"><a href="market_loading.php">전투  3옵션  호루스  패키지</a></p>
						<p class="item_price"><a href="market_loading.php">￦170 , 000원</a></p>
					</div>
					<div class="item_image">
						<a href="market_loading.php"><img src="item/vampire2.png" width="160px" alt="총슬레이어"/></a>
						<p class="item_text"><a href="market_loading.php">마법  3옵션  호루스  패키지</a></p>
						<p class="item_price"><a href="market_loading.php">￦170 , 000원</a></p>
					</div>
					<div class="item_image">
						<a href="market_loading2.php"><img src="item/key.png" width="160px" alt="총슬레이어"/></a>
						<p class="item_text"><a href="market_loading2.php">옵션  체인지</a></p>
						<p class="item_price"><a href="market_loading2.php">￦10 , 000원</a></p>
					</div>
				</div>				
			</div>
		</article>
	</section>

	<footer>
		<div class="footer_bar">
			<a href="#">회사소개</a> | <a href="#">개인정보처리방침</a> | <a href="#">운영계획</a> | <a href="#">이용약관</a> | <a href="#">고객센터</a>
		</div>
		
		<div id="footer">
			<div class="footer_text footer_box">
				<dl><dd><img src="../image/logo/footer.png" alt="푸터 로고" class="footer_icon"></dd></dl>
				<dl>
					<dd>AIDEL ONLINE /</dd>
					<dd>고객센터 : 1600-1600</dd>
				</dl>
				<dl>
					<dd>E-mail : popo486312@nate.com /</dd>
					<dd>사업자 등록번호 : 123-45-67890호 /</dd>
					<dd>통신판매업 신고번호:제2017-분당-1342호</dd>
				</dl>
				<dl>
					<dd>Copyright ⓒ AIDEL ENTERTAINMENT. ALL RIGHTS RESERVED.</dd>
				</dl>	
			</div>
		</div>
	</footer>
</body>

<script>
	// Swiper
	var swiper = new Swiper('.swiper-container', {
		loop: true, // 무한 루프
		effect: 'fad2e', //이펙트 페이드로 넣어서 흐려지게
		slidesPerView: 1,
		pagination: {
			el: '.swiper-pagination',
			clickable : true, // 슬라이드 동그라미 클릭 가능하게
		},
		autoplay: {
			delay: 6000, // 6초 마다 옆으로 이동
		},
		navigation: {
			prevEl: '.swiper-button-prev',
			nextEl: '.swiper-button-next',
		},
	});
</script>
</html>