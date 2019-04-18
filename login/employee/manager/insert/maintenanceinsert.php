<?php
if (isset($_POST['submit'])){
	require "../../../../config.php";
	require "../../../../common.php";
	
	try{
		$connection = new PDO($dsn, $username, $password, $options);
		
		$maintenance_loc      = $_POST['maintenance_loc'];
		$maintenance_type_fk  = $_POST['maintenance_type_fk'];
		$priority_fk          = $_POST['priority_fk'];
		$info                 = $_POST['info'];
		
		$sql = "INSERT INTO maintenance (maintenance_loc, maintenance_type_fk, priority_fk, info)
		        VALUES ('$maintenance_loc', '$maintenance_type_fk', '$priority_fk', '$info')";
		
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
<strong>Maintenance</strong>
<form method="post">
    	<label for="maintenance_loc">Region</label>
    	<input type="text" name="maintenance_loc" id="maintenance_loc">
		<label for="maintenance_type_fk">Maintenance Type (1.Electrical, 2.Structural, 3.Sanitary, 4.Other)</label>
    	<input type="text" name="maintenance_type_fk" id="maintenance_type_fk">
		<label for="priority_fk">Priority (1 = low, 2 = medium, 3 = high)</label>
    	<input type="text" name="priority_fk" id="priority_fk">
		<label for="info">Information</label>
    	<input type="text" name="info" id="info">
    	<input type="submit" name="submit" value="Submit">
    </form>
	
<a href="../maintenance.php">Go Back</a>
<?php include "../../../../templates/footer.php"; ?>