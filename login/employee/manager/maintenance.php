<?php
	if(isset($_POST['insert'])){
		header("Location: insert/maintenanceinsert.php");
	}
	if(isset($_POST['query'])){
		header("Location: query/maintenance/maintenancesearch.php");
	}
	if(isset($_POST['report'])){
		header("Location: query/maintenance/report.php");
	}
?>

<?php include "../../../templates/header.php"; ?>
<link rel="stylesheet" href="../../../css/style.css" />
<h2>Maintenance</h2>
<form action="maintenance.php" method="post">
	<input type="submit" name="insert" value="Insert New Data"/>
	<input type="submit" name="query" value="Search for Data"/>
	<input type="submit" name="report" value="Report"/>
</form>

<a href="../managerlogin.php">Go Back</a>
<a href="../../../main.php">Main Page</a>
<?php include "../../../templates/footer.php"; ?>