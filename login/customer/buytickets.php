<?php //record amount_spent to customer account
if (isset($_POST['purchase'])){
	require "../../config.php";
	require "../../common.php";
	
	session_start();
	$email = $_SESSION["email"];
	
	try{
		$connection = new PDO($dsn, $username, $password, $options);
		
		$children_ticket       = $_POST['children']*10;
		$adult_ticket          = $_POST['adult']*20;
		$senior_ticket         = $_POST['senior']*15;
		$total = $children_ticket+$adult_ticket+$senior_ticket;
		
		$sql = "UPDATE customers
		        SET amount_spent = amount_spent+'$total'
				WHERE email = :email";
				
		$statement = $connection->prepare($sql);
		$statement->bindValue(':email', $email);
		$statement->execute();
		
		
	}catch(PDOException $error) {
		echo "Error: ";
		print_r($statement->errorInfo());
	}
	//check in tickets
	try{		
		$pdo = new PDO($dsn, $username, $password, $options);
		
		$children_ticket_count      = $_POST['children'];
		$adult_ticket_count         = $_POST['adult'];
		$senior_ticket_count        = $_POST['senior'];
		
		$sqll = "INSERT INTO boxoffice (ticket_id_fk) 
                 VALUES ('1')";
		$sqlll = "INSERT INTO boxoffice (ticket_id_fk) 
                  VALUES ('2')";
		$sqllll = "INSERT INTO boxoffice (ticket_id_fk) 
                   VALUES ('3')";
	    //insert child tickets
		while ($children_ticket_count > 0){ 
					 
			$stmt = $pdo->prepare($sqll);
		    $stmt->execute();
			$children_ticket_count--;
		}
		//insert adult tickets
		while ($adult_ticket_count > 0){
					 
			$stmt = $pdo->prepare($sqlll);
		    $stmt->execute();
			$adult_ticket_count--;
		}
		//insert senior tickets
		while ($senior_ticket_count > 0){
					 
			$stmt = $pdo->prepare($sqllll);
		    $stmt->execute();
			$senior_ticket_count--;
		}
		
		print_r("Thank you! Your purchase has been successfully made. 
		Redirect to account profile in 3sec...");
		header("refresh:3; url=profile.php");
		
	}catch(PDOException $error){
		echo "Error: ";
		print_r($statement->errorInfo());
	}
}
?>


<?php include "../../templates/header.php"; ?>
<link rel="stylesheet" href="../../css/style.css" />
<h2>Buy Tickets</h2>
<?php
try {
		require "../../config.php";
		require "../../common.php";

		$connection = new PDO($dsn, $username, $password, $options);

		$sql = "SELECT ticket_name, ticket_price
				FROM tickets";

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
  <th>Ticket Type</th>
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
?>

<form action="buytickets.php" method="post">
    <label for="children">Children</label>
	<input type="text" name="children" id="children">
	<label for="adult">Adult</label>
	<input type="text" name="adult" id="adult">
	<label for="senior">Senior</label>
	<input type="text" name="senior" id="senior">
	<input type="submit" name="purchase" value="Purchase"/>
</form>


<a href="profile.php">Go Back</a>
<a href="customerlogout.php">Sign out</a>
<a href="../../main.php">Main Page</a>
<?php include "../../templates/footer.php"; ?>