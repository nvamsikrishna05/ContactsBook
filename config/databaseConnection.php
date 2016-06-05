<?php 

	date_default_timezone_set('Asia/Kolkata');

	$hostName = "localhost";
	$dbName = "ContactDetails";
	$username = "root";
	$password = "";
	
	try{
		//Create Database connection to MySQL using PDO
		$conn = new PDO("mysql:host={$hostName};dbname={$dbName}",$username,$password);
		$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);	//Set Error Mode to Exception
		
		//Create table for storing the contact Details if doesnot exists
		$stmt = $conn->prepare("create table if not exists `contacts`(
																		`id` int unsigned not null auto_increment,
																		`fullname` varchar(35) not null default '',
																		`email` varchar(50) not null default '',
																		`mobileno` int unsigned not null default 0000000000,
																		`city` varchar(20) not null default '',
																		`modified` timestamp not null default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
																		primary key(`id`)
													)");
		$stmt->execute();
	}
	catch(PDOException $e){
		echo "Connection Error : ".$e->getMessage()."<br>";
		echo "Line Number : ".$e->getLine()."<br>";
	}
?>