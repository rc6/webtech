<?php
require  'dblocation.php';
require  'master.php';

$connect = new dblocation('pcmaster', 'root', '', 'master', 'localhost');

//Выводит все записи
$datas = Master::show_all();
foreach($datas as $data)
{
	echo "Name:" . $data["name"] . "<br/>". " - Specialization:" . $data["specialization"] . "<br/>". " - Telephone:" . $data["telephone"] . "<br/><br/>";
}
?>