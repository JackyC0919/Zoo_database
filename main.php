<?php
	if($_SERVER['REQUEST_METHOD'] == "POST" or isset($_POST['ticketprice'])){
		header("Location: mainpage/ticketprice.php");
	}

	if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['animal'])){
		header("Location: mainpage/animal.php");
	}

	if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['giftshop'])){
		header("Location: mainpage/giftshop.php");
	}

	if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['customer'])){
		header("Location: login/customerlogin.php");
	}	

	if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['employee'])){
		header("Location: login/employeelogin.php");
	}			
?>
<title>Zoo Homepage</title>
<link rel="stylesheet" href="css/style.css">

<form action="main.php" method="post" style="width: 102%; height: 70px; margin-left: -9px; margin-top: -8px; padding: 0px; border-radius: 0px;">
<center class="homeBanner" style="LINE-HEIGHT: 1px;">

	<input type="submit" name="ticketprice" value="Ticket Price" style="display: inline-block; margin: 15px;"/>
	<input type="submit" name="animal" value="Animals" style="display: inline-block; margin: 15px;"/>
	<input type="submit" name="giftshop" value="Shop" style="display: inline-block; margin: 15px;"/>
	<input type="submit" name="customer" value="Customer Login" style="display: inline-block; margin: 15px;"/>
	<input type="submit" name="employee" value="Employee Login" style="display: inline-block; margin: 15px;"/>

</center>
</form>

<div style="text-align: center; padding-top: 20px;" class="pageTitle">
	WELCOME TO <br>
	<img src="css/budget_zoo_logo.svg" height="500"> <br>
</div>
