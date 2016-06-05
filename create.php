<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Add a new Contact | ContactsBook</title>
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">
	<style>
		body{
			width : 75%;
			margin: 0 auto;
			
		}
	</style>
</head>
<body>
	<?php 
		if($_POST){
			include 'config/databaseConnection.php';
			
			try{
				
				//Submitted values being retrieved
				$name = htmlspecialchars(strip_tags($_POST['fullname']));
				$emailId = htmlspecialchars(strip_tags($_POST['email']));
				$mobile = htmlspecialchars(strip_tags($_POST['mobileno']));
				$city = htmlspecialchars(strip_tags($_POST['city']));
		
				//Prepare the query
				$query = "insert into contacts (`fullname`,`email`,`mobileno`,`city`) values (:fullname,:email,:mobileno,:city)";
				$pstmt = $conn->prepare($query);
				
				//Bind the parameter values
				$pstmt->bindParam(':fullname',$name,PDO::PARAM_STR);
				$pstmt->bindParam(':email',$emailId,PDO::PARAM_STR);
				$pstmt->bindParam(':mobileno',$mobile,PDO::PARAM_INT);
				$pstmt->bindParam(':city',$city,PDO::PARAM_STR);
				
				if($pstmt->execute()){
					echo "<p>Details are Added<br></p>";
				}
				else{
					die("Unable to save the details");
				}
			}
			catch(PDOException $e){
				echo "Error : ".$e->getMessage()."<br>";
				echo "Line Number : ".$e->getLine()."<br>";
				echo "File Name : ".$e->getFile()."<br>";
			}
		}
	?>

	<h1>Add a new Address</h1>
	<!-- form to enter contact details -->
	<form class="pure-form pure-form-stacked" action="create.php" method="POST">
		<p>
			<label for="fullname">Full Name</label>
			<input type="text" name="fullname" id="fullname" required>
		</p>
		<p>
			<label for="email">E-mail</label>
			<input type="email" name="email" id="email" required>
		</p>
		<p>
			<label for="mobileno">Mobile Number</label>
			<input type="text" name="mobileno" id="mobileno" required>
		</p>
		<p>
			<label for="city">City</label>
			<input type="text" name="city" id="city">
		</p>
		<input class="pure-button pure-button-primary" type="submit" value="Save Details">
	</form>
	
	<p><a class="pure-button pure-button-primary" href="read.php">All Contacts</a></p>
	
</body>
</html>