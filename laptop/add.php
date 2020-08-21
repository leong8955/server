<?php 
	session_start();
        $connection=mysqli_connect("localhost", "root", "") or die(mysqli_error());
        $amount=$_POST['amount'];
        $details=$_POST['details'];
        
//broken session user         
        $user=$_SESSION['user'];
//-------          

//improved security
/*
	if($_SESSION['user']){
            $user=$_SESSION['user'];
	}
	else{
            header("location:index.php");
	}
*/
        

        
//improved validation
//	if(($_SERVER['REQUEST_METHOD']=="POST")&&($amount>0))
//broken validation
        if($_SERVER['REQUEST_METHOD']=="POST")
	{
            date_default_timezone_set('Asia/Kuala_Lumpur');
            $time = strftime("%T");
            $date = strftime("%Y-%m-%d %H:%M:%S");
            mysqli_select_db($connection,"ATM") or die("Cannot connect to database"); 
            $string="INSERT INTO Passbook (amount,date_transaction,details,user) VALUES ('$amount','$date','$details','$user')";
            if($connection->query($string)===TRUE){
                Print '<script>alert("Successful Deposit Made.");window.location.assign("balance.php");</script>';
            }
            else{
                Print '<script>alert("Failed Deposit!Kindly contact with adminstrator!");window.location.assign("deposit.php");</script>';
            }
        }
	else{
            Print '<script>alert("Strictly no negative amount deposited!");window.location.assign("home.php");</script>';
	}
?>