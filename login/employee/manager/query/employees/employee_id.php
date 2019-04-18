<?php
if (isset($_POST['submit'])) {
  try {
    require "../../../../../config.php";
    require "../../../../../common.php";

    $connection = new PDO($dsn, $username, $password, $options);

    $sql = "SELECT *
    FROM employees
    WHERE employee_id = :employee_id";

    $employee_id = $_POST['employee_id'];

    $statement = $connection->prepare($sql);
	$statement->bindParam(':employee_id', $employee_id, PDO::PARAM_STR);
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
  <th>Employee ID</th>
  <th>Region</th>
  <th>First Name</th>
  <th>Middle Name</th>
  <th>Last Name</th>
  <th>Job ID</th>
  <th>Gender</th>
  <th>Date of Birth</th>
  <th>Hourly Wage</th>
  <th>Total Hours</th>
  <th>Hire Date</th>
  <th>Sick Days</th>
  <th>Email</th>
  <th>Edit</th>
  <th>Delete</th>
</tr>
      </thead>
      <tbody>
  <?php foreach ($result as $row) { ?>
      <tr>
<td><?php echo escape($row["employee_id"]); ?></td>
<td><?php echo escape($row["enclosure_type_fk"]); ?></td>
<td><?php echo escape($row["first_name"]); ?></td>
<td><?php echo escape($row["middle_name"]); ?></td>
<td><?php echo escape($row["last_name"]); ?></td>
<td><?php echo escape($row["job_id_fk"]); ?></td>
<td><?php echo escape($row["gender_id_fk"]); ?></td>
<td><?php echo escape($row["dob"]); ?></td>
<td><?php echo escape($row["hourly_wage"]); ?></td>
<td><?php echo escape($row["total_hours"]); ?></td>
<td><?php echo escape($row["hire_date"]); ?></td>
<td><?php echo escape($row["sick_days"]); ?></td>
<td><?php echo escape($row["email"]); ?></td>
<td><a href="employeeupdate.php?id=<?php echo escape($row["employee_id"]); ?>">Edit</a></td>
<td><a href="employeedelete.php?id=<?php echo escape($row["employee_id"]); ?>">Delete</a></td>
      </tr>
    <?php } ?>
      </tbody>
  </table>
  <?php } else { ?>
    > No results found for <?php echo escape($_POST['employee_id']); ?>.
  <?php }
} ?>

<h2>Find data based on Employee ID</h2>

<form method="post">
  <label for="employee_id">Employee ID </label>
  <input type="text" id="employee_id" name="employee_id">
  <input type="submit" name="submit" value="View Results">
</form>
<a href="employees.php">Go Back</a>
<?php include "../../../../../templates/footer.php"; ?>