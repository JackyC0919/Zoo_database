<?php
if (isset($_POST['submit'])){
	require "../../../../../config.php";
	require "../../../../../common.php";
	
	try{
		$connection = new PDO($dsn, $username, $password, $options);
		
		$product_id         = $_GET['id'];
		
		$sql = "UPDATE product
		        SET to_delete      = '1'
				WHERE product_id = :product_id";
				
		$statement = $connection->prepare($sql);
		$statement->bindValue(':product_id', $product_id);
		$statement->execute();
		
		print_r("Data successfully Updated. Redirect to profile in 3sec...");
		header("refresh:3; url=productsearch.php");
		
	}catch(PDOException $error) {
		echo "Error: ";
		print_r($statement->errorInfo());
	}
}
?>

<?php include "../../../../../templates/header.php"; ?>
<link rel="stylesheet" href="../../../../../css/style.css" />
<strong>Delete Product</strong>

<form method="post">
    	<input type="submit" name="submit" value="Delete">
</form>

<a href="productsearch.php">Go Back</a>
<?php include "../../../../../templates/footer.php"; ?>