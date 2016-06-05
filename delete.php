<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Deleting the Contact | ContactsBook</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">
</head>
<body>
	<?php 
		include 'config/databaseConnection.php';
		
		try{
			$id = isset($_GET['id'])? $_GET['id']: die('Error : Record not found'); 
			$query = "delete from `contacts` where `id`=:id";
			$pstmt = $conn->prepare($query);
			
			$pstmt->bindParam(':id',$id,PDO::PARAM_INT);
			
			if($pstmt->execute()){
				header('Location: read.php?action=deleted');
			}
			else{
				echo "Unable to delete the record<br>";
			}
		
		}
		catch(PDOException $e){
		echo "Error : ".$e.getMessage()."<br>";
		echo "File Name : ".$e.getFile()."<br>";
		echo "Line Number : ".$e.getLine()."<br>";
		}
	?>
</body>
</html>