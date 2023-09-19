<?php
	session_start();	
	include_once("../../config.php");
?>	
<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="euc-kr" />
	<!-- <meta name="viewport" content="width=device, initial-scale=1.0" /> -->
	<meta http-equiv="X-UA-Compatible" content="ie-edge" />
	<meta name="robots" content="noindex, nofollow" />
	<meta name="googlebot" content="noindex, nofollow" />
	
	<title>���̵�</title>
	
	<link href="../css/market_detail.css" , rel="stylesheet" , type="text/css" />
	<link href="/css/reset/reset.css" , rel="stylesheet" , type="text/css" />
	
	<!-- �����̵� JavaScript -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.1/js/swiper.min.js"></script>	
	<!-- �����̵� ��ũ��Ʈ -->		
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.1/css/swiper.min.css">
	<link rel="stylesheet" href="/css/slide/slide.css">	
</head>
<body>
	<header>
		<nav class="menu">
			<ul>
			<a href="/"><img src="/image/logo/Aidel.png" class="logo" alt="�ΰ�"/></a>			
				<li>
					<a href="/notice.php">���̵��ҽ�</a>
					<ul>
						<li><a href="/notice.php">��������</a></li>
						<li><a href="/update.php">������Ʈ</a></li>
						<li><a href="/event.php">�̺�Ʈ</a></li>
						<li><a href="/developed.php">���߿�������</a></li>
					</ul>					
				</li>
				<li>
					<a href="/guide.php">���̵��</a>						
				</li>
				<li>
					<a href="/ranking_slayer.php">��������</a>
					<ul>
						<li><a href="/ranking_slayer.php">�����̾�</a></li>
						<li><a href="/ranking_vampire.php">�����̾�</a></li>
						<li><a href="/ranking_ousters.php">�ƿ콺����</a></li>
					</ul>					
				</li>
				<li>
					<a href="/market/market.php">���̵�����</a>		
					<ul>
						
					</ul>										
				</li>
				<li>
					<a href="/download.php">�ٿ�ε�</a>
				</li>
				<li>
					<a href="/faq.php">������</a>				
				</li>
			</ul>
		</nav>
	</header>
	
	<section>
		<article>	
			<div id="section1">
				<div class="swiper-container">
					<div class="swiper-wrapper">
						<!-- ù ��° �̹��� -->
						<div class="swiper-slide">
							<!-- �̹��� -->
							<a href=""><img src="/image/marketslide/3.jpg" class="logo" width="737px" alt="�ΰ�"/></a>
						</div>	
						<!-- �� ��° �̹��� -->
						<div class="swiper-slide">
							<a href=""><img src="/image/marketslide/1.jpg" class="logo" width="737px" alt="�ΰ�"/></a>	
						</div>
						<!-- �� ��° �̹��� -->
						<div class="swiper-slide">
							<a href=""><img src="/image/marketslide/2.jpg" class="logo" width="737px" alt="�ΰ�"/></a>	
						</div>						
					</div>
					<!-- ����¡ -->
					<div class="swiper-pagination"></div>
					<div class="swiper-button-next"></div>
					<div class="swiper-button-prev"></div>
				</div>
				
				<div class="download">
					<a href="https://drive.google.com/file/d/139m3EXup9itPxxlYTZlIpw202-LpgUes/view?usp=sharing" target="_blank"><img src="/image/download/download1.png" onmouseover="this.src='/image/download/download2.png'" onmouseout="this.src='/image/download/download1.png'" alt="�ٿ�ε�"/></a>
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
					<p class="user"><img src="/image/name.png" class="name_img"><?php echo $_SESSION['user_id']; ?>�� �ݰ����ϴ�</p>
					<p class="point">�� ����Ʈ��<?php echo $row['point']; ?></p>		
					<img src="/image/login/logout.png" class="logout" title="�α׾ƿ�" onclick="return doLogout();">
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
								alert("���̵� �Է����ּ���");
								f.mb_id.focus();
								return false;
							}
							if (!f.mb_password.value) {
								alert("��й�ȣ�� �Է����ּ���");
								f.mb_password.focus();
								return false;
							}
							f.userid.value = f.mb_id.value;
							f.userpw.value = f.mb_password.value;
							f.action = '/login.php';
						}
					</script> 	
					<div class="login-box-input">
						<h1> LOGIN </h1>
						<form name="login_start" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" onsubmit="return login_submit(document.login_start);" autocomplete="off" enctype="multipart/form-data">
							<input type="hidden" name="userid" value="">
							<input type="hidden" name="userpw" value="">
							
							<input type="text" name="mb_id" class="user-id" onclick="javascript:this.value='';" onfocus="javascript:this.value='';" value="" placeholder=" ���̵�"/ onfocus="javascript:this.value='';" tabindex="1" onclick="javascript:this.value='';" class="back">
							<input type="password" name="mb_password" class="user-pw" onclick="javascript:this.value='';" onfocus="javascript:this.value='';" value="" placeholder=" ��й�ȣ"/>	

							<input type="image" src="/image/login/loginbut.png"/ class="login_btn">
						</form>
						
						<a href="/register.php"><span class="register">Create Your Account ��</span></a>
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
				<a href="#"><img src="/image/marketslide/sub1.jpg" class="event1" alt="�̺�Ʈ"></a>	
			</div>
		</article>
	</section>
	<section>
		<article class="board">
			<div id="section3">
				<div class="market_menu_set">
					<span class="market_menu">���丮�� ��õ ��</span></a>
				</div>
				<div class="market_item">
					<div class="item_image">
						<img src="../item/coin.png" width="260px" alt="������"/>
					</div>
					<div class="market_item_name">
						<h1>���丮�� ��õ ��</h1>
						<p class="market_item_price">5,000��</p>
						<?php
							$user_id = $_SESSION['user_id'];
							if(!isset($_SESSION['user_id']))
							{
								echo "
										<script>
										alert('�α����� �Ǿ����� �ʽ��ϴ�.')
										history.back(1)
									</script>
								";
								exit();
							}
							
							$checkname = mysql_query("SELECT * FROM `Slayer` WHERE `PlayerID` = '$user_id' AND `Active` = 'ACTIVE'");
							
							$RaceSet = 'VAMPIRE'
						?>
						<div class="buy_player">
						<form name="buy_start" method="post" action="../bbs/v_coin2_buy.php" onsubmit="return login_submit(document.login_start);">
							<p>ĳ���� ��</p>
							<select name="charname" class="select_box" value="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
							<?php
								while($player = mysql_fetch_assoc($checkname)){
								$char = $player['Name'];
								$Race = $player['Race'];
								if($RaceSet == 'COMMON')
								{
						?>
									<option value=<?php echo" '$char|$Race' "?> class="select_box"><?php echo "$char" ?></option>
						<?php
								}
								else if($RaceSet == $Race)
								{
						?>
									<option value=<?php echo "'$char|$Race'" ?> class="select_box"><?php echo "$char" ?></option>
						<?php
								}				
							}
							?>
							</select>
						</div>
							<div class="submit_box_set">
								<input type="submit" value="����" class="submit_box">
							</div>
						</form>
					</div>
					<hr>
					<div class="market_items">
					<p>������ ����</p>
						<div class="market_item_information">
							<p>���丮�� �������� ��ģ ������ NPC���� �ǳ��ָ� ��õ������ ȹ���� �� �ֽ��ϴ�.</p>
						</div>
					</div>
				</div>				
			</div>
		</article>
	</section>

	<footer>
		<div class="footer_bar">
			<a href="#">ȸ��Ұ�</a> | <a href="#">��������ó����ħ</a> | <a href="#">���ȹ</a> | <a href="#">�̿���</a> | <a href="#">������</a>
		</div>
		
		<div id="footer">
			<div class="footer_text footer_box">
				<dl><dd><img src="/image/logo/footer.png" alt="Ǫ�� �ΰ�" class="footer_icon"></dd></dl>
				<dl>
					<dd>AIDEL ONLINE /</dd>
					<dd>������ : 1600-1600</dd>
				</dl>
				<dl>
					<dd>E-mail : popo486312@nate.com /</dd>
					<dd>����� ��Ϲ�ȣ : 123-45-67890ȣ /</dd>
					<dd>����Ǹž� �Ű��ȣ:��2017-�д�-1342ȣ</dd>
				</dl>
				<dl>
					<dd>Copyright �� AIDEL ENTERTAINMENT. ALL RIGHTS RESERVED.</dd>
				</dl>	
			</div>
		</div>
	</footer>
</body>

<script>
	// Swiper
	var swiper = new Swiper('.swiper-container', {
		loop: true, // ���� ����
		effect: 'fad2e', //����Ʈ ���̵�� �־ �������
		slidesPerView: 1,
		pagination: {
			el: '.swiper-pagination',
			clickable : true, // �����̵� ���׶�� Ŭ�� �����ϰ�
		},
		autoplay: {
			delay: 6000, // 6�� ���� ������ �̵�
		},
		navigation: {
			prevEl: '.swiper-button-prev',
			nextEl: '.swiper-button-next',
		},
	});
</script>
</html>