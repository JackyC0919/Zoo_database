<?php
// Initialize the session
session_start();
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: customer/profile.php");
    exit;
}
// Include config file
require "../config.php";

$connection = new PDO($dsn, $username, $password, $options);
 
// Define variables and initialize with empty values
$email = $password = "";
$email_err = $password_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
	// Check if email is empty
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter username.";
    } else{
        $email = trim($_POST["email"]);
    }
	 // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
	
	// Validate credentials
    if(empty($email_err) && empty($password_err)){
		// Prepare a select statement
        $sql = "SELECT email, password FROM csecurity WHERE email = :email";
		
		if($stmt = $connection->prepare($sql)){
			// Bind variables to the prepared statement as parameters
            $stmt->bindParam(":email", $param_username, PDO::PARAM_STR);
			// Set parameters
            $param_username = trim($_POST["email"]);
			
			if($stmt->execute()){
				// Check if username exists, if yes then verify password
                if($stmt->rowCount() == 1){
					if($row = $stmt->fetch()){
						$email = $row["email"];
                        $hashed_password = $row["password"];
						if(password_verify($password, $hashed_password)){
							session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["email"] = $email;    
                            // Redirect user to welcome page
                            header("location: customer/profile.php");
						}else{
							// Display an error message if password is not valid
                            $password_err = "The password you entered was not valid.";
						}
					}
				}else{
					// Display an error message if username doesn't exist
                    $customer_id_fk = "No account found with that username.";
				}
			}else{
				echo "Error. Please try again later.";
			}
		}
	}
	// Close connection
    unset($connection);
}
?>

<?php include "../templates/header.php"; ?>
<h2>Login</h2>
<form action="customerlogin.php" method="post">
			<label for="email">Email</label>
			<input type="text" name="email" id="email">
			<div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
            <p>Don't have an account? <a href="customerregister.php">Sign up now</a>.</p>
</form>

<a href="../main.php">Main Page</a>
<?php include "../templates/footer.php"; ?>