<?php
require  'dblocation.php';
require  'note.php';
session_start();
//ќбъ¤вл¤ем переменные:

$connect = new dblocation('pcmaster', 'root', '', 'clients', 'localhost');

//¬ыводит все записи
$datas = Note::show_all();
foreach($datas as $data)
{
	echo "Name:" . $data["Name"] . "<br/>". " - Email:" . $data["Email"] . "<br/>". " - Telephone:" . $data["Telephone"] . "<br/>". " - Date:" . $data["Date"] . "<br/>". " - Time:" . $data["Time"] . "<br/><br/>";
}
?>