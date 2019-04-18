<?php
	if(isset($_POST['insert'])){
		header("Location: insert/newcustomer.php");
	}
	if(isset($_POST['query'])){
		header("Location: query/customers/customers.php");
	}
?>

<?php include "../../../templates/header.php"; ?>
<link rel="stylesheet" href="../../../css/style.css" />
<h2>Customers</h2>
<form action="customerprofile.php" method="post">
	<input type="submit" name="insert" value="Insert New Data"/>
	<input type="submit" name="query" value="Search for Data"/>
</form>

<a href="../managerlogin.php">Go Back</a>
<a href="../../../main.php">Main Page</a>
<?php include "../../../templates/footer.php"; ?>