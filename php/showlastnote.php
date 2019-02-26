<?php
require  'dblocation.php';
require  'note.php';
session_start();


$connect = new dblocation('pcmaster', 'root', '', 'clients', 'localhost');

//Выводит последнюю добавленную
$datas = Note::show_last();
foreach($datas as $data)
{
	echo "Name:" . $data["Name"] . "<br/>". " - Email:" . $data["Email"] . "<br/>". " - Telephone:" . $data["Telephone"] . "<br/>". " - Date:" . $data["Date"] . "<br/>". " - Time:" . $data["Time"] . "<br/><br/>";
}

?>