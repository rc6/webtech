<?php
//require  'dblocation.php';
require 'medoo.php';

class Master
{
	private static $Name = '';
	private static $Specialization = '';
	private static $Telephone = '';
	private static $patternName = '^[A-Za-z0-9_]{1,15}$';
	private static $patternTel = '(\+?\d[- .]*){11}';	
	
	function __construct($nm, $spec, $tel) 
	{
		self::$Name = $this->clean($nm);
		self::$Specialization = $this->clean($spec);
		self::$Telephone = $this->clean($tel);
		if ($this->check_length(self::$Name, 1, 25) || $this->check_length(self::$Specialization, 0, 25) || $this->check_length(self::$Telephone, 0, 17))
			throw new Exception("Неверно заполнены поля!");
		if($this->check_Name())		
			throw new Exception("Пользователь с указанным именем уже есть в базе!");	
	}	

	function check_Name()
	{
		$database = new medoo(array(
		'database_type' => 'mysql',
		'database_name' => dblocation::get_dbname(),
		'server' => dblocation::get_server(),
		'username' => dblocation::get_user(),
		'password' => dblocation::get_pass()));
		
		$datas = $database->select(dblocation::get_table(), array(
		"id"),
		array(
		"name" => self::$Name
		));
		if($datas[0]['id'] == '')
				return false;
			else
				return true;
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
		
		$database->insert(dblocation::get_table(), array(
		"name" => self::$Name,
		"specialization" => self::$Specialization,
		"telephone" => self::$Telephone));	
		
	}	
	
	function resave_last() 
	{		
		$database = new medoo(array(
		'database_type' => 'mysql',
		'database_name' => dblocation::get_dbname(),
		'server' => dblocation::get_server(),
		'username' => dblocation::get_user(),
		'password' => dblocation::get_pass()));
		
		$data = $database->query("select max(ID) from ".dblocation::get_table())->fetchAll();					
		$ID = $data[0]['max(ID)'];		
	
		$database->insert(dblocation::get_table(), array(
		"name" => self::$Name,
		"specialization" => self::$Specialization,
		"telephone" => self::$Telephone),	
		array(
		"ID" => $ID
		));			
	}
	
	function show_all() 
	{		
		$database = new medoo(array(
		'database_type' => 'mysql',
		'database_name' => dblocation::get_dbname(),
		'server' => dblocation::get_server(),
		'username' => dblocation::get_user(),
		'password' => dblocation::get_pass()));		
	
		$datas = $database->select(dblocation::get_table(), array(
		"name",
		"specialization",
		"telephone"));

		return $datas;		
	}
	
	function show_last() 
	{		
		$database = new medoo(array(
		'database_type' => 'mysql',
		'database_name' => dblocation::get_dbname(),
		'server' => dblocation::get_server(),
		'username' => dblocation::get_user(),
		'password' => dblocation::get_pass()));		
		
		$data = $database->query("select max(id) from ".dblocation::get_table())->fetchAll();					
		$ID = $data[0]['max(id)'];
		
		$datas = $database->select(dblocation::get_table(), array(
		"name",
		"specialization",
		"telephone"),
		array(
		"id" => $ID
		));
		
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
	function get_form($action,$actionshow,$actionshowlast)
    {
		$form = "<form id=\"input\" action=".$action." method=\"get\">	
		<label for=\"alpha\">Name</label><br/>
		<input type=\"text\" name=\"Name\" pattern=".self::$patternName." placeholder=\"Name\" required> <br/>
		<label for=\"alpha\">Specialization</label><br/>
		<input type=\"text\" name=\"Spec\" pattern=".self::$patternName." placeholder=\"Specialization\" > <br/>				
		<label for=\"alpha\">Tel</label><br/>
		<input type=\"tel\" name=\"Tel\" pattern=".self::$patternTel." placeholder=\"+7(___)__-__-___\" required> <br/><br/>	
		<input type=\"submit\" name=\"submit\" value=\"submit\">	<br/>	
	</form>	
	
	<form>
		<p><button formaction=".$actionshow.">Show All Masters</button></p>
	</form>	
	<form>
		<p><button formaction=".$actionshowlast.">Show All Last Added Master</button></p>
	</form>";
        return $form;
    }
}
?>