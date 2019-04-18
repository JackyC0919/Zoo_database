<?php
if(isset($_POST['reptiles'])){
	try {
		require "../config.php";
		require "../common.php";

		$connection = new PDO($dsn, $username, $password, $options);

		$sql = "SELECT enclosure_type_fk, animal_name, animal_order, animal_genus, animal_family, animal_dob, animal_weight
				FROM animals
				WHERE enclosure_type_fk = 'reptiles'";

		$statement = $connection->prepare($sql);
		$statement->execute();

		$result = $statement->fetchAll();
	} catch(PDOException $error) {
		echo $sql . "<br>" . $error->getMessage();
	}
}
if(isset($_POST['birds'])){
	try {
		require "../config.php";
		require "../common.php";

		$connection = new PDO($dsn, $username, $password, $options);

		$sql = "SELECT enclosure_type_fk, animal_name, animal_order, animal_genus, animal_family, animal_dob, animal_weight
				FROM animals
				WHERE enclosure_type_fk = 'birds'";

		$statement = $connection->prepare($sql);
		$statement->execute();

		$result = $statement->fetchAll();
	} catch(PDOException $error) {
		echo $sql . "<br>" . $error->getMessage();
	}
}
if(isset($_POST['primates'])){
	try {
		require "../config.php";
		require "../common.php";

		$connection = new PDO($dsn, $username, $password, $options);

		$sql = "SELECT enclosure_type_fk, animal_name, animal_order, animal_genus, animal_family, animal_dob, animal_weight
				FROM animals
				WHERE enclosure_type_fk = 'primates'";

		$statement = $connection->prepare($sql);
		$statement->execute();

		$result = $statement->fetchAll();
	} catch(PDOException $error) {
		echo $sql . "<br>" . $error->getMessage();
	}
}
if(isset($_POST['insects'])){
	try {
		require "../config.php";
		require "../common.php";

		$connection = new PDO($dsn, $username, $password, $options);

		$sql = "SELECT enclosure_type_fk, animal_name, animal_order, animal_genus, animal_family, animal_dob, animal_weight
				FROM animals
				WHERE enclosure_type_fk = 'insects'";

		$statement = $connection->prepare($sql);
		$statement->execute();

		$result = $statement->fetchAll();
	} catch(PDOException $error) {
		echo $sql . "<br>" . $error->getMessage();
	}
}
if(isset($_POST['mammals'])){
	try {
		require "../config.php";
		require "../common.php";

		$connection = new PDO($dsn, $username, $password, $options);

		$sql = "SELECT enclosure_type_fk, animal_name, animal_order, animal_genus, animal_family, animal_dob, animal_weight
				FROM animals
				WHERE enclosure_type_fk = 'mammals'";

		$statement = $connection->prepare($sql);
		$statement->execute();

		$result = $statement->fetchAll();
	} catch(PDOException $error) {
		echo $sql . "<br>" . $error->getMessage();
	}
}
if(isset($_POST['african'])){
	try {
		require "../config.php";
		require "../common.php";

		$connection = new PDO($dsn, $username, $password, $options);

		$sql = "SELECT enclosure_type_fk, animal_name, animal_order, animal_genus, animal_family, animal_dob, animal_weight
				FROM animals
				WHERE enclosure_type_fk = 'african'";

		$statement = $connection->prepare($sql);
		$statement->execute();

		$result = $statement->fetchAll();
	} catch(PDOException $error) {
		echo $sql . "<br>" . $error->getMessage();
	}
}
?>

<?php include "../templates/header.php"; ?>
<h2>Animal Region</h2>
<form action="region.php" method="post">
	<input type="submit" name="reptiles" value="Reptiles"/>
	<input type="submit" name="birds" value="Birds"/>
	<input type="submit" name="primates" value="Primates"/>
	<input type="submit" name="insects" value="Insects"/>
	<input type="submit" name="mammals" value="Mammals"/>
	<input type="submit" name="african" value="African"/>
</form>

