<?php
if(isset($_POST['customerprofile'])){
	try {
		require "../../config.php";
		require "../../common.php";

		$connection = new PDO($dsn, $username, $password, $options);

		$sql = "SELECT *
				FROM customers
				WHERE email = :email";
		session_start();
		$email = $_SESSION["email"];

		$statement = $connection->prepare($sql);
		$statement->bindParam(':email', $email, PDO::PARAM_STR);
		$statement->execute();

		$result = $statement->fetchAll();
	} catch(PDOException $error) {
		echo $sql . "<br>" . $error->getMessage();
	}
}
if(isset($_POST['buytickets'])){
	header("Location: buytickets.php");
}
if(isset($_POST['shopping'])){
	header("Location: shopping.php");
}
?>

<?php include "../../templates/header.php"; ?>
<link rel="stylesheet" href="../../css/style.css" />
<h2>Profile</h2>
<form action="profile.php" method="post">
	<input type="submit" name="customerprofile" value="Account Profile"/>
	<input type="submit" name="buytickets" value="Buy Tickets"/>
	<input type="submit" name="shopping" value="Shop"/>
</form>
<?php
if (isset($_POST['customerprofile'])) {
  if ($result && $statement->rowCount() > 0) { ?>
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
<td><a href="customerupdate.php">Edit</a></td>
      </tr>
    <?php } ?>
      </tbody>
  </table>
  <?php } else { ?>
    > No results found for <?php echo escape($_POST['customer_id']); ?>.
  <?php }
} 
?>

<a href="customerlogout.php">Sign out</a>
<a href="../../main.php">Main Page</a>
<?php include "../../templates/footer.php"; ?>