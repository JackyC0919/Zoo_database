<?php
if (isset($_POST['purchase'])){
	require "../../config.php";
	require "../../common.php";
	
	session_start();
	$email = $_SESSION["email"];
	
	try{
		$connection = new PDO($dsn, $username, $password, $options);
		
		$soft_drink     = $_POST['soft_drink']*5;
		$plushies       = $_POST['plushies']*15;
		$toy_animal     = $_POST['toy']*12;
		$t_shirt        = $_POST['tshirt']*15;
		$hats           = $_POST['hats']*17;
		$books          = $_POST['books']*10;
		$total = $soft_drink+$plushies+$toy_animal+$t_shirt+$hats+$books;
		
		$sql = "UPDATE customers
		        SET amount_spent = amount_spent+'$total'
				WHERE email = :email";
				
		$statement = $connection->prepare($sql);
		$statement->bindValue(':email', $email);
		$statement->execute();
		
		print_r("Thank you! Your purchase has been successfully made. 
		Redirect to account profile in 3sec...");
		header("refresh:3; url=profile.php");
		
	}catch(PDOException $error) {
		echo "Error: ";
		print_r($statement->errorInfo());
	}
}
?>

<?php include "../../templates/header.php"; ?>
<link rel="stylesheet" href="../../css/style.css" />
<h2>SHOP</h2>
<?php
try {
		require "../../config.php";
		require "../../common.php";

		$connection = new PDO($dsn, $username, $password, $options);

		$sql = "SELECT product_name, price
				FROM product";

		$statement = $connection->prepare($sql);
		$statement->execute();

		$result = $statement->fetchAll();
	} catch(PDOException $error) {
		echo $sql . "<br>" . $error->getMessage();
	}
	if ($result && $statement->rowCount() > 0) { ?>
    <table>
      <thead>
<tr>
  <th>Product</th>
  <th>Price</th>
</tr>
      </thead>
      <tbody>
  <?php foreach ($result as $row) { ?>
      <tr>
<td><?php echo escape($row["product_name"]); ?></td>
<td><?php echo escape($row["price"]); ?></td>
      </tr>
    <?php } ?>
      </tbody>
  </table>
  <?php } else { ?>
    > No results found for <?php echo escape($_POST['customer_id']); ?>.
  <?php }
?>

<form action="shopping.php" method="post">
    <label for="softdrink">Soft Drink</label>
	<input type="text" name="softdrink" id="softdrink">
	<label for="plushies">Plushies</label>
	<input type="text" name="plushies" id="plushies">
	<label for="toy">Toy Animal</label>
	<input type="text" name="toy" id="toy">
	<label for="tshirt">T-shirt</label>
	<input type="text" name="tshirt" id="tshirt">
	<label for="hats">Hats</label>
	<input type="text" name="hats" id="hats">
	<label for="books">Books</label>
	<input type="text" name="books" id="books">
	<input type="submit" name="purchase" value="Purchase"/>
</form>

<a href="profile.php">Go Back</a>
<a href="customerlogout.php">Sign out</a>
<a href="../../main.php">Main Page</a>
<?php include "../../templates/footer.php"; ?>