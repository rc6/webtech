<?php
require  'dblocation.php';
require  'note.php';
session_start();
if ($_SESSION['test'] == $_SERVER['REMOTE_ADDR'])  
{
//require 'medoo.php';
session_start();
//Объявляем переменные:
$Name = $_GET["Name"];
$Email = $_GET["Email"];
$Tel = $_GET["Tel"];
$Date = $_GET["Date"];
$Time = $_GET["Time"];
$connect = new dblocation('pcmaster', 'root', '', 'clients', 'localhost');
try 
{
	$note = new Note($Name, $Email, $Tel, $Date, $Time);
	//if ($_SESSION['saved'] == 'true')
	//{
	//	$note->resave_last();
	//}
	//else
	//{
	$note->save();
	//$_SESSION['saved'] = 'true'; 
	//}	
	$_SESSION['message'] = 'Ваша заявка принята, мы вам обязательно перезвоним!';
}
catch (Exception $e)
{
	//echo $e->getMessage();
	$_SESSION['message'] = $e->getMessage();
}
}
else {$_SESSION['message'] = 'Доступ закрыт.';}
back();
?>

<?php
function back()
{
	$back = $_SERVER['HTTP_REFERER']; 
	echo "
	<html>
	  <head>
	   <meta http-equiv='Refresh' content='0; URL=".$_SERVER['HTTP_REFERER']."'>
	  </head>
	</html>";
}
?>
