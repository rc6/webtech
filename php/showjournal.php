<?php
require  'dblocation.php';
require  'journal.php';

$connect = new dblocation('pcmaster', 'root', '', 'journal', 'localhost');
//Выводит все записи
$datas = Journal::show_journal();
foreach($datas as $data)
{
	echo "Client:" . $data["Name"] . "<br/>". " - Master:" . $data["name"] . "<br/>". " - Comment:" . $data["comment"] . "<br/><br/>";
}
?>