<?php
	require "../../../config.php";
	require "../../../common.php";
	
	try{
		$connection = new PDO($dsn, $username, $password, $options);
		
		$maintenance_id = $_GET['id'];

		$sql = "UPDATE maintenance
		        SET is_completed   = '1'
				WHERE maintenance_id = :maintenance_id";
				
		$statement = $connection->prepare($sql);
		$statement->bindValue(':maintenance_id', $maintenance_id);
		$statement->execute();
		
		print_r("Case has been mark as Completed.");
		
	}catch(PDOException $error) {
		echo "Error: ";
		print_r($statement->errorInfo());
	}
?>

<?php include "../../../templates/header.php"; ?>
<link rel="stylesheet" href="../../../css/style.css" />
<strong>Update Maintenance</strong>

<a href="../repairmanlogin.php">Go Back</a>
<?php include "../../../templates/footer.php"; ?>