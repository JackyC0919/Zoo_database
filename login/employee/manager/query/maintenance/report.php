<?php
if(isset($_POST['totalreport'])){
	try{
		require "../../../../../config.php";
		require "../../../../../common.php";

		$connection = new PDO($dsn, $username, $password, $options);
		
		$sqll = "SELECT DISTINCT
				CASE
					WHEN maintenance_type_fk = 1 THEN 'Electrical'
					WHEN maintenance_type_fk = 2 THEN 'Structural'
					WHEN maintenance_type_fk = 3 THEN 'Sanitary'
					ELSE 'Other'
				END AS 'Type',
				count(maintenance_type_fk) AS 'Total',
				concat(round(( (count(maintenance_type_fk))/((SELECT COUNT(*) FROM Maintenance)) * 100 ),2),'%') AS Percentage
				FROM Maintenance
				GROUP BY maintenance_type_fk";
				
		$statement = $connection->prepare($sqll);
		$statement->execute();
		
		$result = $statement->fetchAll();
	}catch(PDOException $error){
		echo $sql . "<br>" . $error->getMessage();
	}
}
?>

<?php include "../../../../../templates/header.php"; ?>
<link rel="stylesheet" href="../../../../../css/style.css" />
<h2>Report</h2>
<form action="report.php" method="post">
	<input type="submit" name="totalreport" value="Total Report"/>
</form>

<?php
if (isset($_POST['totalreport'])) {
  if ($result && $statement->rowCount() > 0) { ?>
    <h2>Total Report</h2>

    <table>
      <thead>
<tr>
  <th>Type</th>
  <th>Total</th>
  <th>Percentage</th>
</tr>
      </thead>
      <tbody>
  <?php foreach ($result as $row) { ?>
      <tr>
<td><?php echo escape($row[0]); ?></td>
<td><?php echo escape($row[1]); ?></td>
<td><?php echo escape($row[2]); ?></td>
      </tr>
    <?php } ?>
      </tbody>
  </table>
  <?php } else { ?>
    > No report found.
  <?php }
} ?>

<a href="../../maintenance.php">Go Back</a>
<a href="../../../../../main.php">Main Page</a>
<?php include "../../../../../templates/footer.php"; ?>