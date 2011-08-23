<?php

require_once("inc/Config.php");
	
final class DatabaseConnection extends Config
{
	private static $instance;
	
	private static $link = NULL;
	private static $found = NULL;

	private function __construct(){
		self::$link = mysql_connect(parent::host, parent::username , parent::password);
		self::$found = mysql_select_db(parent::database, self::$link);
		mysql_query('SET NAMES gbk', self::$link);
		
		if(!self::$found){
			throw new exception("The database \"" . parent::database . "\" cannot found.");
		}
	}
	
	public function __destruct()
	{
		mysql_close(self::$link);
	}
	
	/* Avoid to clone instance */
	private function __clone(){}
	
	public static function getInstance()
	{
		if(!self::$instance)
		{
			self::$instance = new DatabaseConnection ();
		}
		
		mysql_ping(self::$link);
		
		return self::$instance;
	}
	
	public function query($query)
	{
		return mysql_query($query, self::$link);
	}
	
	public function last_insert_id()
	{
		return mysql_insert_id(self::$link);
	}
	
	public function last_error()
	{
		return mysql_error(self::$link);
	}
}
	
?>