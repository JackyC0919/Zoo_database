<?php
if (isset($_POST['submit'])){
	require "../../../../config.php";
	require "../../../../common.php";
	
	try{
		$connection = new PDO($dsn, $username, $password, $options);
		
		$giftshop_location   = $_POST['giftshop_location'];
		$giftshop_name       = $_POST['giftshop_name'];
		$product_id_fk     = $_POST['product_id_fk'];
		$stock               = $_POST['stock'];
		
		$sql = "INSERT INTO giftshops (giftshop_location, giftshop_name, product_id_fk, stock) 
               VALUES ('$giftshop_location', '$giftshop_name', '$product_id_fk', '$stock')";
		
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

<strong>Giftshop</strong>
<form method="post">
		<label for="giftshop_location">Location</label>
    	<input type="text" name="giftshop_location" id="giftshop_location">
		<label for="giftshop_name">Giftshop Name</label>
    	<input type="text" name="giftshop_name" id="giftshop_name">
		<label for="product_id_fk">Product ID</label>
    	<input type="text" name="product_id_fk" id="product_id_fk">
		<label for="stock">Stock</label>
    	<input type="text" name="stock" id="stock">
    	<input type="submit" name="submit" value="Submit">
    </form>
	
<a href="../giftshops.php">Go Back</a>
<?php include "../../../../templates/footer.php"; ?>