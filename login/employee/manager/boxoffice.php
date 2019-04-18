<?php
	if(isset($_POST['insert'])){
		header("Location: insert/boxofficeinsert.php");
	}
	if(isset($_POST['query'])){
		header("Location: query/boxoffice/boxofficesearch.php");
	}
	if(isset($_POST['report'])){
		header("Location: query/boxoffice/visit.php");
	}
?>

<?php include "../../../templates/header.php"; ?>
<link rel="stylesheet" href="../../../css/style.css" />
<h2>BoxOffice</h2>
<form action="boxoffice.php" method="post">
	<input type="submit" name="insert" value="Insert New Data"/>
	<input type="submit" name="query" value="Search for Data"/>
	<input type="submit" name="report" value="Ticket Report"/>
</form>

<a href="../managerlogin.php">Go Back</a>
<a href="../../../main.php">Main Page</a>
<?php include "../../../templates/footer.php"; ?>