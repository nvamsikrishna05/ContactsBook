<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Update the Contact | ContactsBook</title>
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

	include 'config/databaseConnection.php';
	$id = isset($_GET['id'])?$_GET['id'] : die("Error : Record ID not found");
	
	if($_POST){
		try{
			$query = "update `contacts` set `fullname`=:name,`email`=:email,`city`=:city,`mobileno`=:mobile where `id`=:id";
			
			$pstmt = $conn->prepare($query);
			
			$pstmt->bindParam(':name',$_POST['fullname'],PDO::PARAM_STR);
			$pstmt->bindParam(':mobile',$_POST['mobileno'],PDO::PARAM_INT);
			$pstmt->bindParam(':email',$_POST['email'],PDO::PARAM_STR);
			$pstmt->bindParam(':city',$_POST['city'],PDO::PARAM_STR);
			$pstmt->bindParam(':id',$_GET['id'],PDO::PARAM_INT);
			
			if($pstmt->execute()){
				echo "Contact Updated<br>";
				echo "See <a class='pure-button pure-button-primary' href='read.php'>all Contacts</a><br>";
			}
			else{
				echo "Unable to update the contact.try again<br>";
			}
			
		}
		catch(PDOException $e){
		echo "Error : ".$e.getMessage()."<br>";
		echo "File Name : ".$e.getFile()."<br>";
		echo "Line Number : ".$e.getLine()."<br>";
		}
	}
	
	
	try{
		$query = "select `id`,`fullname`,`email`,`mobileno`,`city` from `contacts` where `id`=:id limit 0,1";
		$pstmt = $conn->prepare($query);
		
		$pstmt->bindParam(':id',$id,PDO::PARAM_INT);
		
		$pstmt->execute();
		
		$row = $pstmt->fetch(PDO::FETCH_ASSOC);
		
		$name = $row['fullname'];
		$email = $row['email'];
		$mobile = $row['mobileno'];
		$city = $row['city'];
		
	}
	catch(PDOException $e){
		echo "Error : ".$e.getMessage()."<br>";
		echo "File Name : ".$e.getFile()."<br>";
		echo "Line Number : ".$e.getLine()."<br>";
	}
	

?>

	<h1>Update the Contact</h1>
	<!-- Form to update the record -->
	<form class='pure-form pure-form-stacked' action="update.php?id=<?php echo htmlspecialchars($id); ?>" method="POST">
		<p>
			<label for="fullname">Name</label>
			<input type="text" name="fullname" id="fullname" value="<?php echo htmlspecialchars($name) ?>">
		</p>
		<p>
			<label for="email">Email</label>
			<input type="email" name="email" id="email" value="<?php echo htmlspecialchars($email) ?>">
		</p>
		<p>
			<label for="mobileno">Mobile Number</label>
			<input type="text" name="mobileno" id="mobileno" value="<?php echo htmlspecialchars($mobile) ?>">
		</p>
		<p>
			<label for="city">City</label>
			<input type="text" name="city" id="city" value="<?php echo htmlspecialchars($city) ?>">
		</p>
		<input class="pure-button pure-button-primary" type="submit" value="Update Contact">
	</form>
	
	
</body>
</html>