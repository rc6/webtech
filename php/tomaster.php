<?php
require  'dblocation.php';
require  'master.php';
//require 'medoo.php';
//Объявляем переменные:
$Name = $_GET["Name"];
$Specialization = $_GET["Spec"];
$Telephone = $_GET["Tel"];
$connect = new dblocation('pcmaster', 'root', '', 'master', 'localhost');
try 
{
	$master = new Master($Name, $Specialization, $Telephone);	
	$master->save();	
	echo 'Готово!';
}
catch (Exception $e)
{
	echo $e->getMessage();	
}
?>