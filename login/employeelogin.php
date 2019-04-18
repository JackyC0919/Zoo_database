<?php
// Initialize the session
session_start();
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
	switch ($_SESSION["job_id_fk_fk"]){
		case 1:
			header("location: employee/managerlogin.php");
			break;
		case 2:
			header("location: employee/repairmanlogin.php");
			break;
		case 3:
			header("location: employee/trainerlogin.php");
			break;
		case 4:
			header("location: employee/gemployeelogin.php");
			break;
		default:
			break;
	}
    exit;
}

// Include config file
require "../config.php";

$connection = new PDO($dsn, $username, $password, $options);
 
// Define variables
$employee_id_fk = $password = "";
$employee_id_fk_err = $password_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
	// Check if employee_id_fk is empty
    if(empty(trim($_POST["employee_id_fk"]))){
        $employee_id_fk_err = "Please enter username.";
    } else{
        $employee_id_fk = trim($_POST["employee_id_fk"]);
    }
	 // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
	
	// Validate credentials
    if(empty($employee_id_fk_err) && empty($password_err)){
		// Prepare a select statement
		$sql = "SELECT employee_id_fk, password, job_id_fk_fk FROM esecurity WHERE employee_id_fk = :employee_id_fk";
		
		if($stmt = $connection->prepare($sql)){
			// Bind variables to the prepared statement as parameters
            $stmt->bindParam(":employee_id_fk", $param_username, PDO::PARAM_STR);
			// Set parameters
            $param_username = trim($_POST["employee_id_fk"]);
			
			if($stmt->execute()){
				// Check if username exists, if yes then verify password
				 if($stmt->rowCount() == 1){
					 if($row = $stmt->fetch()){
						$employee_id_fk = $row["employee_id_fk"];
                        $hashed_password = $row["password"];
						$job_id_fk_fk = $row["job_id_fk_fk"];
						if(password_verify($password, $hashed_password)){
							session_start();    
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["customer_id_fk"] = $customer_id_fk;
							$_SESSION["job_id_fk_fk"] = $job_id_fk_fk;
							
							switch ($job_id_fk_fk){
								case 1:
									header("location: employee/managerlogin.php");
									break;
								case 2:
									header("location: employee/repairmanlogin.php");
									break;
								case 3:
									header("location: employee/trainerlogin.php");
									break;
								case 4:
									header("location: employee/gemployeelogin.php");
									break;
								default:
									break;								
							}
						}else{
							// Display an error message if password is not valid
                            $password_err = "The password you entered was not valid.";
						}
					 }
				 }else{
					// Display an error message if username doesn't exist
                    $employee_id_fk = "No account found with that username.";
					echo "No account found with that username.";
				}
			}else{
				echo "Error. Please try again later.";
			}
		}
	}
}

?>

<?php include "../templates/header.php"; ?>
<h2>Login</h2>
<form action="employeelogin.php" method="post">
			<label for="employee_id_fk">Employee ID</label>
			<input type="text" name="employee_id_fk" id="employee_id_fk">
			<div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
            <p>Don't have an account? <a href="employeeregister.php">Sign up now</a>.</p>
</form>

<a href="../main.php">Go Back</a>
<?php include "../templates/footer.php"; ?>