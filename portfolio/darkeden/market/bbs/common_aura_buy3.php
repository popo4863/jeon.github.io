<?
ob_start();
session_start();
	
require("../../config.php");

$link = @mysql_connect($HOST, $USER, $PASSWORD) or exit("Mysql ������ �����ϴµ� �����߽��ϴ�. (���� ��ǻ�� Off)<br><br>��������:".mysql_error());
$db = @mysql_select_db($DBNAME) or exit(mysql_error());
$lang = @mysql_query("SET NAMES latin1");

//----------- �α��� üũ
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
//---------------------------------------

$tmp = explode("|" , $_POST['charname']);
$char = $tmp[0];
$Race = $tmp[1];
$type1 = $_POST['type1'];

	if(!$char) { exit("ĳ���Ͱ� �������� �ʽ��ϴ�."); } 

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
	exit("�߸��� �����Դϴ�. <3>");
}

//--------------------------------------------------


list($logged) = mysql_fetch_row(mysql_query("SELECT `LogOn` FROM `Player` WHERE `PlayerID` = '$user_id'"));


	if ($logged == 'LOGIN')
	{
		exit("�� ������ ���� �������Դϴ�. (������ ���� �ٽ� �õ����ּ���)");
	}
	else
	{
		while ($row = mysql_fetch_assoc($charcheck2))
		{
			if ($row['point'] <= 6999)
			{
				echo "
				<script>
				alert('����Ʈ�� �����մϴ�.')
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
				mysql_query("UPDATE `Player` SET `point` = `point`-'7000' WHERE `PlayerID` = '$user_id'") or exit("��Ͻ� ������ �߻��߽��ϴ�. <br><br>".mysql_error());
			}
			mysql_query("INSERT INTO `GoodsListObject` (`BuyID`, `World`, `PlayerID`, `Name`, `GoodsID`, `Num`) VALUES ('1','1','$user_id','$char','23','1')");
			mysql_query("UPDATE `Player` SET `point` = `point`-'7000' WHERE `PlayerID` = '$user_id'") or exit("��Ͻ� ������ �߻��߽��ϴ�. <br><br>".mysql_error());
		}

		echo "
		<script language='javascript'>
			alert('���Ű� �Ϸ�Ǿ����ϴ�.')
			history.back()
		</script>
		";
	}
	
	?>
<?php ob_end_flush(); ?>