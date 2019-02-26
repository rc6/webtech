<?php
require  'dblocation.php';
require  'master.php';

$connect = new dblocation('pcmaster', 'root', '', 'master', 'localhost');
//Выводит последнюю добавленную
$datas = Master::show_last();
foreach($datas as $data)
{
	echo "Name:" . $data["name"] . "<br/>". " - Specialization:" . $data["specialization"] . "<br/>". " - Telephone:" . $data["telephone"] . "<br/><br/>";
}
?>