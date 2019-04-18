<?php
if (isset($_POST['submit'])) {
  try {
    require "../../../../../config.php";
    require "../../../../../common.php";
   

    $connection = new PDO($dsn, $username, $password, $options);

    $sql =  "SELECT ticket_name,SUM(ticket_price)  
			FROM Tickets, Boxoffice     
			WHERE ticket_id = ticket_id
			GROUP BY ticket_id "; 



    $statement = $connection->prepare($sql);
	$statement->bindParam(':ticket_id', $ticket_id, PDO::PARAM_STR);
	$statement->execute();

    $result = $statement->fetchAll();
  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }
}
?>


<h2>Total Sales by Ticket Category </h2>

<form method="post">
  
 
  <input type="submit" name="submit" value="View Reportts">
</form>    
  


<?php include "../../../../../templates/header.php"; ?>
<?php
if (isset($_POST['submit'])) {
  if ($result && $statement->rowCount() > 0) { ?>
    <h2>Results</h2>
<?php foreach ($result as $row) { ?>  

    <table>
      <thead>
<tr>
  <th>Ticket Type</th>
  <th>Total Revenue</th>
  
</tr>
      </thead>
      <tbody>
 <tr>
    <td><?php echo escape(($row['ticket_name'])); ?></td>
	<td><?php echo escape("$    ". $row['SUM(ticket_price)']); ?></td> 
</tr>	  
	 


    <?php } ?>
      </tbody>
  </table>
  <?php } else { ?>
    > No results found.
  <?php }
 }?>


<a href="../../reports.php">Go Back</a>
<?php include "../../../../../templates/footer.php"; ?>