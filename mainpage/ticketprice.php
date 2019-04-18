<?php
if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['ticketprice'])){
	try {
		require "../config.php";
		require "../common.php";

		$connection = new PDO($dsn, $username, $password, $options);

		$sql = "SELECT ticket_name, ticket_price
				FROM tickets";

		$statement = $connection->prepare($sql);
		$statement->execute();

		$result = $statement->fetchAll();
	} catch(PDOException $error) {
		echo $sql . "<br>" . $error->getMessage();
	}
}		
?>

<?php include "../templates/header.php"; ?>

<form action="ticketprice.php" method="post">
	<input type="submit" name="ticketprice" value="Ticket Price"/>
</form>

<?php
if (isset($_POST['ticketprice'])) {
  if ($result && $statement->rowCount() > 0) { ?>
    <table>
      <thead>
<tr>
  <th>Ticket</th>
  <th>Price</th>
</tr>
      </thead>
      <tbody>
  <?php foreach ($result as $row) { ?>
      <tr>
<td><?php echo escape($row["ticket_name"]); ?></td>
<td><?php echo escape($row["ticket_price"]); ?></td>
      </tr>
    <?php } ?>
      </tbody>
  </table>
  <?php } else { ?>
    > No results found for <?php echo escape($_POST['ticketprice']); ?>.
  <?php }
} ?>

<a href="../main.php">Go Back</a>
<?php include "../templates/footer.php"; ?>