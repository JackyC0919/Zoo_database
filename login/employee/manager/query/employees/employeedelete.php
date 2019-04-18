<?php
if (isset($_POST['submit'])){
	require "../../../../../config.php";
	require "../../../../../common.php";
	
	try{
		$connection = new PDO($dsn, $username, $password, $options);
		
		$employee_id         = $_GET['id'];		
		
		$sql = "UPDATE employees
		        SET to_delete = '1'
				WHERE employee_id = :employee_id";
				
		$statement = $connection->prepare($sql);
		$statement->bindValue(':employee_id', $employee_id);
		$statement->execute();
		
		print_r("Data successfully Deleted. Redirect to profile in 3sec...");
		header("refresh:3; url=employees.php");
		
	}catch(PDOException $error) {
		echo "Error: ";
		print_r($statement->errorInfo());
	}
}
?>

<?php include "../../../../../templates/header.php"; ?>
<link rel="stylesheet" href="../../../../../css/style.css" />
<strong>Delete Employee</strong>

<form method="post">
    	<input type="submit" name="submit" value="Delete">
</form>

<a href="employees.php">Go Back</a>
<?php include "../../../../../templates/footer.php"; ?>