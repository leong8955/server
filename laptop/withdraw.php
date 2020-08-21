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
            if($_SESSION['user'])
            {}
            else{
		header("location:index.php");
            }
            $user=$_SESSION['user'];
        ?>
<body>
    <div class="container">
        <h2>The Withdraw Page</h2>
	<h3> Hello <?php Print "$user" ?></h3>
	<a href="home.php" >Click Here to Go Back.</a><br/>
	<br/><br/>
	<form action="minus.php" method="POST">
            <table align="center"><tr><td>
                Withdrawal Amount 
            </td><td>
                : <input type="number" name="amount" required="required" /><br/>
            </td></tr>
            <tr><td>
                Details
            </td><td>
               : <input type="text" name="details" value="Withdraw" readonly><br/>
            </td></tr>
            <tr><td colspan="2" align="center">
                <input type="submit" class="button" value="Withdraw Money"/>
            </td></tr>
            </table>
        </form>
        <br/>
	<p>Please don't withdraw more than you have.</p>
    </div>
</body>
</html>