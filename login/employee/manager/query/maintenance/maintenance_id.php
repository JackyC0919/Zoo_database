<?php
if (isset($_POST['submit'])) {
  try {
    require "../../../../../config.php";
    require "../../../../../common.php";

    $connection = new PDO($dsn, $username, $password, $options);

    $sql = "SELECT *
    FROM maintenance
    WHERE maintenance_id = :maintenance_id";

    $maintenance_id = $_POST['maintenance_id'];

    $statement = $connection->prepare($sql);
	$statement->bindParam(':maintenance_id', $maintenance_id, PDO::PARAM_STR);
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
  <th>Maintenance ID</th>
  <th>Date</th>
  <th>Region</th>
  <th>Maintenance Type</th>
  <th>Priority</th>
  <th>Information</th>
  <th>Status</th>
  <th>Edit</th>
</tr>
      </thead>
      <tbody>
  <?php foreach ($result as $row) { ?>
      <tr>
<td><?php echo escape($row["maintenance_id"]); ?></td>
<td><?php echo escape($row["date_init"]); ?></td>
<td><?php echo escape($row["maintenance_loc"]); ?></td>
<td><?php echo escape($row["maintenance_type_fk"]); ?></td>
<td><?php echo escape($row["priority_fk"]); ?></td>
<td><?php echo escape($row["info"]); ?></td>
<td><?php echo escape($row["is_completed"]); ?></td>
<td><a href="maintenanceupdate.php?id=<?php echo escape($row["maintenance_id"]); ?>">Edit</a></td>
      </tr>
    <?php } ?>
      </tbody>
  </table>
  <?php } else { ?>
    > No results found for <?php echo escape($_POST['maintenance_id']); ?>.
  <?php }
} ?>

<h2>Find data based on Maintenance ID</h2>

<form method="post">
  <label for="maintenance_id">Maintenance ID </label>
  <input type="text" id="maintenance_id" name="maintenance_id">
  <input type="submit" name="submit" value="View Results">
</form>
<a href="maintenancesearch.php">Go Back</a>
<?php include "../../../../../templates/footer.php"; ?>