<?php
if (isset($_POST['submit'])) {
  try {
    require "../../../../../config.php";
    require "../../../../../common.php";

    $connection = new PDO($dsn, $username, $password, $options);

    $sql = "SELECT *
    FROM maintenance
    WHERE repairman_id_fk = :repairman_id_fk";

    $repairman_id_fk = $_POST['repairman_id_fk'];

    $statement = $connection->prepare($sql);
	$statement->bindParam(':repairman_id_fk', $repairman_id_fk, PDO::PARAM_STR);
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
    > No results found for <?php echo escape($_POST['repairman_id_fk']); ?>.
  <?php }
} ?>

<h2>Find data based on Employee ID</h2>

<form method="post">
  <label for="repairman_id_fk">Repairman ID </label>
  <input type="text" id="repairman_id_fk" name="repairman_id_fk">
  <input type="submit" name="submit" value="View Results">
</form>
<a href="maintenancesearch.php">Go Back</a>
<?php include "../../../../../templates/footer.php"; ?>