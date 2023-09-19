<?
ob_start();
session_start();
	
require("../../config.php");

$link = @mysql_connect($HOST, $USER, $PASSWORD) or exit("Mysql 서버에 접속하는데 실패했습니다. (서버 컴퓨터 Off)<br><br>오류사인:".mysql_error());
$db = @mysql_select_db($DBNAME) or exit(mysql_error());
$lang = @mysql_query("SET NAMES latin1");

//----------- 로그인 체크
	$user_id = $_SESSION['user_id'];
	if(!isset($_SESSION['user_id']))
	{
		echo "
				<script>
				alert('로그인이 되어있지 않습니다.')
				history.back(1)
			</script>
		";
		exit();
	}
//---------------------------------------

$tmp = explode("|" , $_POST['charname']);
$char = $tmp[0];
$Race = $tmp[1];
$type1 = $_POST['type1'];

	if(!$char) { exit("캐릭터가 존재하지 않습니다."); } 

	else if($Race == 'SLAYER')
	{
		$CRace= 'Slayer';
	}
	else if($Race == 'OUSTERS')
	{
		$CRace= 'Ousters';
	}
	else if($Race == 'VAMPIRE')
	{
		$CRace= 'Vampire';
	}
	
$charcheck = mysql_query("SELECT * FROM `$CRace` WHERE `Name` = '$char' AND `PlayerID` = '$user_id'");
$charcheck2 = mysql_query("SELECT * FROM `Player` WHERE `PlayerID` = '$user_id' AND `point` <= '7000'");
//$Enchant = mysql_query("SELECT * FROM `Ousters` WHERE `AdvancementClass` = `AdvancementClass` AND `Name` = '$char'");
if (mysql_num_rows($charcheck) <= 0)
{
	exit("잘못된 접근입니다. <3>");
}

//--------------------------------------------------


list($logged) = mysql_fetch_row(mysql_query("SELECT `LogOn` FROM `Player` WHERE `PlayerID` = '$user_id'"));


	if ($logged == 'LOGIN')
	{
		exit("이 계정은 현재 접속중입니다. (접속을 끊고 다시 시도해주세요)");
	}
	else
	{
		while ($row = mysql_fetch_assoc($charcheck2))
		{
			if ($row['point'] <= 6999)
			{
				echo "
				<script>
				alert('포인트가 부족합니다.')
				history.back()
				</script>
				";
		
				return false;
			}
		}

		$query1 = mysql_query("SELECT * FROM `Player` WHERE `PlayerID` = '$user_id' AND `point`-'7000'");
		while ($row = mysql_fetch_assoc($query1))
		{
			if($query['Type'] == 1)
			{
				mysql_query("INSERT INTO `GoodsListObject` (`BuyID`, `World`, `PlayerID`, `Name`, `GoodsID`, `Num`) VALUES ('1','1','$user_id','$char','23','1')");
				mysql_query("UPDATE `Player` SET `point` = `point`-'7000' WHERE `PlayerID` = '$user_id'") or exit("등록시 오류가 발생했습니다. <br><br>".mysql_error());
			}
			mysql_query("INSERT INTO `GoodsListObject` (`BuyID`, `World`, `PlayerID`, `Name`, `GoodsID`, `Num`) VALUES ('1','1','$user_id','$char','23','1')");
			mysql_query("UPDATE `Player` SET `point` = `point`-'7000' WHERE `PlayerID` = '$user_id'") or exit("등록시 오류가 발생했습니다. <br><br>".mysql_error());
		}

		echo "
		<script language='javascript'>
			alert('구매가 완료되었습니다.')
			history.back()
		</script>
		";
	}
	
	?>
<?php ob_end_flush(); ?>