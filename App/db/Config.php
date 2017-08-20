<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 0);

define("HTTP_HOST", "http://".$_SERVER['HTTP_HOST']."/dev-jakarta/");

define("DBPATH","localhost");
define("DBUSER","agpg");
define("DBPASS","agpgjkt29");
define("DBNAME","ayamgepuk_jkt");

$dbo = new PDO("mysql:host=".DBPATH.";dbname=".DBNAME,DBUSER,DBPASS);
?>
