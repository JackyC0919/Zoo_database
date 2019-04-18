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
		
		if($product_id_fk == 1 && $stock > 1000){
			print_r("Stock: higher than maximum stock! automatically set to maximum ");
		}else if ($product_id_fk == 2 && $stock > 500){
			print_r("Stock: higher than maximum stock! automatically set to maximum ");
		}else if ($product_id_fk == 3 && $stock > 750){
			print_r("Stock: higher than maximum stock! automatically set to maximum ");
		}else if ($product_id_fk == 4 && $stock > 500){
			print_r("Stock: higher than maximum stock! automatically set to maximum ");
		}else if ($product_id_fk == 5 && $stock > 600){
			print_r("Stock: higher than maximum stock! automatically set to maximum ");
		}else if ($product_id_fk == 6 && $stock > 500){
			print_r("Stock: higher than maximum stock! automatically set to maximum ");
		}
		
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