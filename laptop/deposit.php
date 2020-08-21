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
	background-color: #008cff;
	text-align: center;
	color:white;
}

.button:hover {
  background: #6600f5;;
}

body{
	background-color: PaleTurquoise;
}
#deposit{
    text-align: left;
}
        </style>
        </head>
	<?php
            session_start();
            if($_SESSION['user'])
            {}
            else
            {
            header("location:index.php");
            }
            $user=$_SESSION['user'];
        ?>
<body>
    <div class="container">
        <h2 >The Deposit Page</h2>
    	<h3> Welcome to E-Banking <?php Print "$user" ?></h3>
        <a href="home.php" >Click Here to Go Back.</a><br/>
	<br/><br/>
	<form action="add.php" method="POST" id="deposit">
            <table align="center"><tr><td>
                Deposit Amount 
            </td><td>
                : <input type="number" name="amount" required="required"/><br/>
            </td></tr>
            <tr><td>
                Details
            </td><td>
               : <input type="text" name="details" value="Deposit" readonly><br/>
            </td></tr>
            <tr><td colspan="2" align="center">
                <input type="submit" class="button" value="Deposit Money"/>
            </td></tr>
            </table>
        </form>
    </div>
</body>
</html>