 <?php



//*************************************

// PHP Login Class Using MySQL

//*************************************


class Login {

    

    //Username Variables

    private $username;

    private $password;

    

    //MySQL Variables

    private $Host;

    private $MySQLUsername;

    private $MySQLPassword;

    private $Database;

    private $Conn;

    



    //Constructor	

    public function Login()

    {

		error_reporting(0);

        session_start();

        $this->Host = DBPATH ;

        $this->MySQLUsername = DBUSER ;

        $this->MySQLPassword = DBPASS ;

        $this->Database = DBNAME ;

        $this->Connection();

        

        unset($this->Host);

        unset($this->MySQLUsername);

        unset($this->MySQLPassword);

        unset($this->Database);

    }

    //**********************

    //Mysql Functions

    //********************** 

    public function Connection()

    {

        $this->Conn = @mysql_connect($this->Host,$this->MySQLUsername,$this->MySQLPassword);

        

        if($this->Conn)

        {

            mysql_select_db($this->Database) OR die('Could not select DB');

        }

        else

        {

            die(mysql_error());

        }  

    }

    

    public function Query($sql)

    {

        $result = mysql_query($sql);

        

        if(!$result)

        {

            die(mysql_error());

        }

        

        return $result;

    }

    

    public function Disconnect()

    {

        mysql_close($this->Conn);

    }

    

    //Escapes bad values for MySQL to prevent SQL injections.

    public function EscapeString($badstring)

    {

        if(!get_magic_quotes_gpc())

        {

            $goodstring = addslashes($badstring);

        }

        else

        {

            $goodstring = stripslashes($badstring);

        }

        

        $goodstring = mysql_real_escape_string($badstring);

        

        return $goodstring;

    }

    

    public function EncryptPassword($password)

    {

      return sha1(md5($password));  

    } 

    //Check if the user can login

    public function CheckLogin($username,$password)

    {

        $this->username = $this->EscapeString($username); 

        $this->password = $this->EscapeString($this->EncryptPassword(($password)));

                                                   

        $result = $this->Query("SELECT * FROM members WHERE email_members = '$this->username' AND password = '$this->password' LIMIT 1");

        

        //If we get one result we know the login is right.

        if(mysql_num_rows($result) == 1)

        {

			$sg=mysql_fetch_array($result);

			$sid_lama = $sg['session'];

			$sid_baru = md5(sha1($sid_lama));

            $this->username = $username;

            $_SESSION['username'] = $this->username;

            $_SESSION['authorized'] = 1;

			$_SESSION['NameMember'] = $sg['name_members']; 

			login_validate();

  			mysql_query("UPDATE members SET session='$sid_baru' WHERE email_members='$this->username'");

			mysql_query("DELETE FROM orders_temp WHERE id_members='$sg[id_members]'");

    		$waktu = date("d-m-y / H:i:s");

			$ip = $_SERVER['REMOTE_ADDR'];

    		$email = $_POST['username'];

    		$status = 'success';

    		$cetak = "

Email   : " . $email . "

Time    : " . $waktu . "

IP      : " . $ip . "

Status  : " . $status . "

========================================";

    		$fopen = fopen("../../log/login/log.txt", "a");

    		fwrite($fopen, $cetak);

    		fclose($fopen);

            echo"<script>window.location = ('page-myaccount')</script>";

        }

        else 

        {

            $waktu = date("d-m-y / H:i:s");

			$ip = $_SERVER['REMOTE_ADDR'];

    		$email = $_POST['username'];

    		$status = 'failed';

    		$cetak = "

Email   : " . $email . "

Time    : " . $waktu . "

IP      : " . $ip . "

Status  : " . $status . "

========================================";

    $fopen = fopen("../../log/login/log.txt", "a");

    fwrite($fopen, $cetak);

    fclose($fopen);

	echo"<script>alert('Invalid email and/or password.'); window.location = ('page-login')</script>";

        }

            

    }

    //Add a user

    public function AddUser($username,$password)

    {

        $username = $this->EscapeString($username);

        $password = $this->EscapeString($this->EncryptPassword($password));

        

        $result = $this->Query("INSERT INTO users (username,password) VALUES ('$username','$password')");

    }

    //Takes the result of a query and puts the information into an array

    public function Result_To_Array($result)

    {

        $result_array = array();



        for ($i=0; $row = mysql_fetch_array($result); $i++) 

        {

            $result_array[$i] = $row;

        }



        return $result_array;



    }

    //Delete user

    public function DeleteUser($username)

    {

        $username = $this->EscapeString($username);

        

        $result = $this->Query("DELETE FROM users WHERE username = '$username' LIMIT 1");

    

    }

    //Checks if the user is authorized or not

    public function IsAuth()

    {

        if(isset($_SESSION['username']) && $_SESSION['authorized'] == 1)

        return true;

        

        else

        {

            die('You are not authorized to view this information');

            echo"<script>window.location = ('Login.php')</script>";

        }    

    }

    //Shows user's IP

    public function GetIP()

    {

        return $_SERVER['REMOTE_ADDR'];

    }

    //Display all users

    public function ShowUsers()

    {

        $users = $this->Result_To_Array($this->Query("SELECT * FROM `users`"));

            

        foreach($users as $user)

        {

            echo $user['username']."<br />";

        } 

    }

    

    public function LogOut()

    {



         session_destroy();

         

         echo"<script>window.location = ('Login.php')</script>";

    }

}

?> 