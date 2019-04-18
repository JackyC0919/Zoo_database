<?php
if (isset($_POST['submit'])){
	require "../../../../config.php";
	require "../../../../common.php";
	
	try{
		$connection = new PDO($dsn, $username, $password, $options);
		
		$first_name        = $_POST['first_name'];
		$middle_name       = $_POST['middle_name'];
		$last_name         = $_POST['last_name'];
		$gender_id_fk      = $_POST['gender_id_fk'];
		$membership        = $_POST['membership'];
		$email             = $_POST['email'];

		
		$sql = "INSERT INTO customers (first_name, middle_name, last_name, gender_id_fk, membership, email)
		        VALUES ('$first_name','$middle_name','$last_name', '$gender_id_fk', $membership, '$email')";
		
		$statement = $connection->prepare($sql);
		$statement->execute();
		print_r("Data successfully added.");

		
	} catch(PDOException $error) {
		echo "Error: ";
		print_r($statement->errorInfo());
		//echo "Error: " . $error->getMassage();
	}
}
?>


<?php include "../../../../templates/header.php"; ?>
<link rel="stylesheet" href="../../../../css/style.css" />

<strong>New Customer</strong>
<form method="post">
        <label for="first_name">First Name</label>
    	<input type="text" name="first_name" id="first_name">
    	<label for="middle_name">Middle Name</label>
    	<input type="text" name="middle_name" id="middle_name">
		<label for="last_name">Last Name</label>
    	<input type="text" name="last_name" id="last_name">
		<label for="gender_id_fk">Gender</label>
    	<input type="text" name="gender_id_fk" id="gender_id_fk">
		<label for="membership">Membership</label>
    	<input type="text" name="membership" id="membership">
		<label for="email">Email</label>
    	<input type="text" name="email" id="email">
    	<input type="submit" name="submit" value="Submit">
    </form>

<a href="../customerprofile.php">Go Back</a>
<?php include "../../../../templates/footer.php"; ?>