<?php
if(isset($_POST['product'])){
	try {
		require "../config.php";
		require "../common.php";

		$connection = new PDO($dsn, $username, $password, $options);

		$sql = "SELECT product_name, price
				FROM product";

		$statement = $connection->prepare($sql);
		$statement->execute();

		$result = $statement->fetchAll();
	} catch(PDOException $error) {
		echo $sql . "<br>" . $error->getMessage();
	}
}
?>

<?php include "../templates/header.php"; ?>
<h2>SHOP</h2>
<form action="giftshop.php" method="post">
	<input type="submit" name="product" value="Product"/>
</form>

<?php
if (isset($_POST['product'])) {
  if ($result && $statement->rowCount() > 0) { ?>
    <table>
      <thead>
<tr>
  <th>Product</th>
  <th>Price</th>
</tr>
      </thead>
      <tbody>
  <?php foreach ($result as $row) { ?>
      <tr>
<td><?php echo escape($row["product_name"]); ?></td>
<td><?php echo escape($row["price"]); ?></td>
      </tr>
    <?php } ?>
      </tbody>
  </table>
  <?php } else { ?>
    > No results found for <?php echo escape($_POST['customer_id']); ?>.
  <?php }
} 
?>

<a href="../main.php">Go Back</a>
<?php include "../templates/footer.php"; ?>