<?php
if (isset($_POST['reptiles'])) {
  if ($result && $statement->rowCount() > 0) { ?>
<h2>Reptiles</h2>
    <table>
      <thead>
<tr>
  <th>Name</th>
  <th>Order</th>
  <th>Genus</th>
  <th>Family</th>
  <th>Date of Birth</th>
  <th>Weight</th>
</tr>
      </thead>
      <tbody>
  <?php foreach ($result as $row) { ?>
      <tr>
<td><?php echo escape($row["animal_name"]); ?></td>
<td><?php echo escape($row["animal_order"]); ?></td>
<td><?php echo escape($row["animal_genus"]); ?></td>
<td><?php echo escape($row["animal_family"]); ?></td>
<td><?php echo escape($row["animal_dob"]); ?></td>
<td><?php echo escape($row["animal_weight"]); ?></td>
      </tr>
    <?php } ?>
      </tbody>
  </table>
  <?php } else { ?>
    > No results found for <?php echo escape($_POST['customer_id']); ?>.
  <?php }
} 
if (isset($_POST['african'])) {
  if ($result && $statement->rowCount() > 0) { ?>
<h2>African</h2>
    <table>
      <thead>
<tr>
  <th>Name</th>
  <th>Order</th>
  <th>Genus</th>
  <th>Family</th>
  <th>Date of Birth</th>
  <th>Weight</th>
</tr>
      </thead>
      <tbody>
  <?php foreach ($result as $row) { ?>
      <tr>
<td><?php echo escape($row["animal_name"]); ?></td>
<td><?php echo escape($row["animal_order"]); ?></td>
<td><?php echo escape($row["animal_genus"]); ?></td>
<td><?php echo escape($row["animal_family"]); ?></td>
<td><?php echo escape($row["animal_dob"]); ?></td>
<td><?php echo escape($row["animal_weight"]); ?></td>
      </tr>
    <?php } ?>
      </tbody>
  </table>
  <?php } else { ?>
    > No results found for <?php echo escape($_POST['customer_id']); ?>.
  <?php }
} 
if (isset($_POST['birds'])) {
  if ($result && $statement->rowCount() > 0) { ?>
<h2>Birds</h2>
    <table>
      <thead>
<tr>
  <th>Name</th>
  <th>Order</th>
  <th>Genus</th>
  <th>Family</th>
  <th>Date of Birth</th>
  <th>Weight</th>
</tr>
      </thead>
      <tbody>
  <?php foreach ($result as $row) { ?>
      <tr>
<td><?php echo escape($row["animal_name"]); ?></td>
<td><?php echo escape($row["animal_order"]); ?></td>
<td><?php echo escape($row["animal_genus"]); ?></td>
<td><?php echo escape($row["animal_family"]); ?></td>
<td><?php echo escape($row["animal_dob"]); ?></td>
<td><?php echo escape($row["animal_weight"]); ?></td>
      </tr>
    <?php } ?>
      </tbody>
  </table>
  <?php } else { ?>
    > No results found for <?php echo escape($_POST['customer_id']); ?>.
  <?php }
} 
if (isset($_POST['primates'])) {
  if ($result && $statement->rowCount() > 0) { ?>
  <h2>Primates</h2>
    <table>
      <thead>
<tr>
  <th>Name</th>
  <th>Order</th>
  <th>Genus</th>
  <th>Family</th>
  <th>Date of Birth</th>
  <th>Weight</th>
</tr>
      </thead>
      <tbody>
  <?php foreach ($result as $row) { ?>
      <tr>
<td><?php echo escape($row["animal_name"]); ?></td>
<td><?php echo escape($row["animal_order"]); ?></td>
<td><?php echo escape($row["animal_genus"]); ?></td>
<td><?php echo escape($row["animal_family"]); ?></td>
<td><?php echo escape($row["animal_dob"]); ?></td>
<td><?php echo escape($row["animal_weight"]); ?></td>
      </tr>
    <?php } ?>
      </tbody>
  </table>
  <?php } else { ?>
    > No results found for <?php echo escape($_POST['customer_id']); ?>.
  <?php }
} 
if (isset($_POST['insects'])) {
  if ($result && $statement->rowCount() > 0) { ?>
<h2>Insects</h2>
    <table>
      <thead>
<tr>
  <th>Name</th>
  <th>Order</th>
  <th>Genus</th>
  <th>Family</th>
  <th>Date of Birth</th>
  <th>Weight</th>
</tr>
      </thead>
      <tbody>
  <?php foreach ($result as $row) { ?>
      <tr>
<td><?php echo escape($row["animal_name"]); ?></td>
<td><?php echo escape($row["animal_order"]); ?></td>
<td><?php echo escape($row["animal_genus"]); ?></td>
<td><?php echo escape($row["animal_family"]); ?></td>
<td><?php echo escape($row["animal_dob"]); ?></td>
<td><?php echo escape($row["animal_weight"]); ?></td>
      </tr>
    <?php } ?>
      </tbody>
  </table>
  <?php } else { ?>
    > No results found for <?php echo escape($_POST['customer_id']); ?>.
  <?php }
} 
if (isset($_POST['mammals'])) {
  if ($result && $statement->rowCount() > 0) { ?>
<h2>Mammals</h2>
    <table>
      <thead>
<tr>
  <th>Name</th>
  <th>Order</th>
  <th>Genus</th>
  <th>Family</th>
  <th>Date of Birth</th>
  <th>Weight</th>
</tr>
      </thead>
      <tbody>
  <?php foreach ($result as $row) { ?>
      <tr>
<td><?php echo escape($row["animal_name"]); ?></td>
<td><?php echo escape($row["animal_order"]); ?></td>
<td><?php echo escape($row["animal_genus"]); ?></td>
<td><?php echo escape($row["animal_family"]); ?></td>
<td><?php echo escape($row["animal_dob"]); ?></td>
<td><?php echo escape($row["animal_weight"]); ?></td>
      </tr>
    <?php } ?>
      </tbody>
  </table>
  <?php } else { ?>
    > No results found for <?php echo escape($_POST['customer_id']); ?>.
  <?php }
} 
?>

<a href="animal.php">Go Back</a>
<?php include "../templates/footer.php"; ?>