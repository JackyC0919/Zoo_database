<?php
if (isset($_POST['submit'])){
	require "../../../../../config.php";
	require "../../../../../common.php";
	
	try{
		$connection = new PDO($dsn, $username, $password, $options);
		
		$animal_id_fk          = $_GET['id'];
		$dietary_requirement   = $_POST['dietary_requirement'];
		$last_fed              = $_POST['last_fed'];
		$vaccination_date      = $_POST['vaccination_date'];
		$animal_trainer_id     = $_POST['animal_trainer_id'];

		
		$sql = "UPDATE animalcare
		        SET dietary_requirement   = '$dietary_requirement',
					last_fed 		      = '$last_fed',
					vaccination_date 	  = '$vaccination_date',
					animal_trainer_id     = '$animal_trainer_id'
				WHERE animal_id_fk = :animal_id_fk";
				
		$statement = $connection->prepare($sql);
		$statement->bindValue(':animal_id_fk', $animal_id_fk);
		$statement->execute();
		
		print_r("Data successfully Updated. Redirect to profile in 3sec...");
		header("refresh:3; url=animalcaresearch.php");
		
	}catch(PDOException $error) {
		echo "Error: ";
		print_r($statement->errorInfo());
	}
}
?>

<?php include "../../../../../templates/header.php"; ?>
<link rel="stylesheet" href="../../../../../css/style.css" />
<strong>Update Animalcare</strong>

<form method="post">
        <label for="dietary_requirement">Dietary Requirement</label>
    	<input type="text" name="dietary_requirement" id="dietary_requirement">
		<label for="last_fed">Last Fed (YYYY-MM-DD HH:MM:SS)</label>
    	<input type="text" name="last_fed" id="last_fed">
		<label for="vaccination_date">Vaccination Date (YYYY-MM-DD)</label>
    	<input type="text" name="vaccination_date" id="vaccination_date">
		<label for="animal_trainer_id">Trainer ID</label>
    	<input type="text" name="animal_trainer_id" id="animal_trainer_id">
    	<input type="submit" name="submit" value="Submit">
    </form>

<a href="animalcaresearch.php">Go Back</a>
<?php include "../../../../../templates/footer.php"; ?>