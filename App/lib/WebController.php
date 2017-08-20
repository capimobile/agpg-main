<?php
class Html{
	private $href;
	private $title;
	
	public function urlroot($r){
		$url = explode("-",$this->Get('page'));
		$host= $_SERVER['HTTP_HOST'];
		$value=$r;
		$segmen= $url[$value];
		return $segmen;
	}
	public function urlnum(){
		$numm = count(explode("-",$this->Get('page')));	
		$num=$numm - 1;
		return $num;	
	}
	
	static function link($b,$a){
		
		echo"<a ";
			while(list($one,$two)=each($a)){
				echo"$one='$two' ";
			}
		echo">".$b."</a>";
	}
	
	public function linkarray($a){
		$this->href = $a;
			while(list($one,$two)=each($this->href)){
				echo"$one='$two' ";
			}
	}
	
	public function css($css){
		echo"<link href='".HTTP_HOST."$css' rel='stylesheet' type='text/css' />";
	}

	public function js($js){
		echo"<script src='".HTTP_HOST."$js' type='text/javascript'></script>";
	}

    public function favicon($ico){
		echo"<LINK REL='SHORTCUT ICON' HREF='".HTTP_HOST."$ico'>";
	}
	public function Get($value){
		return $_GET[$value];
	}
}

$Html = new Html;
?>