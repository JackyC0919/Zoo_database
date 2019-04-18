<?php
	if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['region'])){
		header("Location: region.php");
	}
	
?>

<?php include "../templates/header.php"; ?>
<h2>Animals</h2>
<form action="animal.php" method="post">
	<input type="submit" name="region" value="Region"/>
</form>

<a href="../main.php">Go Back</a>
<?php include "../templates/footer.php"; ?>