<?php
if (isset($_POST['submit'])){
	require "../../../../../config.php";
	require "../../../../../common.php";
	
	try{
		$connection = new PDO($dsn, $username, $password, $options);
		
		$customer_id       = $_GET['id'];		
		
		$sql = "UPDATE customers
		        SET to_delete = '1'
				WHERE customer_id = :customer_id";
				
		$statement = $connection->prepare($sql);
		$statement->bindValue(':customer_id', $customer_id);
		$statement->execute();
		
		print_r("Data successfully Deleted. Redirect to profile in 3sec...");
		header("refresh:3; url=customers.php");
		
	}catch(PDOException $error) {
		echo "Error: ";
		print_r($statement->errorInfo());
	}
}
?>

<?php include "../../../../../templates/header.php"; ?>
<link rel="stylesheet" href="../../../../../css/style.css" />
<strong>Delete Customer</strong>

<form method="post">
    	<input type="submit" name="submit" value="Delete">
</form>

<a href="customers.php">Go Back</a>
<?php include "../../../../../templates/footer.php"; ?>