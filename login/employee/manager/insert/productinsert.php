<?php
if (isset($_POST['submit'])){
	require "../../../../config.php";
	require "../../../../common.php";
	
	try{
		$connection = new PDO($dsn, $username, $password, $options);
		
		$new_product = array(
		 "product_name"  => $_POST['product_name'],
		 "price"         => $_POST['price'],
		 "last_ordered"  => $_POST['last_ordered'],
		 "total_stock"   => $_POST['total_stock'],
		);
		
		$sql = sprintf(
		 "INSERT INTO %s (%s) values (%s)",
		 "product",
		 implode(", ", array_keys($new_product)),
		 ":" . implode(", :", array_keys($new_product))
		);
		
		$statement = $connection->prepare($sql);
		$statement->execute($new_product);
		print_r("Data successfully added.");
		
	} catch(PDOException $error) {
		echo "Error: ";
		print_r($statement->errorInfo());
	}
}
?>

<?php include "../../../../templates/header.php"; ?>
<link rel="stylesheet" href="../../../../css/style.css" />

<strong>Product</strong>
<form method="post">
        <label for="product_name">Name</label>
    	<input type="text" name="product_name" id="product_name">
    	<label for="price">Price</label>
    	<input type="text" name="price" id="price">
		<label for="last_ordered">Last Ordered (YYYY-MM-DD HH:MM:SS)</label>
    	<input type="text" name="last_ordered" id="last_ordered">
		<label for="total_stock">Total Stock</label>
    	<input type="text" name="total_stock" id="total_stock">
    	<input type="submit" name="submit" value="Submit">
    </form>
	
<a href="../products.php">Go Back</a>
<?php include "../../../../templates/footer.php"; ?>