<?php
//require  'dblocation.php';
require 'medoo.php';

class Journal
{
	private static $Client = '';
	private static $Master = '';
	private static $Comment = '';
	private static $patternName = '^[A-Za-z0-9_]{1,15}$';
	
	function __construct($client, $master, $comment) 
	{
		self::$Client = $this->clean($client);
		self::$Master = $this->clean($master);
		self::$Comment = $this->clean($comment);		
		if ($this->check_length(self::$Client, 1, 16) || $this->check_length(self::$Master, 1, 16)) 
			throw new Exception("Неверно заполнены поля!");	
	}		
	
	function clean($value = "") 
	{
		$value = trim($value);
		$value = stripslashes($value);
		$value = strip_tags($value);
		$value = htmlspecialchars($value);
	
		return $value;
	}

	function check_length($value = "", $min, $max) 
	{
		$result = (mb_strlen($value) < $min || mb_strlen($value) > $max);
		
		return $result;
	}
	
	function save() 
	{			
		$database = new medoo(array(
		'database_type' => 'mysql',
		'database_name' => dblocation::get_dbname(),
		'server' => dblocation::get_server(),
		'username' => dblocation::get_user(),
		'password' => dblocation::get_pass()));	
		
		$datas = $database->select("clients", array(
		"ID"),
		array(
		"Name" => self::$Client
		));		
		$ClientID = $datas[0]['ID'];	
		
		$datas = $database->select("master", array(
		"id"),
		array(
		"name" => self::$Master
		));		
		$MasterID = $datas[0]['id'];
		
		if ($ClientID == '' || $MasterID == '') 
		{
			throw new Exception("Указанные имена отсутствуют в базе!");	
			return;
		}
		echo $ClientID;
		echo $MasterID;
		
		$database->insert(dblocation::get_table(), array(
		"client_id" => $ClientID,
		"master_id" => $MasterID,
		"comment" => self::$Comment));	
		
	}	
	
	function show_journal() 
	{		
		$database = new medoo(array(
		'database_type' => 'mysql',
		'database_name' => dblocation::get_dbname(),
		'server' => dblocation::get_server(),
		'username' => dblocation::get_user(),
		'password' => dblocation::get_pass()));		
	
		$datas = $database->query("SELECT  `clients`.`Name` ,  `master`.`name` ,  `journal`.`comment` 
		FROM  `journal` ,  `clients` ,  `master` 
		WHERE  `journal`.`client_id` =  `clients`.`ID` &&  `journal`.`master_id` =  `master`.`id` ")->fetchAll();

		return $datas;		
	}
	
	
	function delete_all_notes()
	{
		$database = new medoo(array(
		'database_type' => 'mysql',
		'database_name' => dblocation::get_dbname(),
		'server' => dblocation::get_server(),
		'username' => dblocation::get_user(),
		'password' => dblocation::get_pass()));		
		
		$database->delete(dblocation::get_table(), array("id[>]" => "1"));
	}
	
	//function __toString()
	function get_form($action,$actionshow)
    {
		$database = new medoo(array(
		'database_type' => 'mysql',
		'database_name' => dblocation::get_dbname(),
		'server' => dblocation::get_server(),
		'username' => dblocation::get_user(),
		'password' => dblocation::get_pass()));
		
		$data1 = $database->select("master", array(
		"name"));
		
		$data2 = $database->select("clients", array(
		"Name"));
		
		foreach($data1 as $data)
		{
			$masters = $masters."<option>".$data["name"]."</option>";
		}
		
		foreach($data2 as $data)
		{
			$clients = $clients."<option>".$data["Name"]."</option>";
		}
		$form = "<form id=\"input\" action=".$action." method=\"get\">	
		<label for=\"alpha\">Client</label><br/>
		<select name=\"Client\">"
		.$clients.
		"</select><br/>
		<label for=\"alpha\">Master</label><br/>
		<select name=\"Master\">"
		.$masters.
		"</select><br/>			
		<label for=\"alpha\">Comment</label><br/>
		<input type=\"alpha\" name=\"Comment\" placeholder=\"Comment\"> <br/><br/>	
		<input type=\"submit\" name=\"submit\" value=\"submit\">	<br/>	
	</form>
	<form>
		<p><button formaction=".$actionshow.">ShowJournal</button></p>
	</form>	";
        return $form;
    }
}
?>