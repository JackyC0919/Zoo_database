<?php
if (isset($_POST['submit'])) {
  try {
    require "../../../../../config.php";
    require "../../../../../common.php";

    $connection = new PDO($dsn, $username, $password, $options);

    $sql = "SELECT *
    FROM maintenance
    WHERE maintenance_loc = :maintenance_loc";

    $maintenance_loc = $_POST['maintenance_loc'];

    $statement = $connection->prepare($sql);
	$statement->bindParam(':maintenance_loc', $maintenance_loc, PDO::PARAM_STR);
    $statement->execute();

    $result = $statement->fetchAll();
  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }
}
?>

<?php include "../../../../../templates/header.php"; ?>
<?php
if (isset($_POST['submit'])) {
  if ($result && $statement->rowCount() > 0) { ?>
    <h2>Results</h2>

    <table>
      <thead>
<tr>
  <th>Last Repaired</th>
  <th>Region</th>
  <th>Repairman ID</th>
  <th>Maintenance Type</th>
  <th>Edit</th>
</tr>
      </thead>
      <tbody>
  <?php foreach ($result as $row) { ?>
      <tr>
<td><?php echo escape($row["last_repaired"]); ?></td>
<td><?php echo escape($row["maintenance_loc"]); ?></td>
<td><?php echo escape($row["repairman_id_fk"]); ?></td>
<td><?php echo escape($row["maintenance_type_fk"]); ?></td>
<td><a href="maintenanceupdate.php?id=<?php echo escape($row["maintenance_id"]); ?>">Edit</a></td>
      </tr>
    <?php } ?>
      </tbody>
  </table>
  <?php } else { ?>
    > No results found for <?php echo escape($_POST['maintenance_loc']); ?>.
  <?php }
} ?>

<h2>Find data based on Region</h2>

<form method="post">
  <label for="maintenance_loc">Region </label>
  <input type="text" id="maintenance_loc" name="maintenance_loc">
  <input type="submit" name="submit" value="View Results">
</form>
<a href="maintenancesearch.php">Go Back</a>
<?php include "../../../../../templates/footer.php"; ?>