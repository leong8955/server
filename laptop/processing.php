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

	if($_SERVER['REQUEST_METHOD']=="POST")
	{
            date_default_timezone_set('Asia/Kuala_Lumpur');
            $amount=$connection->real_escape_string($_POST['amount']);
            if($amount>$balance){
                Print '<script>alert("You do not have sufficient Funds.");;
		window.location.assign("transfer.php")</script>';
		exit("You have insufficient funds!");
		//header("location: balance.php");
            }else{
                $amount_sender=(-$amount);
                $amount_recipient=$amount;
                $recipient_acc_no=$_POST['details'];
                $details_recipient="Deposit from ".$user;
                $account_no=$connection->real_escape_string($_POST['details']);
                $string2="SELECT * from users WHERE acc_no='".$recipient_acc_no."'";
                $result=$connection->query($string2);
                $row=$result->fetch_assoc();
/*                
//self transaction validation
                if($user==$row["username"]){
                    Print '<script>alert("Please don\'t transfer money to yourself."); 
                            window.location.assign("transfer.php");</script>';
                }else{
*///                    
                    $details_sender="Credit to ".$row["username"];    
                    $time = strftime("%T");
                    $date = strftime("%Y-%m-%d %H:%M:%S");
                    $string3="INSERT INTO Passbook (amount,date_transaction,details,user) VALUES ('
                            $amount_sender','$date','$details_sender','$user')";
                    $connection->query($string3);
                    $string4="INSERT INTO Passbook (amount,date_transaction,details,user) VALUES ('
                            $amount_recipient','$date','$details_recipient','".$row["username"]."')";
                    $connection->query($string4);
                    Print '<script>alert("Successful transfer.");
                        var response=window.confirm("Do you want to make another transaction?");
                        if(response){window.location.assign("transfer.php");}
                        else{window.location.assign("balance.php");}</script>';
 //               }
                
            }
	}
	else{
            header("location:home.php");
	}
?>