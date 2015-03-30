<?php

	/*********************************************************************
	**********************************************************************
				   ____ ___    _    
				  / ___/ _ \  / \   
				 | |  | | | |/ _ \  
				 | |__| |_| / ___ \ 
				  \____\___/_/   \_\
	                   Conor's Obfuscation Algorithm
	 
	  Conor Walsh 2014 - 2015
	     Website: http://www.conorwalsh.net
	     GitHub:  https://github.com/conorwalsh
	  
	  Version 2.5
	  
	  First created: 10th August 2014
	  Last modified: 21st March 2015
	  
	  Description: This file demonstates how to use the COA algoritim
	               with Arduino to decrypt data sent from Arduino and
	               send it to a MySQL database.
	  
	**********************************************************************
	*********************************************************************/

	include "coa.php";

  	//The number the key is multiplied for extra security (Recommended 2 - 13) must match the security multiplier on the Arduino
	$securitymultiplier = 6;
	//Get the encrypted string
	$value = $_GET["i"];

	//Get the decrypted text
	$text = COAdecrypt($value, $securitymultiplier);
	
	//MySQL connection data
	//Location of server
	$server = "myserver.example.com";
	//Username
	$user = "myusername";
	//Password
	$password = "mypassword";
	//Database
	$db = "mydatabase";
	
	//Setup connection to database
	$con = new mysqli($server, $user, $password, $db);
	// Check connection
	if ($con->connect_error) {
	    die("Connection failed: " . $con->connect_error);
	}
	
	//This is the MySQL command to insert decrypted data into database (Storing unencrypted data is not recommended)
	$sql = "INSERT INTO coa_test (value) VALUES ('" . $text . "')";
	
	//Check if it was successful
	if ($con->query($sql) === TRUE) {
	    echo "Success";
	} else {
	    echo "Error: " . $con->error;
	}
	
	//Close the connection
	$con->close()

?>
