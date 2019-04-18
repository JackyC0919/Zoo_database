<?php
// Include config file
require "../config.php";

// connect to db
$connection = new PDO($dsn, $username, $password, $options);

//Define variables
$employee_id_fk = $password = $confirm_password = "";
$password_err = $confirm_password_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
	// Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
	
	try{
		$employee_id_fk   =  $_POST['employee_id_fk'];
		
		$get_job_id = "SELECT job_id_fk FROM employees WHERE employee_id = :employee_id";
		$statement = $connection->prepare($get_job_id);
		$statement->bindParam(':employee_id', $employee_id_fk, PDO::PARAM_STR);
		$statement->execute();
		$result = $statement->fetchAll();
		foreach ($result as $row){
			$jid = $row["job_id_fk"];
		}
		
		if(empty($password_err) && empty($confirm_password_err)){
			$sql = "INSERT INTO esecurity (employee_id_fk, password, job_id_fk_fk)
					VALUES (:employee_id_fk, :password, :job_id_fk_fk)";
			if ($stmt = $connection->prepare($sql)){
				$stmt->bindParam(":employee_id_fk", $employee_id_fk, PDO::PARAM_STR);
				$stmt->bindParam(":password", $param_password, PDO::PARAM_STR);
				$stmt->bindParam(":job_id_fk_fk", $jid, PDO::PARAM_STR);
				$param_password = password_hash($password, PASSWORD_DEFAULT);
				
				if($stmt->execute()){
					//Redirec to login
					header("location: employeelogin.php");
				}else{
					echo "error";
					print_r($stmt->errorInfo());
				}
			}
		}
		
		
	}catch(PDOException $error){
		echo "error: ";
		print_r($statement->errorInfo());
	}
}

?>

<?php include "../templates/header.php"; ?>
<h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form action="employeeregister.php" method="post">
			<label for="employee_id_fk">Employee ID</label>
			<input type="text" name="employee_id_fk" id="employee_id_fk">
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
            </div>
            <p>Already have an account? <a href="employeelogin.php">Login here</a>.</p>
        </form>
<a href="../main.php">Go Back</a>
<?php include "../templates/footer.php"; ?>