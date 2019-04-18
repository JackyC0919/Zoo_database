<?php
	if(isset($_POST['insert'])){
		header("Location: insert/newanimal.php");
	}
	if(isset($_POST['query'])){
		header("Location: query/animals/animalsearch.php");
	}
?>

<?php include "../../../templates/header.php"; ?>
<link rel="stylesheet" href="../../../css/style.css" />
<h2>Animals</h2>
<form action="animals.php" method="post">
	<input type="submit" name="insert" value="Insert New Data"/>
	<input type="submit" name="query" value="Search for Data"/>
</form>

<a href="../managerlogin.php">Go Back</a>
<a href="../../../main.php">Main Page</a>
<?php include "../../../templates/footer.php"; ?>