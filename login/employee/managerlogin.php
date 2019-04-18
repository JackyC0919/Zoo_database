<?php
	if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['employee'])){
		header("Location: manager/employeeprofile.php");
	}
	if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['customer'])){
		header("Location: manager/customerprofile.php");
	}
	if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['animals'])){
		header("Location: manager/animals.php");
	}
	if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['animalcare'])){
		header("Location: manager/animalcare.php");
	}
	if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['maintenance'])){
		header("Location: manager/maintenance.php");
	}
	if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['boxoffice'])){
		header("Location: manager/boxoffice.php");
	}
	if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['product'])){
		header("Location: manager/products.php");
	}
	if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['giftshop'])){
		header("Location: manager/giftshops.php");
	}
?>

<?php include "../../templates/header.php"; ?>
<link rel="stylesheet" href="../../css/style.css" />
<h2>Hello Manager</h2>
<form action="managerlogin.php" method="post">
	<input type="submit" name="employee" value="Employees"/>
	<input type="submit" name="customer" value="Customers"/>
	<input type="submit" name="animals" value="Animals"/>
	<input type="submit" name="animalcare" value="AnimalCare"/>
	<input type="submit" name="maintenance" value="Maintenance"/>
	<input type="submit" name="boxoffice" value="BoxOffice"/>
	<input type="submit" name="product" value="Products"/>
	<input type="submit" name="giftshop" value="Giftshops"/>
</form>


<a href="employeelogout.php">Sign out</a>
<a href="../../main.php">Main Page</a>
<?php include "../../templates/footer.php"; ?>