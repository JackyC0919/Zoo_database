<?php
	if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['animals'])){
		header("Location: trainer/animals.php");
	}
	if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['animalcare'])){
		header("Location: trainer/animalcare.php");
	}
?>

<?php include "../../templates/header.php"; ?>
<link rel="stylesheet" href="../../css/style.css" />
<h2>Hello Trainer</h2>
<form action="trainerlogin.php" method="post">
	<input type="submit" name="animals" value="Animals"/>
	<input type="submit" name="animalcare" value="AnimalCare"/>
</form>


<a href="employeelogout.php">Sign out</a>
<a href="../../main.php">Main Page</a>
<?php include "../../templates/footer.php"; ?>