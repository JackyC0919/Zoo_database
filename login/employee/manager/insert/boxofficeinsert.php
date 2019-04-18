<?php
if (isset($_POST['submit'])){
	require "../../../../config.php";
	require "../../../../common.php";
	
	try{
		$connection = new PDO($dsn, $username, $password, $options);
		
		$ticket_id_fk        = $_POST['ticket_id_fk'];
		
		$sql = "INSERT INTO boxoffice (ticket_id_fk) 
               VALUES ('$ticket_id_fk')";
		
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

<strong>Box Office</strong>
<form method="post">
    	<label for="ticket_id_fk">Ticket ID</label>
    	<input type="text" name="ticket_id_fk" id="ticket_id_fk">
    	<input type="submit" name="submit" value="Submit">
    </form>
	
<a href="../boxoffice.php">Go Back</a>
<?php include "../../../../templates/footer.php"; ?>