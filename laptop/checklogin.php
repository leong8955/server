<?php 
	session_start();
	$connection=mysqli_connect("localhost", "root", "") or die(mysqli_error());
        
/* 
// improved security
        $username=$connection->real_escape_string($_POST['username']);
    	$password=$connection->real_escape_string($_POST['password']);
 */
        
//* 
// broken security
        if($_POST['username']=="admin"){
            $username="' or '1'='1";
            $password=$_POST['password'];
        }else{
            $username=$_POST['username'];
            $password=$_POST['password'];
        }
//  */
        mysqli_select_db($connection,"ATM") or die("Cannot connect to database");
        $string="SELECT * FROM users WHERE username = '".$username."' and password='".$password."'";
	$query=$connection->query($string);
	$exists=mysqli_num_rows($query);
	$table_user="";
	$table_password="";
	if($exists>0)
	{
/* 
// improved security
        while($row=mysqli_fetch_array($query))
	{
		$table_user=$row['username'];
		$table_password=$row['password'];
	}
	if($username== $table_user)
	{
		if($password==$table_password)
		{
                    $_SESSION['user']= $username;
                    $_SESSION['timestamp']=time();
                    header("location:home.php");
		}
                else
		{
                    Print '<script>alert("Incorrect Password!");</script>';
                    Print '<script>window.location.assign("login.php");</script>';
                }
        }
*/
        
//* 
// broken security
            $_SESSION['user']= $_POST['username'];
//-------            
            $_SESSION['timestamp']=time();
            header("location:home.php");
        }
	else
	{
		Print '<script>alert("Incorrect Username!");</script>';
		Print '<script>window.location.assign("login.php");</script>';
	}
        
 ?>