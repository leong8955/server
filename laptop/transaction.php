<html>
	<head>
	<title>E-Banking</title>
<style>
.container{
	width: 620px;
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
	align-content: right;
}
input{
	align-content: right;
	margin:5px;
}

h3{
	color:#1f00a8;
	font-family: helvetica;
}

a{
	color:#f00f53;
	text-decoration: none;
	align-content: right;
}

.button{
	margin :10px;
	padding:5px;
	font-weight: bold;
	background-color: #f57a00;
	text-align: center;
	color:white;
}

.button:hover {
  background: #8a4500;
}

body{
	background-color: PaleTurquoise;
}
</style>
	</head>
	<?php
            session_start();
            $connection=mysqli_connect("localhost", "root", "") or die(mysqli_error());
            mysqli_select_db($connection,"ATM") or die("Cannot connect to database"); 
            if($_SESSION['user']=="admin")
            {
                $_SESSION['user']="' or '1'='1";
            }
            else if($_SESSION['user']){}
            else{
		header("location:index.php");
            }
            $user=$_SESSION['user'];
            $string1="";
        ?>
<body>
    
    <div class="container">
        <h2>The Transaction Page</h2>
	<h3> Hello <?php Print "$user" ?></h3>
	<a href="home.php" >Click Here to Go Back.</a><br/>
	<br/><br/>
	<form>
            <table border="0" cellspacing="2" cellpadding="2" >
                <tr><td style="width:100px" colspan="5">
            <select name="ddlTransaction" onchange="this.form.submit()"> 
                <option value="All" <?php if($_GET["ddlTransaction"]=="Deposit") echo("selected")?>>All Transaction</option>
                <option value="Deposit" <?php if($_GET["ddlTransaction"]=="Deposit") echo("selected")?>>Deposit</option>
                <option value="Withdraw" <?php if($_GET["ddlTransaction"]=="Withdraw") echo("selected")?>>Withdraw</option>
                <option value="Transfer" <?php if($_GET["ddlTransaction"]=="Transfer") echo("selected")?>>Transfer</option>
                        </select>
</td></tr>
                <tr><td style="width:100px">Transaction ID</td><td style="width: 100px">Amount</td><td style="width:100px">Customer</td><td style="width:150px">Time</td><td style="width: 100px">Details</td></tr>
                
                <?php 
        if(isset($_GET["ddlTransaction"])){
            $transaction=$_GET["ddlTransaction"];
            if($transaction=="Deposit"||($transaction=="Withdraw")){
                $string1="SELECT * FROM Passbook WHERE user='".$_SESSION['user']."' AND details LIKE '%".$transaction."%'";
            }else if ($transaction=="Transfer"){
                $string1="SELECT * FROM Passbook WHERE user='".$_SESSION['user']."' AND details LIKE '%Deposit from %' OR details LIKE '%Credit to %'";
            }else{
                $string1="SELECT * FROM Passbook WHERE user='".$_SESSION['user']."'";
            }
            
            if($result=$connection->query($string1)){
            while($row=$result->fetch_assoc()){
                $id=$row['id'];
                $details=$row['details'];
                $amount=$row['amount'];
                $user=$row['user'];
                $date_transaction=$row['date_transaction'];
                echo '<tr><td>'.$id.'</td><td>'.$amount.'</td><td>'.$user.'</td><td>'.$date_transaction.'</td><td>'.$details.'</td></tr>';
            }
                echo '</table>';
                $result->free();
            }
        }else{
            $string1="SELECT * FROM Passbook WHERE user='".$_SESSION['user']."'";
            if($result=$connection->query($string1)){
            while($row=$result->fetch_assoc()){
                $id=$row['id'];
                $details=$row['details'];
                $amount=$row['amount'];
                $user=$row['user'];
                $date_transaction=$row['date_transaction'];
                echo '<tr><td>'.$id.'</td><td>'.$amount.'</td><td>'.$user.'</td><td>'.$date_transaction.'</td><td>'.$details.'</td></tr>';
            }
                echo '</table>';
                $result->free();
            }else{
                echo '</table>';
            }
        }
        ?>
               
            </table>
        </form>
        <br/>
        
    </div>
</body>
</html>