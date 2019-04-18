<?php
if (isset($_POST['submit'])){
	require "../../../../config.php";
	require "../../../../common.php";
	
	try{
		$connection = new PDO($dsn, $username, $password, $options);
		
		$enclosure_type_fk   = $_POST['enclosure_type_fk'];
		$first_name          = $_POST['first_name'];
		$middle_name         = $_POST['middle_name'];
		$last_name           = $_POST['last_name'];
		$job_id_fk           = $_POST['job_id_fk'];
		$gender_id_fk        = $_POST['gender_id_fk'];
		$dob                 = $_POST['dob'];
		$hourly_wage         = $_POST['hourly_wage'];
		$total_hours         = $_POST['total_hours'];
		$hire_date           = $_POST['hire_date'];
		$sick_days           = $_POST['sick_days'];
		$email               = $_POST['email'];
		
		if ($job_id_fk == 1 && $hourly_wage < 30){
			print_r("Hourly Wage: too low! automatically setting it to minimum payment.");
		}else if($job_id_fk == 2 && $hourly_wage >= 25){
			print_r("Hourly Wage: too high! automatically setting it to maximum payment.");
		}else if($job_id_fk == 3 && $hourly_wage >= 20){
			print_r("Hourly Wage: too high! automatically setting it to maximum payment.");
		}else if($job_id_fk == 4 && $hourly_wage >= 15){
			print_r("Hourly Wage: too high! automatically setting it to maximum payment.");
		}
		
		$sql = "INSERT INTO employees (enclosure_type_fk, first_name, middle_name, last_name, job_id_fk, gender_id_fk, dob, hourly_wage, total_hours, hire_date, sick_days, email) 
               VALUES ('$enclosure_type_fk', '$first_name', '$middle_name', '$last_name', '$job_id_fk', '$gender_id_fk', '$dob', '$hourly_wage', '$total_hours', '$hire_date', '$sick_days', '$email')";
		
		$statement = $connection->prepare($sql);
		$statement->execute();
		print_r("Data successfully added.");
		
	} catch(PDOException $error) {
		echo "Error: ";
		print_r($statement->errorInfo());
	}
}
?>

<?php include "../../../../templates/header.php"; ?>
<link rel="stylesheet" href="../../../../css/style.css" />
<strong>New Employee</strong>
<form method="post">
        <label for="enclosure_type_fk">Region</label>
    	<input type="text" name="enclosure_type_fk" id="enclosure_type_fk">
    	<label for="first_name">First Name</label>
    	<input type="text" name="first_name" id="first_name">
		<label for="middle_name">Middle Name</label>
    	<input type="text" name="middle_name" id="middle_name">
		<label for="last_name">Last Name</label>
    	<input type="text" name="last_name" id="last_name">
		<label for="job_id_fk">Job ID</label>
    	<input type="text" name="job_id_fk" id="job_id_fk">
		<label for="gender_id_fk">Gender</label>
    	<input type="text" name="gender_id_fk" id="gender_id_fk">
		<label for="dob">Date of Birth (YYYY-MM-DD)</label>
    	<input type="text" name="dob" id="dob">
		<label for="hourly_wage">Hourly Wage</label>
    	<input type="text" name="hourly_wage" id="hourly_wage">
		<label for="total_hours">Total Hours</label>
    	<input type="text" name="total_hours" id="total_hours">
		<label for="hire_date">Hire Date (YYYY-MM-DD)</label>
    	<input type="text" name="hire_date" id="hire_date">
		<label for="sick_days">Sick Days</label>
    	<input type="text" name="sick_days" id="sick_days">
		<label for="email">Email Address</label>
    	<input type="text" name="email" id="email">
    	<input type="submit" name="submit" value="Submit">
    </form>

<a href="../employeeprofile.php">Go Back</a>
<?php include "../../../../templates/footer.php"; ?>