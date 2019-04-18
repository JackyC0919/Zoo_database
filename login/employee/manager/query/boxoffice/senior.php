<?php include "../../../../../templates/header.php"; ?>
<link rel="stylesheet" href="../../../../../css/style.css" />
<h2>Senior Ticket</h2>

<?php
try {
    require "../../../../../config.php";
    require "../../../../../common.php";

    $connection = new PDO($dsn, $username, $password, $options);

    $sql = "SELECT *
    FROM boxoffice
    WHERE ticket_id_fk = '3'";


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
  <th>Ticket ID</th>
  <th>Purchase Date</th>
</tr>
      </thead>
      <tbody>
  <?php foreach ($result as $row) { ?>
      <tr>
<td><?php echo escape($row["ticket_id_fk"]); ?></td>
<td><?php echo escape($row["purchase_date"]); ?></td>
      </tr>
    <?php } ?>
      </tbody>
  </table>
  <?php } else { ?>
    > No results found for <?php echo escape($_POST['customer_id_fk']); ?>.
  <?php } 
?>

<a href="boxofficesearch.php">Go Back</a>
<?php include "../../../../../templates/footer.php"; ?>