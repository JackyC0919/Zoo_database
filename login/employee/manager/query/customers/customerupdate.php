<?php
if(isset($_POST['submit'])){
	try {
		require "../../../../../config.php";
		require "../../../../../common.php";
		
		$connection = new PDO($dsn, $username, $password, $options);
		
		$customer_id       = $_GET['id'];
		$first_name        = $_POST['first_name'];
		$middle_name       = $_POST['middle_name'];
		$last_name         = $_POST['last_name'];
		$amount_spent      = $_POST['amount_spent'];
		$email             = $_POST['email'];
		
		$sql = "UPDATE customers
			    SET first_name    = '$first_name',
				    middle_name   = '$middle_name',
				    last_name     = '$last_name',
				    amount_spent  = '$amount_spent',
				    email         = '$email'
			    WHERE customer_id = :customer_id";
			
		$statement = $connection->prepare($sql);
		$statement->bindValue(':customer_id', $customer_id);
		$statement->execute();
		print_r("Data successfully Updated. Redirect to profile in 3sec...");
		header("refresh:3; url=customers.php");
		
	}catch(PDOException $error) {
		echo "Error: ";
		print_r($statement->errorInfo());
	}	
}

?>

<?php include "../../../../../templates/header.php"; ?>
<link rel="stylesheet" href="../../../../../css/style.css" />
<strong>Update Customer</strong>

<form method="post">
        <label for="first_name">First Name</label>
    	<input type="text" name="first_name" id="first_name">
    	<label for="middle_name">Middle Name</label>
    	<input type="text" name="middle_name" id="middle_name">
		<label for="last_name">Last Name</label>
    	<input type="text" name="last_name" id="last_name">
		<label for="amount_spent">Amount Spent</label>
    	<input type="text" name="amount_spent" id="amount_spent">
		<label for="email">Email</label>
    	<input type="text" name="email" id="email">
    	<input type="submit" name="submit" value="Submit">
</form>

<a href="customers.php">Go Back</a>
<?php include "../../../../../templates/footer.php"; ?>