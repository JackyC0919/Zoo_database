<?php
// Include config file
require "../config.php";

// connect to db
$connection = new PDO($dsn, $username, $password, $options);

//Define variables
$first_name = $middle_name = $last_name = $gender_id_fk = $amount_spent = "";
$password = $confirm_password = "";
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
		$first_name     = $_POST['first_name'];
		$middle_name    = $_POST['middle_name'];
		$last_name      = $_POST['last_name'];
		$gender_id_fk   = $_POST['gender_id_fk'];
		$email          = $_POST['email'];
	
		$sql = "INSERT INTO customers (first_name, middle_name, last_name, gender_id_fk, membership, email)
				VALUES ('$first_name', '$middle_name', '$last_name', '$gender_id_fk', False, '$email')";
				
		$statement = $connection->prepare($sql);
		$statement->execute();
		
		if(empty($password_err) && empty($confirm_password_err)){
			
			$sqll = "INSERT INTO csecurity (email, password) VALUES (:email, :password)";
			if($stmt = $connection->prepare($sqll)){
				$stmt->bindParam(":email", $email, PDO::PARAM_STR);
				$stmt->bindParam(":password", $param_password, PDO::PARAM_STR);
				$param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
				
				// Attempt to execute the prepared statement
            if($stmt->execute()){
                // Redirect to login page
                header("location: customerlogin.php");
            } else{
                echo "error";
				print_r($stmt->errorInfo());
            }
			}
		}
	}catch(PDOException $error){
		echo "Error: ";
		print_r($statement->errorInfo());
	}
}

?>

<?php include "../templates/header.php"; ?>
<h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form action="customerregister.php" method="post">
			<label for="first_name">First Name</label>
			<input type="text" name="first_name" id="first_name">
			<label for="middle_name">Middle Name</label>
			<input type="text" name="middle_name" id="middle_name">
			<label for="last_name">Last Name</label>
			<input type="text" name="last_name" id="last_name">
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
			<label for="gender_id_fk">Gender (M/F)</label>
			<input type="text" name="gender_id_fk" id="gender_id_fk">
			<label for="email">Email address</label>
			<input type="text" name="email" id="email">
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
            </div>
            <p>Already have an account? <a href="customerlogin.php">Login here</a>.</p>
        </form>
<?php include "../templates/footer.php"; ?>