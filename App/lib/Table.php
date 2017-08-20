<?php
include_once 'App/db'.DIRECTORY_SEPARATOR.'Connect.php';
class Table {
	
	protected $_tableName;
	
	function __construct($tableName){
		$this->_tableName = $tableName;
	}
	
	public function connect(){
		return Connect::getConnection();
	}
	
	public function close(){
		Connect::close();
	}
	
	function save(array $data){
		$sql = "INSERT INTO `".$this->_tableName."` SET";
		foreach($data as $field => $value){
			$sql .= " `".$field."`='".mysql_real_escape_string($value, Connect::getConnection())."',";
		}
		$sql = rtrim($sql, ',');
		$result = mysql_query($sql, Connect::getConnection());
		if(!$result){
			throw new Exception('Gagal menyimpan data ke table '.$this->_tableName.': '.mysql_error());
		}
	}
	
	function update(array $data, $where = ''){
		$sql = "UPDATE `".$this->_tableName."` SET";
		foreach($data as $field => $value){
			$sql .= " `".$field."`='".mysql_real_escape_string($value, Connect::getConnection())."',";
		}
		$sql = rtrim($sql, ',');
		if($where){
			$sql .= " WHERE ".$where;
		}
		$result = mysql_query($sql, Connect::getConnection());
		if(!$result){
			throw new Exception('Gagal mengupdate data table '.$this->_tableName.': '.mysql_error());
		}
	}
	
	function updateBy($field, $value, array $data){
		$where = "`".$field."`='".mysql_real_escape_string($value, Connect::getConnection())."'";
		$this->update($data, $where);
	}
	
	function delete($where = ''){
		$sql = "DELETE FROM `".$this->_tableName."`";
		if($where){
			$sql .= " WHERE ".$where;
		}
		$result = mysql_query($sql, Connect::getConnection());
		if(!$result){
			throw new Exception('Gagal menghapus data dari table '.$this->_tableName.': '.mysql_error());
		}
	}
	
	function deleteBy($field, $value){
		$where = "`".$field."`='".mysql_real_escape_string($value, Connect::getConnection())."'";
		$this->delete($where);
	}
	
	function findAll(){
		include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'Select.php';
		$sql = "SELECT * FROM `".$this->_tableName."`";
		return new Select($sql);
	}
	
	function SortAllBy($a){
		include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'Select.php';
		$sql = "SELECT * FROM `".$this->_tableName."` ORDER BY ".$a."";
		return new Select($sql);
	}
	function findAllDesc($value){
		include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'Select.php';
		$sql = "SELECT * FROM `".$this->_tableName."` ORDER BY ".$value." DESC";
		return new Select($sql);
	}
	
	function findBy($field, $value){
		include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'Select.php';
		$sql = "SELECT * FROM ".$this->_tableName."";
		$sql .=" WHERE ".$field."='".$value."'";
		return new Select($sql);
	}
	function findByOrder($field, $value, $sort){
		include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'Select.php';
		$sql = "SELECT * FROM `".$this->_tableName."`";
		$sql .=" WHERE `".$field."`='".mysql_real_escape_string($value)."' ORDER BY ".$sort."";
		return new Select($sql);
	}
	function findValue($value){
		include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'Select.php';
		$sql = "SELECT * FROM `".$this->_tableName."`";
		$sql .=" WHERE ".$value."";
		return new Select($sql);
	}
	function findColoumnBy($column, $value){
		include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'Select.php';
		$sql = "SELECT ".$column." FROM `".$this->_tableName."`";
		$sql .=" WHERE ".$value."";
		return new Select($sql);
	}
	function findDistinct($column, $value){
		include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'Select.php';
		$sql = "SELECT DISTINCT ".$column." FROM `".$this->_tableName."`";
		$sql .=" ".$value."";
		return new Select($sql);
	}
	
}
