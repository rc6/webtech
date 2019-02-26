<?php
require  'dblocation.php';
require  'journal.php';
//require 'medoo.php';
//Объявляем переменные:
$Client = $_GET["Client"];
$Master = $_GET["Master"];
$Comment = $_GET["Comment"];
$connect = new dblocation('pcmaster', 'root', '', 'journal', 'localhost');
try 
{
	$journal = new Journal($Client, $Master, $Comment);	
	$journal->save();
	echo "Готово!";
}
catch (Exception $e)
{
	echo $e->getMessage();	
}
?>