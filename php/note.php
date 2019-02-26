<?php 
require 'medoo.php';


class Note
{
	private static $Name = '';
	private static $Email = '';
	private static $Tel = '';
	private static $Date = '';
	private static $Time = '';
	private static $patternName = '^[A-Za-z0-9_]{1,15}$';
	private static $patternTel = '(\+?\d[- .]*){11}';
	private static $lastID = '';
	
	function __construct($nm, $eml, $tl, $dte, $tme) 
	{
		self::$Name = $this->clean($nm);
		self::$Email = $this->clean($eml);
		self::$Tel = $this->clean($tl);
		self::$Date = $this->clean($dte);
		self::$Time = $this->clean($tme);		
		if ($this->check_length(self::$Name, 1, 16) || !filter_var($_GET["Email"], FILTER_VALIDATE_EMAIL) || $this->check_length(self::$Tel, 0, 12) || $this->check_length(self::$Date, 0, 11) || $this->check_length(self::$Time, 0, 6)) 
			throw new Exception("Неверно заполнены поля!");	
		if($this->check_Name())		
			throw new Exception("Пользователь с указанным именем уже есть в базе, пожалуйста, укажите другое имя!");	
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
		"ID"),
		array(
		"Name" => self::$Name
		));
		if($datas[0]['ID'] == '')
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
		"Name" => self::$Name,
		"Email" => self::$Email,
		"Telephone" => self::$Tel,
		"Date" => self::$Date,
		"Time" => self::$Time));	
		
	}	
	
	function resave_last() 
	{		
		$database = new medoo(array(
		'database_type' => 'mysql',
		'database_name' => dblocation::get_dbname(),
		'server' => dblocation::get_server(),
		'username' => dblocation::get_user(),
		'password' => dblocation::get_pass()));
		
		$data = $database->query("select max(ID) from clients")->fetchAll();					
		$ID = $data[0]['max(ID)'];
		
	
		$database->update(dblocation::get_table(), array(
		"Name" => self::$Name,
		"Email" => self::$Email,
		"Telephone" => self::$Tel,
		"Date" => self::$Date,
		"Time" => self::$Time),
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
		"Name",
		"Email",
		"Telephone",
		"Date",
		"Time"));

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
		
		$data = $database->query("select max(ID) from ".dblocation::get_table())->fetchAll();					
		$ID = $data[0]['max(ID)'];
	
		$datas = $database->select(dblocation::get_table(), array(
		"Name",
		"Email",
		"Telephone",
		"Date",
		"Time"),
		array(
		"ID" => $ID
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
		<input id=\"alpha\" name=\"Name\" type=\"text\" pattern=".self::$patternName." placeholder=\"Name\" required> <br/>
		<label for=\"alpha\">Email</label><br/>
		<input type=\"email\" name=\"Email\" placeholder=\"mail@mail.com\" > <br/>				
		<label for=\"alpha\">Tel</label><br/>
		<input type=\"tel\" name=\"Tel\" pattern=".self::$patternTel." placeholder=\"+7(___)__-__-___\" required> <br/><br/>	
		<label for=\"alpha\">----</label><br/>
		<label for=\"alpha\">Date</label><br/>
		<input type=\"date\" name=\"Date\" id=\"deliveryDate\" >	<br/>
		<label for=\"alpha\">Time</label><br/>
		<input type=\"time\" name=\"Time\" id=\"deliveryDate\" >	<br/>						
		<input type=\"submit\" name=\"submit\" value=\"submit\">	<br/>					
		</form>
		<form>
		<p><button formaction=".$actionshow.">Show All Notes</button></p>
		</form>		
		<form>
		<p><button formaction=".$actionshowlast.">Show All Last Added Note</button></p>
		</form>	";
        return $form;
    }
	
}
?>