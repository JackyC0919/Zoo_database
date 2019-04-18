<?php
if (isset($_POST['submit'])) {
  try {
    require "../../../../../config.php";
    require "../../../../../common.php";

    $connection = new PDO($dsn, $username, $password, $options);

    $sql = "SELECT *
    FROM giftshops
    WHERE giftshop_location = :giftshop_location";

    $giftshop_location = $_POST['giftshop_location'];

    $statement = $connection->prepare($sql);
	$statement->bindParam(':giftshop_location', $giftshop_location, PDO::PARAM_STR);
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
  <th>Giftshop ID</th>
  <th>Location</th>
  <th>Name</th>
  <th>Product ID</th>
  <th>Stock</th>
  <th>Edit</th>
</tr>
      </thead>
      <tbody>
  <?php foreach ($result as $row) { ?>
      <tr>
<td><?php echo escape($row["giftshop_id"]); ?></td>
<td><?php echo escape($row["giftshop_location"]); ?></td>
<td><?php echo escape($row["giftshop_name"]); ?></td>
<td><?php echo escape($row["product_id_fk"]); ?></td>
<td><?php echo escape($row["stock"]); ?></td>
<td><a href="giftshopupdate.php?id=<?php echo escape($row["giftshop_id"]); ?>">Edit</a></td>
      </tr>
    <?php } ?>
      </tbody>
  </table>
  <?php } else { ?>
    > No results found for <?php echo escape($_POST['giftshop_location']); ?>.
  <?php }
} ?>

<h2>Find data based on Giftshop Location</h2>

<form method="post">
  <label for="giftshop_location">Giftshop Location </label>
  <input type="text" id="giftshop_location" name="giftshop_location">
  <input type="submit" name="submit" value="View Results">
</form>
<a href="giftshopsearch.php">Go Back</a>
<?php include "../../../../../templates/footer.php"; ?>