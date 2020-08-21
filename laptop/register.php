<html>
	<head>
	<title>E-Banking</title>
<style>
 .container{
	width: 450px;
	padding: 4% 4% 4%;
	margin : auto;
	box-shadow: 10px 10px 5px #888888;
	background-color: #fff;
	text-align: center;
	position:relative;
	top:50px;
	vertical-align: middle;
}

form{
	align-content: center;
	padding:10px;
	margin-top: 15px;
}
input
{
	margin :5px;
}

a{
	color:#f00f53;
	text-decoration: none;
	align-content: right;
}

.button{
	width :150px;
	margin :10px;
	padding:5px;
	font-weight: bold;
	background-color: #ff474a;
	text-align: center;
	position:relative;
	right:-100px;
	color:white;
}

.button:hover {
  background: #a30003;
}
body{
	background-color: PaleTurquoise;
}
</style>
        </head>
<body>
    <div class="container">
        <h2>The Registraion Page</h2>
	<a href="index.php" >Click Here to Go Back.</a><br/>
	<form action="register.php" method="POST">
            Enter Username : <input type="text" name="username" required="required"/><br/>
            Enter Password : <input type="password" name="password" required="required"/><br/>
            <input type="submit" value="Register" class="button"/>
        </form>	
    </div>
</body>
</html>

<?php
    $connection=mysqli_connect("localhost", "root", "") or die(mysqli_error());
    
    
    
	if($_SERVER["REQUEST_METHOD"]=="POST"){
/* 
// improved security
        $username=$connection->real_escape_string($_POST['username']);
    	$password=$connection->real_escape_string($_POST['password']);
 */
        
//* 
// broken security
        $username=$_POST['username'];
        $password=$_POST['password'];
//  */
            
            $bool=true;
            mysqli_select_db($connection,"ATM") or die("Cannot connect to database");
            $string="SELECT * FROM users ";
            $query=$connection->query($string);
            while($row=mysqli_fetch_array($query)){
                $table_user=$row['username'];
		$table_acc_no=$row['acc_no'];
		if($username==$table_user){
                    $bool=false;
                    Print '<script>alert("Username has already been taken!");</script>';
                    Print '<script>window.location.assign("register.php");</script>';
                }
            }
            if($bool){
                $table_acc_no+=1;
                $string2="INSERT INTO users (username,password,acc_no) VALUES ('$username','$password','$table_acc_no')";
                $query=$connection->query($string2);
		Print '<script>alert("Successfully Registered! ");</script>';
echo $username;
//		Print '<script>window.location.assign("index.php");</script>';
            }
	}
?>