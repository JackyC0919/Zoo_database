<?php
	if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['insert'])){
		header("Location: insert/animalcareinsert.php");
	}
	if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['query'])){
		header("Location: query/animalcare/animalcaresearch.php");
	}
?>

<?php include "../../../templates/header.php"; ?>
<link rel="stylesheet" href="../../../css/style.css" />
<h2>Animal Care</h2>
<form action="animalcare.php" method="post">
	<input type="submit" name="insert" value="Insert New Data"/>
	<input type="submit" name="query" value="Search for Data"/>
</form>

<a href="../trainerlogin.php">Go Back</a>
<a href="../../../main.php">Main Page</a>
<?php include "../../../templates/footer.php"; ?>