<?php
if (isset($_POST['submit'])){
	require "../../../../../config.php";
	require "../../../../../common.php";
	
	try{
		$connection = new PDO($dsn, $username, $password, $options);
		
		$maintenance_id         = $_GET['id'];
		$maintenance_loc        = $_POST['maintenance_loc'];
		$maintenance_type_fk    = $_POST['maintenance_type_fk'];
		$priority_fk            = $_POST['priority_fk'];
		$info                   = $_POST['info'];
		
		$sql = "UPDATE maintenance
		        SET maintenance_loc       = '$maintenance_loc',
					maintenance_type_fk   = '$maintenance_type_fk',
					priority_fk           = '$priority_fk',
					info                  = '$info'
				WHERE maintenance_id = :maintenance_id";
				
		$statement = $connection->prepare($sql);
		$statement->bindValue(':maintenance_id', $maintenance_id);
		$statement->execute();
		
		print_r("Data successfully Updated. Redirect to maintenance in 3sec...");
		header("refresh:3; url=maintenancesearch.php");
		
	}catch(PDOException $error) {
		echo "Error: ";
		print_r($statement->errorInfo());
	}
}
?>

<?php include "../../../../../templates/header.php"; ?>
<link rel="stylesheet" href="../../../../../css/style.css" />
<strong>Update Maintenance</strong>

<form method="post">
    	<label for="maintenance_loc">Region</label>
    	<input type="text" name="maintenance_loc" id="maintenance_loc">
		<label for="maintenance_type_fk">Maintenance Type</label>
    	<input type="text" name="maintenance_type_fk" id="maintenance_type_fk">
		<label for="priority_fk">Priority</label>
    	<input type="text" name="priority_fk" id="priority_fk">
		<label for="info">Information</label>
    	<input type="text" name="info" id="info">
    	<input type="submit" name="submit" value="Submit">
    </form>

<a href="maintenancesearch.php">Go Back</a>
<?php include "../../../../../templates/footer.php"; ?>