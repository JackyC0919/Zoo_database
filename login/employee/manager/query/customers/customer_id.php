<?php
if (isset($_POST['submit'])) {
  try {
    require "../../../../../config.php";
    require "../../../../../common.php";

    $connection = new PDO($dsn, $username, $password, $options);

    $sql = "SELECT *
    FROM customers
    WHERE customer_id = :customer_id";

    $customer_id = $_POST['customer_id'];

    $statement = $connection->prepare($sql);
	$statement->bindParam(':customer_id', $customer_id, PDO::PARAM_STR);
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
  <th>Customer ID</th>
  <th>First Name</th>
  <th>Middle Name</th>
  <th>Last Name</th>
  <th>Gender</th>
  <th>Amount Spent</th>
  <th>Membership</th>
  <th>Email</th>
  <th>Edit</th>
  <th>Delete</th>
</tr>
      </thead>
      <tbody>
  <?php foreach ($result as $row) { ?>
      <tr>
<td><?php echo escape($row["customer_id"]); ?></td>
<td><?php echo escape($row["first_name"]); ?></td>
<td><?php echo escape($row["middle_name"]); ?></td>
<td><?php echo escape($row["last_name"]); ?></td>
<td><?php echo escape($row["gender_id_fk"]); ?></td>
<td><?php echo escape($row["amount_spent"]); ?></td>
<td><?php echo escape($row["membership"]); ?></td>
<td><?php echo escape($row["email"]); ?></td>
<td><a href="customerupdate.php?id=<?php echo escape($row["customer_id"]); ?>">Edit</a></td>
<td><a href="customerdelete.php?id=<?php echo escape($row["customer_id"]); ?>">Delete</a></td>
      </tr>
    <?php } ?>
      </tbody>
  </table>
  <?php } else { ?>
    > No results found for <?php echo escape($_POST['customer_id']); ?>.
  <?php }
} ?>

<h2>Find data based on Customer ID</h2>

<form method="post">
  <label for="customer_id">Customer ID </label>
  <input type="text" id="customer_id" name="customer_id">
  <input type="submit" name="submit" value="View Results">
</form>
<a href="customers.php">Go Back</a>
<?php include "../../../../../templates/footer.php"; ?>