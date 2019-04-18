<?php
	if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['insert'])){
		header("Location: insert/maintenanceinsert.php");
	}
	if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['query'])){
		header("Location: query/maintenance/maintenancesearch.php");
	}
?>

<?php include "../../../templates/header.php"; ?>
<h2>Maintenance</h2>
<form action="maintenance.php" method="post">
	<input type="submit" name="insert" value="Insert New Data"/>
	<input type="submit" name="query" value="Search for Data"/>
</form>

<a href="../repairmanlogin.php">Go Back</a>
<a href="../../../main.php">Main Page</a>
<?php include "../../../templates/footer.php"; ?>