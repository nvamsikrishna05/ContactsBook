<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title> All Contacts List | ContactsBook</title>
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

<h1>All Contacts List.</h1>

<?php 
	include 'config/databaseConnection.php';
	
	
	$query = "select id,fullname,email,mobileno,city from contacts";
	$pstmt = $conn->prepare($query);
	$pstmt->execute();
	
	$num = $pstmt->rowCount();
	
	
	$action = isset($_GET['actionn'])?$_GET['action']:'';
	
	if($action == 'deleted'){
		echo "<p>Record was deleted successfully</p>";
	}
	
	//Atleast 1 contact is present.
	if($num >0){
		echo "<table class='pure-table pure-table-bordered pure-table-striped'>";
		echo "<thead>";
		echo "<tr><th>Name</th><th>Email</th><th>Mobile Number</th><th>City</th><th colspan=2>Actions</th></tr>";
		echo "</thead>";
		
		while($contact = $pstmt->fetch(PDO::FETCH_ASSOC)){
			echo "<tr>";
			echo "<td>{$contact['fullname']}</td><td>{$contact['email']}</td><td>{$contact['mobileno']}</td><td>{$contact['city']}</td><td><a class='pure-button pure-button-primary' href='update.php?id={$contact['id']}'>Edit</a></td><td><a class='pure-button pure-button-primary' href='#' onclick='deleteContact({$contact['id']})'>Delete</a></td>";
			echo "</tr>";
		}
		
		echo "</table>";
	}
	else{
		echo "<p>No Contacts Found.</p>";
	}
	
?>

<p><a class='pure-button pure-button-primary' href="create.php">Add a new Contact</a></p>

<script>
function deleteContact(id){
	var ans = confirm('Are you sure you want to delete this contact ?');
	
	if(ans){
		window.location = 'delete.php?id=' + id;
	}
}
</script>
	
</body>
</html>