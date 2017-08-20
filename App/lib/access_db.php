<?php
class login_ses {
    public static function check_ses($txtLogin,$txtPass,$txtSesId)
    {
        $login=mysql_query("SELECT * FROM users WHERE email_users='$txtLogin' AND password_users='$txtPass' AND session_users='$txtSesId' AND status_users='1' ",Connect::getConnection());
		$result=mysql_num_rows($login);
        //echo $y1;
        return $result;
    }
	
	public static function post_ses($txtLogin,$txtPass)
    {
        $login=mysql_query("SELECT * FROM users WHERE email_users='$txtLogin' AND password_users='$txtPass' ",Connect::getConnection());
		$result=mysql_num_rows($login);
        //echo $y1;
        return $result;
    }
	
}
?>