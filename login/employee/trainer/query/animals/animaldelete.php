<?php
if (isset($_POST['submit'])){
	require "../../../../../config.php";
	require "../../../../../common.php";
	
	try{
		$connection = new PDO($dsn, $username, $password, $options);
		
		$animal_id           = $_GET['id'];
		
		$sql = "UPDATE animals
		        SET to_delete = '1'
				WHERE animal_id = :animal_id";
				
		$statement = $connection->prepare($sql);
		$statement->bindValue(':animal_id', $animal_id);
		$statement->execute();
		
		print_r("Data successfully Deleted. Redirect to profile in 3sec...");
		header("refresh:3; url=animalsearch.php");
		
	}catch(PDOException $error) {
		echo "Error: ";
		print_r($statement->errorInfo());
	}
}
?>

<?php include "../../../../../templates/header.php"; ?>
<link rel="stylesheet" href="../../../../../css/style.css" />
<strong>Delete Animal</strong>

<form method="post">
    	<input type="submit" name="submit" value="Delete">
</form>

<a href="animalsearch.php">Go Back</a>
<?php include "../../../../../templates/footer.php"; ?>