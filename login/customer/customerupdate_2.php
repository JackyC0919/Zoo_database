<!-- NEW -->
<?php
try {
		require "../../config.php";
		require "../../common.php";

		$connection = new PDO($dsn, $username, $password, $options);

		$sql = "SELECT *
				FROM customers
				WHERE email = :email";
		session_start();
		$email = $_SESSION["email"];

		$statement = $connection->prepare($sql);
		$statement->bindParam(':email', $email, PDO::PARAM_STR);
		$statement->execute();

		$result = $statement->fetchAll();
	} catch(PDOException $error) {
		echo $sql . "<br>" . $error->getMessage();
		}

?>
<!--     -->


<?php
if(isset($_POST['submit'])){
	try {
		require "../../config.php";
		require "../../common.php";
		
		$connection = new PDO($dsn, $username, $password, $options);
		
		$first_name        = $_POST['first_name'];
		$middle_name       = $_POST['middle_name'];
		$last_name         = $_POST['last_name'];
		
		session_start();
		$email = $_SESSION["email"];
		
		$sql = "UPDATE customers
			    SET first_name    = '$first_name',
				    middle_name   = '$middle_name',
				    last_name     = '$last_name'
			    WHERE email = :email";
			
		$statement = $connection->prepare($sql);
		$statement->bindValue(':email', $email);
		$statement->execute();
		print_r("Data successfully Updated. Redirect to profile in 3sec...");
		header("refresh:3; url=profile.php");
		
	}catch(PDOException $error) {
		echo "Error: ";
		print_r($statement->errorInfo());
	}	
}

?>

<?php include "../../templates/header.php"; ?>


<link rel="stylesheet" href="../../css/style.css" />
<h2>Update your profile</h2>

<?php if ($result && $statement->rowCount() > 0) { ?>
<?php foreach ($result as $row) { ?>
<form method="post">
        <label for="first_name">First Name</label>
    	<input type="text" name="first_name" id="first_name" value="<?php echo escape($row['first_name']); ?>">
    	<label for="middle_name">Middle Name</label>
    	<input type="text" name="middle_name" id="middle_name" value="<?php echo escape($row['middle_name']); ?>">
		<label for="last_name">Last Name</label>
    	<input type="text" name="last_name" id="last_name" value="<?php echo escape($row['last_name']); ?>">
    	<input type="submit" name="submit" value="Submit">
</form>
 <?php } ?>
   <?php } else { ?>
    > No results found for <?php echo escape($_POST['customer_id']); ?>.
  <?php } ?>

<?php include "../../templates/footer.php"; ?>