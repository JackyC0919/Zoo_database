<?php
	if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['animals'])){
		header("Location: gemployee/animals.php");
	}
	if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['giftshop'])){
		header("Location: gemployee/giftshops.php");
	}
?>

<?php include "../../templates/header.php"; ?>
<link rel="stylesheet" href="../../css/style.css" />
<h2>Hello General Employee</h2>
<form action="gemployeelogin.php" method="post">
	<input type="submit" name="animals" value="Animals"/>
	<input type="submit" name="giftshop" value="Giftshops"/>
</form>


<a href="employeelogout.php">Sign out</a>
<a href="../../main.php">Main Page</a>
<?php include "../../templates/footer.php"; ?>