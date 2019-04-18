<?php
if (isset($_POST['submit'])){
	require "../../../../config.php";
	require "../../../../common.php";
	
	try{
		$connection = new PDO($dsn, $username, $password, $options);
		
		$last_repaired        = $_POST['last_repaired'];
		$maintenance_loc      = $_POST['maintenance_loc'];
		$repairman_id_fk      = $_POST['repairman_id_fk'];
		$maintenance_type_fk  = $_POST['maintenance_type_fk'];
		
		$sql = "INSERT INTO maintenance (last_repaired, maintenance_loc, repairman_id_fk, maintenance_type_fk)
		VALUES ('$last_repaired', '$maintenance_loc', '$repairman_id_fk', '$maintenance_type_fk')";
		
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
        <label for="last_repaired">Last repaired (YYYY-MM-DD)</label>
    	<input type="text" name="last_repaired" id="last_repaired">
    	<label for="maintenance_loc">Region</label>
    	<input type="text" name="maintenance_loc" id="maintenance_loc">
		<label for="repairman_id_fk">Repairman ID</label>
    	<input type="text" name="repairman_id_fk" id="repairman_id_fk">
		<label for="maintenance_type_fk">Maintenance Type</label>
    	<input type="text" name="maintenance_type_fk" id="maintenance_type_fk">
    	<input type="submit" name="submit" value="Submit">
    </form>
	
<a href="../maintenance.php">Go Back</a>
<?php include "../../../../templates/footer.php"; ?>