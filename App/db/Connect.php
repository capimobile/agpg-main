<?php

include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'Config.php';

class Connect {
	
	protected static $_connection;
	
	public static function getConnection(){
		if(!self::$_connection){
			$dbhost = DBPATH;
			$dbuser = DBUSER;
			$dbpassword = DBPASS;
			$dbname = DBNAME;
			self::$_connection = @mysql_connect($dbhost, $dbuser, $dbpassword);
			if(!self::$_connection){
				throw new Exception('Gagal melalukan koneksi ke database. '.mysql_error());
			}
			$result = @mysql_select_db($dbname, self::$_connection);
			if(!$result){
				throw new Exception('Koneksi gagal: '.mysql_error());
			}
		}
		return self::$_connection;
	}
	
	public static function close(){
		if(self::$_connection){
			mysql_close(self::$_connection);
		}
	}
} 
