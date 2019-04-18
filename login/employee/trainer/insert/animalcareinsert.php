<?php
if (isset($_POST['submit'])){
	require "../../../../config.php";
	require "../../../../common.php";
	
	try{
		$connection = new PDO($dsn, $username, $password, $options);
		
		$dietary_requirement   = $_POST['dietary_requirement'];
		$animal_id_fk          = $_POST['animal_id_fk'];
		$last_fed              = $_POST['last_fed'];
		$vaccination_date      = $_POST['vaccination_date'];
		$animal_trainer_id     = $_POST['animal_trainer_id'];


		$sql = "INSERT INTO animalcare (dietary_requirement, animal_id_fk, last_fed, vaccination_date, animal_trainer_id) 
               VALUES ('$dietary_requirement', '$animal_id_fk', '$last_fed', '$vaccination_date', '$animal_trainer_id')";
		
		$statement = $connection->prepare($sql);
		$statement->execute();
		print_r("Data successfully added.");
		
	} catch(PDOException $error) {
		echo "Error: ";
		print_r($statement->errorInfo());
	}
}
?>

<?php include "../../../../templates/header.php"; ?>
<link rel="stylesheet" href="../../../../css/style.css" />

<strong>AnimalCare</strong>
<form method="post">
        <label for="dietary_requirement">Dietary Requirement</label>
    	<input type="text" name="dietary_requirement" id="dietary_requirement">
    	<label for="animal_id_fk">Animal ID</label>
    	<input type="text" name="animal_id_fk" id="animal_id_fk">
		<label for="last_fed">Last Fed (YYYY-MM-DD HH:MM:SS)</label>
    	<input type="text" name="last_fed" id="last_fed">
		<label for="vaccination_date">Vaccination Date (YYYY-MM-DD)</label>
    	<input type="text" name="vaccination_date" id="vaccination_date">
		<label for="animal_trainer_id">Trainer ID</label>
    	<input type="text" name="animal_trainer_id" id="animal_trainer_id">
    	<input type="submit" name="submit" value="Submit">
    </form>
	
<a href="../animalcare.php">Go Back</a>
<?php include "../../../../templates/footer.php"; ?>