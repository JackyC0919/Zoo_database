<?php
	if(isset($_POST['t_type'])){
		header("Location: reports/visit.php");
	}
	
?>

<?php include "../../../templates/header.php"; ?>
<link rel="stylesheet" href="../../../css/style.css" />
<h2>Reports</h2>
<form action="reports.php" method="post">
	
	<input type="submit" name="t_type" value="Visit by Ticket Category"/>
</form>

<a href="../managerlogin.php">Go Back</a>
<a href="../../../main.php">Main Page</a>
<?php include "../../../templates/footer.php"; ?>