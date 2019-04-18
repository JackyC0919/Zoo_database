<?php
if (isset($_POST['submit'])) {
  try {
    require "../../../../config.php";
    require "../../../../common.php";
   

    $connection = new PDO($dsn, $username, $password, $options);

	$start = $_POST['start'];
	$end = $_POST['end'];
	
    // here we are using LIKE with wildcard search
    // use it ONLY if really need it

    $sql =  "SELECT DATE(purchase_date), SUM(ticket_price)  
			FROM Tickets, Boxoffice     
			WHERE ticket_id = ticket_id AND DATE(purchase_date)BETWEEN DATE(:start) AND DATE(:end)
			GROUP BY DATE(purchase_date) "; 
    $statement = $connection->prepare($sql);
    $statement->bindParam(':start', $start, PDO::PARAM_STR);
    $statement->bindParam(':end', $end, PDO::PARAM_STR);
	$statement->execute();
	
	$result = $statement->fetchAll();
  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }
}
?>





<?php include "../../../../templates/header.php"; ?>

<h2> Total Sales Report </h2>

<form method="post">
  <label for="start">Report Start Date</label>
  <input type="text" id="start" name="start">  
  <label for="end">Report End Date</label>
  <input type="text" id="end" name="end">    
  <input type="submit" name="submit" value="View Reports">
</form>    

<?php
if (isset($_POST['submit'])) {
  if ($result && $statement->rowCount() > 0) { ?>
    <h2>Total Report</h2>

    <table>
      <thead>
<tr>
  <th>Date</th>
  <th>Revenue</th>
</tr>
      </thead>
      <tbody>
  <?php foreach ($result as $row) { ?>
      <tr>
<td><?php echo escape($row[0]); ?></td>
<td><?php echo escape($row[1]); ?></td>
      </tr>
    <?php } ?>
      </tbody>
  </table>
  <?php } else { ?>
    > No report found.
  <?php }
} ?>


<a href="../reports.php">Go Back</a>
<?php include "../../../../templates/footer.php"; ?>