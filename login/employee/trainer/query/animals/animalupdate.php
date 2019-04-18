<?php
if (isset($_POST['submit'])){
	require "../../../../../config.php";
	require "../../../../../common.php";
	
	try{
		$connection = new PDO($dsn, $username, $password, $options);
		
		$animal_id           = $_GET['id'];
		$enclosure_type_fk   = $_POST['enclosure_type_fk'];
		$animal_name         = $_POST['animal_name'];
		$animal_order        = $_POST['animal_order'];
		$animal_genus        = $_POST['animal_genus'];
		$animal_family       = $_POST['animal_family'];
		$animal_dob          = $_POST['animal_dob'];
		$animal_weight       = $_POST['animal_weight'];

		
		$sql = "UPDATE animals
		        SET enclosure_type_fk = '$enclosure_type_fk',
					animal_name       = '$animal_name',
					animal_order 	  = '$animal_order',
					animal_genus 	  = '$animal_genus',
					animal_family 	  = '$animal_family',
					animal_dob 		  = '$animal_dob',
					animal_weight 	  = '$animal_weight'
				WHERE animal_id = :animal_id";
				
		$statement = $connection->prepare($sql);
		$statement->bindValue(':animal_id', $animal_id);
		$statement->execute();
		
		print_r("Data successfully Updated. Redirect to profile in 3sec...");
		header("refresh:3; url=animalsearch.php");
		
	}catch(PDOException $error) {
		echo "Error: ";
		print_r($statement->errorInfo());
	}
}
?>

<?php include "../../../../../templates/header.php"; ?>
<link rel="stylesheet" href="../../../../../css/style.css" />
<strong>Update Animal</strong>

<form method="post">
        <label for="enclosure_type_fk">Region</label>
    	<input type="text" name="enclosure_type_fk" id="enclosure_type_fk">
    	<label for="animal_name">Name</label>
    	<input type="text" name="animal_name" id="animal_name">
		<label for="animal_order">Order</label>
    	<input type="text" name="animal_order" id="animal_order">
		<label for="animal_genus">Genus</label>
    	<input type="text" name="animal_genus" id="animal_genus">
		<label for="animal_family">Family</label>
    	<input type="text" name="animal_family" id="animal_family">
		<label for="animal_dob">Date of Birth</label>
    	<input type="text" name="animal_dob" id="animal_dob">
		<label for="animal_weight">Weight</label>
    	<input type="text" name="animal_weight" id="animal_weight">
    	<input type="submit" name="submit" value="Submit">
    </form>

<a href="animalsearch.php">Go Back</a>
<?php include "../../../../../templates/footer.php"; ?>