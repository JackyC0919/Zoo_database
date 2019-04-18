<?php
if (isset($_POST['submit'])){
	require "../../../../../config.php";
	require "../../../../../common.php";
	
	try{
		$connection = new PDO($dsn, $username, $password, $options);
		
		$giftshop_id           = $_GET['id'];
		$employee_id_fk        = $_POST['employee_id_fk'];
		$giftshop_location     = $_POST['giftshop_location'];
		$giftshop_name         = $_POST['giftshop_name'];
		$manager_id            = $_POST['manager_id'];
		$product_id_fk         = $_POST['product_id_fk'];
		$stock                 = $_POST['stock'];
		
		$sql = "UPDATE giftshops
		        SET employee_id_fk        = '$employee_id_fk',
					giftshop_location     = '$giftshop_location',
					giftshop_name 	      = '$giftshop_name',
					manager_id 		      = '$manager_id',
					product_id_fk 		  = '$product_id_fk',
					stock 			      = '$stock'
				WHERE giftshop_id = :giftshop_id";
				
		$statement = $connection->prepare($sql);
		$statement->bindValue(':giftshop_id', $giftshop_id);
		$statement->execute();
		
		print_r("Data successfully Updated. Redirect to profile in 3sec...");
		header("refresh:3; url=giftshopsearch.php");
		
	}catch(PDOException $error) {
		echo "Error: ";
		print_r($statement->errorInfo());
	}
}
?>

<?php include "../../../../../templates/header.php"; ?>
<link rel="stylesheet" href="../../../../../css/style.css" />
<strong>Update Giftshop</strong>

<form method="post">
    	<label for="employee_id_fk">Employee ID</label>
    	<input type="text" name="employee_id_fk" id="employee_id_fk">
		<label for="giftshop_location">Location</label>
    	<input type="text" name="giftshop_location" id="giftshop_location">
		<label for="giftshop_name">Giftshop Name</label>
    	<input type="text" name="giftshop_name" id="giftshop_name">
		<label for="manager_id">Manager ID</label>
    	<input type="text" name="manager_id" id="manager_id">
		<label for="product_id_fk">Product ID</label>
    	<input type="text" name="product_id_fk" id="product_id_fk">
		<label for="stock">Stock</label>
    	<input type="text" name="stock" id="stock">
    	<input type="submit" name="submit" value="Submit">
    </form>

<a href="giftshopsearch.php">Go Back</a>
<?php include "../../../../../templates/footer.php"; ?>

