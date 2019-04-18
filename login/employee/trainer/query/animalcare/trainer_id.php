<?php
if (isset($_POST['submit'])) {
  try {
    require "../../../../../config.php";
    require "../../../../../common.php";

    $connection = new PDO($dsn, $username, $password, $options);

    $sql = "SELECT *
    FROM animalcare
    WHERE animal_trainer_id = :animal_trainer_id";

    $animal_trainer_id = $_POST['animal_trainer_id'];

    $statement = $connection->prepare($sql);
	$statement->bindParam(':animal_trainer_id', $animal_trainer_id, PDO::PARAM_STR);
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
  <th>Dietary Requirement</th>
  <th>Animal ID</th>
  <th>Last Fed</th>
  <th>Vaccination Date</th>
  <th>Trainer ID</th>
  <th>Edit</th>
</tr>
      </thead>
      <tbody>
  <?php foreach ($result as $row) { ?>
      <tr>
<td><?php echo escape($row["dietary_requirement"]); ?></td>
<td><?php echo escape($row["animal_id_fk"]); ?></td>
<td><?php echo escape($row["last_fed"]); ?></td>
<td><?php echo escape($row["vaccination_date"]); ?></td>
<td><?php echo escape($row["animal_trainer_id"]); ?></td>
<td><a href="animalcareupdate.php?id=<?php echo escape($row["animal_id_fk"]); ?>">Edit</a></td>
      </tr>
    <?php } ?>
      </tbody>
  </table>
  <?php } else { ?>
    > No results found for <?php echo escape($_POST['animal_trainer_id']); ?>.
  <?php }
} ?>

<h2>Find data based on Trainer ID</h2>

<form method="post">
  <label for="animal_trainer_id">Trainer ID </label>
  <input type="text" id="animal_trainer_id" name="animal_trainer_id">
  <input type="submit" name="submit" value="View Results">
</form>
<a href="animalcaresearch.php">Go Back</a>
<?php include "../../../../../templates/footer.php"; ?>