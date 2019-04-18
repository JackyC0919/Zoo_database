<?php
if (isset($_POST['submit'])) {
  try {
    require "../../../../../config.php";
    require "../../../../../common.php";

    $connection = new PDO($dsn, $username, $password, $options);

    $sql = "SELECT *
    FROM animals
    WHERE animal_id = :animal_id";

    $animal_id = $_POST['animal_id'];

    $statement = $connection->prepare($sql);
	$statement->bindParam(':animal_id', $animal_id, PDO::PARAM_STR);
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
  <th>Animal ID</th>
  <th>Region</th>
  <th>Animal Name</th>
  <th>Order</th>
  <th>Genus</th>
  <th>Family</th>
  <th>Date of Birth</th>
  <th>Gender</th>
  <th>Weight</th>
  <th>Edit</th>
  <th>Delete</th>
</tr>
      </thead>
      <tbody>
  <?php foreach ($result as $row) { ?>
      <tr>
<td><?php echo escape($row["animal_id"]); ?></td>
<td><?php echo escape($row["enclosure_type_fk"]); ?></td>
<td><?php echo escape($row["animal_name"]); ?></td>
<td><?php echo escape($row["animal_order"]); ?></td>
<td><?php echo escape($row["animal_genus"]); ?></td>
<td><?php echo escape($row["animal_family"]); ?></td>
<td><?php echo escape($row["animal_dob"]); ?></td>
<td><?php echo escape($row["animal_gender_id_fk"]); ?></td>
<td><?php echo escape($row["animal_weight"]); ?></td>
<td><a href="animalupdate.php?id=<?php echo escape($row["animal_id"]); ?>">Edit</a></td>
<td><a href="animaldelete.php?id=<?php echo escape($row["animal_id"]); ?>">Delete</a></td>
      </tr>
    <?php } ?>
      </tbody>
  </table>
  <?php } else { ?>
    > No results found for <?php echo escape($_POST['animal_id']); ?>.
  <?php }
} ?>

<h2>Find Animal based on Animal ID</h2>

<form method="post">
  <label for="animal_id">Animal ID </label>
  <input type="text" id="animal_id" name="animal_id">
  <input type="submit" name="submit" value="View Results">
</form>
<a href="animalsearch.php">Go Back</a>
<?php include "../../../../../templates/footer.php"; ?>