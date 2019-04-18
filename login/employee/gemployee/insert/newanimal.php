<?php
if (isset($_POST['submit'])){
	require "../../../../config.php";
	require "../../../../common.php";
	
	try{
		$connection = new PDO($dsn, $username, $password, $options);
		
		$enclosure_type_fk   = $_POST['enclosure_type_fk'];
		$animal_name         = $_POST['animal_name'];
		$animal_order        = $_POST['animal_order'];
		$animal_genus        = $_POST['animal_genus'];
		$animal_family       = $_POST['animal_family'];
		$animal_dob          = $_POST['animal_dob'];
		$animal_gender_id_fk = $_POST['animal_gender_id_fk'];
		$animal_weight       = $_POST['animal_weight'];
		
		$sql = "INSERT INTO animals (enclosure_type_fk, animal_name, animal_order, animal_genus, animal_family, animal_dob, animal_gender_id_fk, animal_weight) 
               VALUES ('$enclosure_type_fk', '$animal_name', '$animal_order', '$animal_genus', '$animal_family', '$animal_dob', '$animal_gender_id_fk', '$animal_weight')";
		
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

<strong>New Animal</strong>
<form method="post">
        <label for="enclosure_type_fk">Region</label>
    	<input type="text" name="enclosure_type_fk" id="enclosure_type_fk">
    	<label for="animal_name">Name</label>
    	<input type="text" name="animal_name" id="animal_name">
		<label for="animal_order">Order</label>
    	<input type="text" name="animal_order" id="animal_order">
		<label for="animal_genus">Genus</label>
    	<input type="text" name="animal_genus" id="animal_genus">
		<label for="animal_family">Family</label>
    	<input type="text" name="animal_family" id="animal_family">
		<label for="animal_dob">Date of Birth</label>
    	<input type="text" name="animal_dob" id="animal_dob">
		<label for="animal_gender_id_fk">Gender</label>
    	<input type="text" name="animal_gender_id_fk" id="animal_gender_id_fk">
		<label for="animal_weight">Weight</label>
    	<input type="text" name="animal_weight" id="animal_weight">
    	<input type="submit" name="submit" value="Submit">
    </form>
	
<a href="../animals.php">Go Back</a>
<?php include "../../../../templates/footer.php"; ?>