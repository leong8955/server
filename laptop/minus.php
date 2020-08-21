<?php 
	session_start();
	
//improved security
/*
	if($_SESSION['user']){
            $user=$_SESSION['user'];
	}
	else{
            header("location:index.php");
	}
*/
                
//broken session user         
        $user=$_SESSION['user'];
//-------       
        
        $connection=mysqli_connect("localhost", "root", "") or die(mysqli_error());
        mysqli_select_db($connection,"ATM") or die("Cannot connect to database"); 
	$balance=0.00;
        $string="SELECT * from Passbook WHERE user='$user'";
        $query=$connection->query($string);
	while($row=mysqli_fetch_array($query)){
            $balance= $balance + $row['amount'];
        }

//improved validation
//	if(($_SERVER['REQUEST_METHOD']=="POST")&&($amount>0))
//broken validation
	if($_SERVER['REQUEST_METHOD']=="POST")
	{
            date_default_timezone_set('Asia/Kuala_Lumpur');
            $amount=$connection->real_escape_string($_POST['amount']);
            if($amount>$balance){
                Print '<script>alert("You do not have sufficient Funds.");;
		window.location.assign("balance.php")</script>';
		exit("You have insufficient funds!");
		//header("location: balance.php");
            }else{
                $amount=(-$amount);                
                $details=$connection->real_escape_string($_POST['details']);
                $time = strftime("%T");
                $date = strftime("%Y-%m-%d %H:%M:%S");
                $string="INSERT INTO Passbook (amount,date_transaction,details,user) VALUES ('$amount','$date','$details','$user')";
//improved security
/*
	if($connection->query($string)===TRUE){
                Print '<script>alert("Successful Withdrawal.");window.location.assign("balance.php");</script>';
                }
            else{
                Print '<script>alert("You have insufficient funds!");window.location.assign("withdraw.php");</script>';
                }
*/
//broken security
                $connection->query($string);
                Print '<script>alert("Successful Withdrawal.");window.location.assign("balance.php");</script>';
            }
	}
	else{
            header("location:home.php");
	}
?>