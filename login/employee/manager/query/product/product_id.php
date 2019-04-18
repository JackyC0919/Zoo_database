<?php
if (isset($_POST['submit'])) {
  try {
    require "../../../../../config.php";
    require "../../../../../common.php";

    $connection = new PDO($dsn, $username, $password, $options);

    $sql = "SELECT *
    FROM product
    WHERE product_id = :product_id";

    $product_id = $_POST['product_id'];

    $statement = $connection->prepare($sql);
	$statement->bindParam(':product_id', $product_id, PDO::PARAM_STR);
    $statement->execute();

    $result = $statement->fetchAll();
  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }
}
?>

<?php include "../../../../../templates/header.php"; ?>
<link rel="stylesheet" href="../../../../../css/style.css" />
<?php
if (isset($_POST['submit'])) {
  if ($result && $statement->rowCount() > 0) { ?>
    <h2>Results</h2>

    <table>
      <thead>
<tr>
  <th>Product Name</th>
  <th>Price</th>
  <th>Last Ordered</th>
  <th>Total Stock</th>
  <th>Edit</th>
  <th>Delete</th>
</tr>
      </thead>
      <tbody>
  <?php foreach ($result as $row) { ?>
      <tr>
<td><?php echo escape($row["product_name"]); ?></td>
<td><?php echo escape($row["price"]); ?></td>
<td><?php echo escape($row["last_ordered"]); ?></td>
<td><?php echo escape($row["total_stock"]); ?></td>
<td><a href="productupdate.php?id=<?php echo escape($row["product_id"]); ?>">Edit</a></td>
<td><a href="productdelete.php?id=<?php echo escape($row["product_id"]); ?>">Delete</a></td>
      </tr>
    <?php } ?>
      </tbody>
  </table>
  <?php } else { ?>
    > No results found for <?php echo escape($_POST['product_name']); ?>.
  <?php }
} ?>

<h2>Find data based on Product ID</h2>

<form method="post">
  <label for="product_id">Product ID </label>
  <input type="text" id="product_id" name="product_id">
  <input type="submit" name="submit" value="View Results">
</form>
<a href="productsearch.php">Go Back</a>
<?php include "../../../../../templates/footer.php"; ?>